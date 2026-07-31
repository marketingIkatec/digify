<div id="searchBox" class="hidden bg-white shadow rounded p-4 mb-4">

    <form method="GET">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="nome" value="{{ request('nome') }}" placeholder="Buscar por nome"
                    class="form-control">
            </div>
            <div class="col-md-3">
                <input type="text" name="email" value="{{ request('email') }}" placeholder="Buscar por email"
                    class="form-control">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">Selecione o status</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Não enviado para o HubSpot</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Enviado para o HubSpot</option>
                </select>
            </div>

            @if(!empty($formTypes))
                <div class="col-md-3">
                    <select name="form_type" class="form-control">
                        <option value="">Selecione o formulário</option>
                        @foreach($formTypes as $form_type)                            
                            <option value="{{$form_type}}" {{ request('form_type') === $form_type ? 'selected' : '' }}>{{$form_type}}</option>
                        @endforeach
                    </select>
                </div>
            @endif  
            
            <div class="col-md-3">
                <button class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>
</div>