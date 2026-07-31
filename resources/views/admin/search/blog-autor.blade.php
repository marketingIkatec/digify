<div id="searchBox" class="hidden bg-white shadow rounded p-4 mb-4">
    <form method="GET">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="autor" value="{{request('autor')}}" placeholder="Buscar por autor" class="form-control">
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