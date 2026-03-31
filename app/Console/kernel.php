<?php
namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use PhpParser\Node\Scalar\MagicConst\Dir;

class kernel extends ConsoleKernel  {
    protected function schedule(Schedule $schedule){
        $schedule->command('app:monitor-serveurs')
                    ->everyFiveMinutes();
    }
    protected function commands(){
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }

}