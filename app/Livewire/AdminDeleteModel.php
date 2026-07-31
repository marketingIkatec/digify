<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

use App\Models\Blog;
use App\Models\BlogCategoria;
use App\Models\BlogAutor;
use App\Models\NaMidia;
use App\Services\UploadService;


class AdminDeleteModel extends Component
{
    public Model $item;
    public string $routeName;

    public function mount(Model $item, $routeName = '')
    {
        $this->item = $item;
        $this->routeName = $routeName;
    }

    public function ask()
    {
        $this->dispatch('swal:delete-confirm', id: $this->getId(), text: $this->item->display_name ?? '');
    }

    public function deleteConfirmed()
    {
        Gate::authorize('edit-route', $this->routeName);

        $name = $this->item->display_name ?? '';

        if($this->item instanceof BlogAutor){
            // Verifica se existe algum blog usando este autor
            if ($this->item->blogs()->count() > 0) {
                return redirect()->route('admin.blog.autor.index')->with('error', 'Este Autor(a): <strong>'.$name.'</strong> não pode ser excluído porque ainda possui blogs vinculados.<br><br>Se desejar, você pode apenas desativá-lo para que não seja exibido no site.');
            }            
        }else if($this->item instanceof BlogCategoria){
            if ($this->item->blogs()->count() > 0) {
                return redirect()->route('admin.blog.categoria.index')->with('error', 'Esta categoria: <strong>'.$name.'</strong> não pode ser excluída porque ainda possui blogs vinculados.<br><br>Se desejar, você pode apenas desativá-la para que não seja exibido no site.');
            }
        }

        if(!empty($this->item->imagem) || !empty($this->item->file)){
            $uploadService = new UploadService();
            $uploadService->deletarImage($this->item->imagem ?? $this->item->file);
        }

        $this->item->delete();
        $this->dispatch('swal-alert', icon: 'success', text: 'O ítem: '.$name.' foi removido com sucesso!');

        $this->dispatch('row-deleted', id: $this->item->getKey());
    }

    public function render()
    {
        return view('livewire.admin-delete-button');
    }
}
