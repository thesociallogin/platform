<?php

namespace App\Notifications;

use App\Models\OneTimeCode as OneTimeCodeModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class OneTimeCode extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected OneTimeCodeModel $code)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return [];
    }
}
