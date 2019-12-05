<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\RendimentoController;

class AdicionaRendimento extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AdicionaRendimento:adicionar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adiciona rendimento à comissão conforme taxa do dia ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $adicionaRendimento = RendimentoController::create();

    }
}