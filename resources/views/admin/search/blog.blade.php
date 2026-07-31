<div id="searchBox" class="hidden bg-white shadow rounded p-4 mb-4">
    <form method="GET">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="titulo" value="{{request('titulo')}}" placeholder="Buscar pelo título, url, descrição ou corpo do blog" class="form-control">
            </div>
            
            <div class="col-md-3">
                <select id="autor_id" name="autor_id" class="form-control @error('autor_id') is-invalid @enderror">
                    <option value="">Selecione o autor</option>
                    @foreach(\App\Models\BlogAutor::all() as $autor)
                        <option value="{{ $autor->id }}" {{ request('autor_id') == $autor->id ? 'selected' : '' }}>{{ $autor->autor }}</option>
                    @endforeach 
                </select>
            </div>
            <div class="col-md-2">
                <select id="categoria_id" name="categoria_id" class="form-control">
                    <option value="">Selecione a categoria</option>
                    @foreach(\App\Models\BlogCategoria::all() as $cat)
                        <option value="{{ $cat->id }}" {{ request('categoria_id') == $cat->id ? 'selected' : '' }}>{{ $cat->categoria }}</option>
                    @endforeach															
                </select>	
            </div>
            <div class="col-md-2">
                <select name="status" class="form-control">
                    <option value="">Selecione o status</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Habilitado</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Desabilitado</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>
</div>