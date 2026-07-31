<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Upload;

class UploadFilesController extends Controller
{

    public function index(Request $request)
    {
        $query = Upload::query();

        // Filtro por nome
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');

        $items = $query->orderBy($sortField, $sortDirection)
                    ->paginate(10)
                    ->appends($request->all());

        return view('admin.pages.upload.index')
                ->with('items', $items)
                ->with('sortField', $sortField)
                ->with('sortDirection', $sortDirection);
    }

    public function create()
    {
        return view('admin.pages.upload.cadastrar');
    }

    public function edit($item)
    {
        $item = Upload::findOrFail($item);
        return view('admin.pages.upload.cadastrar')
                ->with('item', $item);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name'  => 'required|string|max:255|unique:uploads,name,' . $request->id,
            'file' => 'nullable|file|max:102400',
        ]);

        $data = $request->all();

        if ($request->hasFile('file')) {
            $file = \Str::slug($request->name).'.'.$request->file('file')->getClientOriginalExtension();
            $data['file'] = $request->file('file')->storeAs('files', $file, 'public');
        }

        $upload = Upload::updateOrCreate(
            ['id' => $data['id'] ?? null],
            $data
        );

        $msg = $data['id'] ? "Arquivo atualizado com sucesso!" : "Arquivo criado com sucesso!";

        return redirect()->route('admin.site.upload.index')->with('success', $msg);    
     }

    public function uploadCkeditor(Request $request)
    {
        if($request->hasFile('upload')) {

            $file     = $request->file('upload');
            $filename = time() . '-' . $file->getClientOriginalName();
            
            $path     = $file->storeAs($request->path, $filename, 'public');

            $url = asset('storage/' . $path);

            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url' => $url
            ]);
        }
    }

    public function uploadTemp(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();

            $slugName = \Str::slug($originalName);
            $fileName = $slugName . '.' . strtolower($extension);

            $path = $file->storeAs('temp', $fileName, 'public');

            return response()->json([
                'path' => $path
            ]);
        }

        return response()->json([], 400);
    }

    public function deleteTemp(Request $request)
    {
        if ($request->path && Storage::disk('public')->exists($request->path)) {
            Storage::disk('public')->delete($request->path);
        }

        return response()->json(['ok' => true]);
    }

}
