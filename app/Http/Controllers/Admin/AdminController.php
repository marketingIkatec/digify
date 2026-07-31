<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Services\VisitasService;
use App\Models\Visitas;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $visitasObj = new VisitasService();
        $graficos = $visitasObj->getGrafico();

        $query = Visitas::query();

        // Filtro por data inicial
        if ($request->filled('dataInicial')) {
            $query->where('data', '>=', $request->dataInicial . ' 00:00:00');
        }

        // Filtro por data final
        if ($request->filled('dataFinal')) {
            $query->where('data', '<=', $request->dataFinal . ' 23:59:59');
        }

        if ($request->filled('tipoPagina')) {
            $query->where('pagina', $request->tipoPagina);
        }

        // Paginação com 10 por página
        // Ordenação
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');

        $items = $query->orderBy($sortField, $sortDirection)
                       ->paginate(30)
                       ->appends($request->all());
        
        $paginas = Visitas::select('pagina')
        ->groupBy('pagina')
        ->orderBy('pagina')
        ->get();

        return view('admin.pages.dashboard')
                ->with('paginas', $paginas)
                ->with('graficos', $graficos)
                ->with('items', $items);
    }

    public function alterarStatus(Request $request){
        
        if(($objName = $request->name) && ($id = $request->id)){
            $class = "App\\Models\\{$objName}";
            $obj = $class::findOrFail($id);
            
            if($obj->status ==1){
                $obj->status = 0;
            }else{
                $obj->status = 1;
            }
            $obj->update();
        }
        return back()->with('success', 'Status alterado com sucesso!');
    }
}
