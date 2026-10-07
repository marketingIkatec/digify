<div id="searchBox" class="hidden bg-white shadow rounded p-4 mb-4">

    <form method="GET">
        <div class="row">
            @if (request()->route()->getName() != 'admin.lead.api-digify')
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
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Não enviado para o
                            HubSpot
                        </option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Enviado para o HubSpot
                        </option>
                    </select>
                </div>

                @if (!empty($formTypes))
                    <div class="col-md-3">
                        <select name="form_type" class="form-control">
                            <option value="">Selecione o formulário</option>
                            @foreach ($formTypes as $form_type)
                                <option value="{{ $form_type }}"
                                    {{ request('form_type') === $form_type ? 'selected' : '' }}>{{ $form_type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
            @else
                <div class="col-md-3">
                    <input type="text" name="emailAccountID" value="{{ request('emailAccountID') }}"
                        placeholder="Buscar por Email/Account ID" class="form-control">
                </div>
                <div class="col-md-3">
                    <select name="property" class="form-control">
                        <option value="">Selecione a propriedade</option>
                        @foreach(($propertyOptions ?? []) as $property)
                            <option value="{{ $property }}" {{ request('property') === $property ? 'selected' : '' }}>
                                {{ $property }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="digifyStatus" class="form-control">
                        <option value="">Selecione o status</option>
                        @foreach(($statusOptions ?? []) as $statusValue => $statusLabel)
                            <option value="{{ $statusValue }}" {{ request('digifyStatus') === $statusValue ? 'selected' : '' }}>
                                {{ $statusLabel }}
                            </option>
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
