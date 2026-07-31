<img src="{{ !empty($config['logo_header']) ? asset('storage/'.$config['logo_header']) : '' }}" {{ $attributes->merge(['class' => 'h-10']) }} alt="{{ $config['site_name'] ?? '' }}">
