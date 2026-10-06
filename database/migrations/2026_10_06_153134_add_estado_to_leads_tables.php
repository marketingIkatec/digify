<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $ddds = [
            '11' => 'SP', '12' => 'SP', '13' => 'SP',
            '14' => 'SP', '15' => 'SP', '16' => 'SP',
            '17' => 'SP', '18' => 'SP', '19' => 'SP',

            '21' => 'RJ', '22' => 'RJ', '24' => 'RJ',

            '27' => 'ES', '28' => 'ES',

            '31' => 'MG', '32' => 'MG', '33' => 'MG',
            '34' => 'MG', '35' => 'MG', '37' => 'MG',
            '38' => 'MG',

            '41' => 'PR', '42' => 'PR', '43' => 'PR',
            '44' => 'PR', '45' => 'PR', '46' => 'PR',

            '47' => 'SC', '48' => 'SC', '49' => 'SC',

            '51' => 'RS', '53' => 'RS', '54' => 'RS', '55' => 'RS',

            '61' => 'DF',

            '62' => 'GO', '64' => 'GO',

            '65' => 'MT', '66' => 'MT',

            '67' => 'MS',

            '68' => 'AC',
            '69' => 'RO',

            '71' => 'BA', '73' => 'BA', '74' => 'BA',
            '75' => 'BA', '77' => 'BA',

            '79' => 'SE',

            '81' => 'PE', '87' => 'PE',
            '82' => 'AL',
            '83' => 'PB',
            '84' => 'RN',

            '85' => 'CE', '88' => 'CE',

            '86' => 'PI', '89' => 'PI',

            '91' => 'PA', '93' => 'PA', '94' => 'PA',

            '92' => 'AM', '97' => 'AM',

            '95' => 'RR',
            '96' => 'AP',
            '63' => 'TO',
            '98' => 'MA',
            '99' => 'MA',
        ];

        $tabelas = [
            'leadsContato',
            'leadsCustomContato',
            'leadsWhatsapp',
        ];

        foreach ($tabelas as $tabela) {
            if (!Schema::hasColumn($tabela, 'estado')) {
                Schema::table($tabela, function (Blueprint $table) {
                    $table->char('estado', 2)
                        ->nullable()
                        ->after('whatsapp');
                });
            }

            DB::table($tabela)
                ->select('id', 'whatsapp')
                ->whereNotNull('whatsapp')
                ->where('whatsapp', '!=', '')
                ->orderBy('id')
                ->chunkById(500, function ($leads) use ($tabela, $ddds) {

                    foreach ($leads as $lead) {
                        $whatsapp = preg_replace('/\D/', '', $lead->whatsapp);

                        // Remove código do Brasil
                        if (str_starts_with($whatsapp, '55')) {
                            $whatsapp = substr($whatsapp, 2);
                        }

                        $ddd = substr($whatsapp, 0, 2);

                        if (isset($ddds[$ddd])) {
                            DB::table($tabela)
                                ->where('id', $lead->id)
                                ->update([
                                    'estado' => $ddds[$ddd],
                                ]);
                        }
                    }
                });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leadsContato', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('leadsCustomContato', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('leadsWhatsapp', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
};
