<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Agendamentos de tarefas
     */
    protected function schedule(Schedule $schedule)
    {
        // Rodar o comando de teste a cada minuto
        $schedule->command('atualizar:jogos')->everyMinute();
    }

    /**
     * Registrar comandos do Artisan
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
