<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'facebook',
                'value' => 'https://www.facebook.com/profile.php?id=61591602831825',
            ],
            [
                'key' => 'instagram',
                'value' => 'https://www.instagram.com/weuny.br/',
            ],
            [
                'key' => 'linkedin',
                'value' => 'https://www.linkedin.com/company/weuny',
            ],
            [
                'key' => 'logo_footer',
                'value' => 'logo/logo-fundo-escuro.svg',
            ],
            [
                'key' => 'logo_header',
                'value' => 'logo/logo-fundo-claro.svg',
            ],
            [
                'key' => 'note_footer',
                'value' => 'A infraestrutura interna que sua operação precisa para escalar com clareza e controle.',
            ],
            [
                'key' => 'site_bairro',
                'value' => 'Jardim Niceia',
            ],
            [
                'key' => 'site_cep',
                'value' => '17047-430',
            ],
            [
                'key' => 'site_cidade',
                'value' => 'Bauru',
            ],
            [
                'key' => 'site_description',
                'value' => 'A infraestrutura interna que sua operação precisa para escalar com clareza e controle.',
            ],
            [
                'key' => 'site_email',
                'value' => 'contato@ikatec.com.br',
            ],
            [
                'key' => 'site_endereco',
                'value' => 'Rua Sérgio Arcângelo, 1-49',
            ],
            [
                'key' => 'site_estado',
                'value' => 'SP',
            ],
            [
                'key' => 'site_name',
                'value' => 'Weuny — One Corporate Center',
            ],
            [
                'key' => 'site_name_short',
                'value' => 'Ikatec',
            ],
            [
                'key' => 'site_telefone',
                'value' => '+55 (14) 3103-7800',
            ],
            [
                'key' => 'site_url',
                'value' => 'https://www.weuny.com.br/',
            ],
            [
                'key' => 'telegram',
                'value' => '',
            ],
            [
                'key' => 'tiktok',
                'value' => '',
            ],
            [
                'key' => 'whatsapp',
                'value' => '',
            ],
            [
                'key' => 'youtube',
                'value' => '',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }   
    }
}
