<?php

namespace Command;

use Illuminate\Console\Command;

class MakeConfigFileCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roleduodoctor:config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria arquivo de configuração extra';

    public function handle()
    {
        try {
            
            $config_file = file_get_contents(__DIR__ . "/../../../config/roleduodoctor.php");

            $arquivo = fopen(__DIR__ . "/../../../../../../config/roleduodoctor.php", "w");
            fwrite($arquivo, $config_file);
            fclose($arquivo);

            $this->info("Arquivo de configuração criado com sucesso.");

        } catch (\Exception $e) {
            
            $this->error($e->getMessage());
        }
    }
}
