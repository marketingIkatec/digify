<?php

namespace App\Console\Commands;

use App\Models\AccountDigifyHubspot;
use App\Services\DigifyHubspotService;
use Illuminate\Console\Command;

class UpdateDigifyStatusUso extends Command
{
    /*
        php artisan digify:update-status-uso
        php artisan digify:update-status-uso --dry-run //Para testar sem salvar nem enviar para HubSpot
        php artisan digify:update-status-uso --id=91
    */
    protected $signature = 'digify:update-status-uso {--id= : Atualiza somente uma conta} {--dry-run : Calcula sem salvar ou enviar para HubSpot}';

    protected $description = 'Calcula o status_uso das contas Digify e envia a propriedade para a HubSpot.';

    public function handle(DigifyHubspotService $digifyHubspotService): int
    {
        $query = AccountDigifyHubspot::query()->orderBy('id');

        if ($this->option('id')) {
            $query->where('id', $this->option('id'));
        } else {
            $query->where(function ($query) {
                $query->whereNull('status_uso')
                    ->orWhere('status_uso', '');
            });
        }

        $processed = 0;
        $errors = 0;

        $query->chunkById(100, function ($accounts) use ($digifyHubspotService, &$processed, &$errors) {
            foreach ($accounts as $account) {
                try {
                    $status = $this->option('dry-run')
                        ? $digifyHubspotService->calculateStatusUso($account)
                        : $digifyHubspotService->updateStatusUso($account);

                    $processed++;
                    $this->line("#{$account->id} {$account->email} => {$status}");
                } catch (\Throwable $e) {
                    $errors++;
                    $this->error("#{$account->id} {$account->email} => {$e->getMessage()}");
                }
            }
        });

        $this->info("Processadas: {$processed}. Erros: {$errors}.");

        return $errors > 0 ? self::FAILURE : self::SUCCESS;
    }
}
