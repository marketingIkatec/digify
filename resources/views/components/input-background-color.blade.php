@props([
    'inputName',      // ex: configuracao[button_background]
    'item' => null,   // model (opcional)
    'pageBlockConfig' => []   // lista de backgrounds salvos
])

@php
    /*
    |--------------------------------------------------------------------------
    | Normalização de nomes
    |--------------------------------------------------------------------------
    */

    // configuracao[button_background]
    $baseName = $inputName;

    // configuracao.button_background
    $dotBase = str_replace(['[', ']'], ['.', ''], $baseName);

    // nomes derivados
    $radioName   = str_replace(']', '_bg_type]', $baseName);
    $solidName   = str_replace(']', '_solid_color]', $baseName);
    $grad1Name   = str_replace(']', '_gradient_color1]', $baseName);
    $grad2Name   = str_replace(']', '_gradient_color2]', $baseName);
    $gradDirName = str_replace(']', '_gradient_direction]', $baseName);
    $newBgName   = str_replace(']', '_new]', $baseName);

    // dot notation
    $radioDot   = str_replace(['[', ']'], ['.', ''], $radioName);
    $solidDot   = str_replace(['[', ']'], ['.', ''], $solidName);
    $grad1Dot   = str_replace(['[', ']'], ['.', ''], $grad1Name);
    $grad2Dot   = str_replace(['[', ']'], ['.', ''], $grad2Name);
    $gradDirDot = str_replace(['[', ']'], ['.', ''], $gradDirName);

    /*
    |--------------------------------------------------------------------------
    | Valores atuais (old → item → default)
    |--------------------------------------------------------------------------
    */

    $type = old($radioDot, data_get($item, $radioDot, 'salvo'));

    $savedValue = old($dotBase, data_get($item, $dotBase));
    $solidColor = old($solidDot, data_get($item, $solidDot, '#0066FF'));

    $gradColor1 = old($grad1Dot, data_get($item, $grad1Dot, '#0052CC'));
    $gradColor2 = old($grad2Dot, data_get($item, $grad2Dot, '#0066FF'));
    $gradDir    = old($gradDirDot, data_get($item, $gradDirDot, 'to right'));
@endphp

<div class="background-options js-background-picker"
    data-type="{{ $type }}"
    data-saved="{{ $savedValue }}"
    data-solid="{{ $solidColor }}"
    data-grad1="{{ $gradColor1 }}"
    data-grad2="{{ $gradColor2 }}"
    data-grad-dir="{{ $gradDir }}"
>

    {{-- COR SALVA --}}
    <label class="bg-row">
        <input type="radio"
            name="{{ $radioName }}"
            value="salvo"
            class="bg_type"
            @checked($type === 'salvo')>

        <select name="{{ $baseName }}" class="form-control js-bg-select">
            <option value="">Selecione a cor de fundo</option>
            @if(!empty($pageBlockConfig))
                @foreach($pageBlockConfig as $configItem)
                    <option value="{{ $configItem->configuracao }}"
                        @selected($savedValue === $configItem->configuracao)>
                        {{ $configItem->nome }}
                    </option>
                @endforeach
            @endif
        </select>
    </label>

    {{-- SOLID --}}
    <label class="bg-row">
        <input type="radio"
            name="{{ $radioName }}"
            value="solid"
            class="bg_type"
            @checked($type === 'solid')>
        Cor sólida
    </label>

    <div class="solid-options">
        <input type="color"
            class="w-100"
            name="{{ $solidName }}"
            value="{{ $solidColor }}">
    </div>

    {{-- GRADIENT --}}
    <label class="bg-row">
        <input type="radio"
            name="{{ $radioName }}"
            value="gradient"
            class="bg_type"
            @checked($type === 'gradient')>
        Gradiente
    </label>

    <div class="gradient-options">
        <input type="color"
            class="gradientColor w-49"
            name="{{ $grad1Name }}"
            value="{{ $gradColor1 }}">

        <input type="color"
            class="gradientColor w-49"
            name="{{ $grad2Name }}"
            value="{{ $gradColor2 }}">

        <select name="{{ $gradDirName }}" class="form-control gradientDirection">
            <option value="to right" @selected($gradDir === 'to right')>→ Direita</option>
            <option value="to bottom" @selected($gradDir === 'to bottom')>↓ Baixo</option>
            <option value="135deg" @selected($gradDir === '135deg')>↘ Diagonal</option>
        </select>
    </div>

    {{-- PREVIEW --}}
    <div class="form-control bg-preview js-bg-preview">
        Preview
    </div>

    {{-- SALVAR NOVA CONFIG --}}
    <div class="mt-1">
        <a href="javascript:;" class="addConfiguracaoBackground" title="Salvar esta configuração de background">
            <i class="fa fa-plus-circle"></i> Background
        </a>

        <input type="text"
            class="inputBackgroundName hidden"
            name="{{ $newBgName }}"
            placeholder="Nome para o Background">
    </div>

</div>
