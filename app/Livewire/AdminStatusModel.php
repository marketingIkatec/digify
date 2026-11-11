<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;


class AdminStatusModel extends Component
{
    public Model $item;
    public string $field = 'status';
    public bool $value;
    #[Locked]
    public string $route;

    protected $listeners = ['toggleConfirmed'];

    public function mount(Model $item, string $field = 'status', string $route = '')
    {
        $this->item  = $item;
        $this->field = $field;
        // 🔥 estado inicial vem do banco
        $this->value = (bool) $item->{$field};
        $this->route = $route;
    }

    public function ask()
    {
        $this->dispatch('swal:confirm', id: $this->getId(), text: ($this->item->status == 1 ? 'ocultar no site' : 'deixar visível no site'), name: $this->item->display_name?? '');
    }

    public function toggleConfirmed()
    {
        Gate::authorize('edit-route', $this->route);

        // 🔁 inverte estado LOCAL primeiro
        $this->value = ! $this->value;
        // 🔥 depois atualiza no banco
        $this->item->update([
            $this->field => ! $this->item->{$this->field},
        ]);

        $this->dispatch('swal-alert', icon: 'success', text: 'Status alterado com sucesso!');
    }



    public function render()
    {
        return view('livewire.admin-status-toggle');
    }
}

