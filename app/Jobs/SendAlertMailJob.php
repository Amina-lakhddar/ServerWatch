<?php
namespace App\Jobs;

use App\Mail\AlertMail;
use App\Models\Alert;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin;

class SendAlertMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Alert $alert;

    public function __construct(Alert $alert)
    {
        $this->alert = $alert;
    }

    public function handle(): void
    {
        
        $admins = Admin::all();
        foreach ($admins as $admin) {
            Mail::to($admin->email)
                ->send(new AlertMail($this->alert));
        }
    }
}