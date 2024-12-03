<?php

namespace App\Actions;

use App\Mail\OneTimeCode as OneTimeCodeMail;
use App\Models\Enums\OneTimeCodeType;
use App\Models\OneTimeCode;
use App\Models\User;
use App\Notifications\OneTimeCode as OneTimeCodeNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HigherOrderTapProxy;

class SendOneTimeCode
{
    public static function handle(string $emailOrPhoneNumber, OneTimeCodeType $type): OneTimeCode|HigherOrderTapProxy|null
    {
        $userHandler = match ($type) {
            OneTimeCodeType::EMAIL => fn () => User::firstWhere('email', $emailOrPhoneNumber),
            OneTimeCodeType::SMS => fn () => User::firstWhere('phone_number', $emailOrPhoneNumber)
        };

        /** @var ?User $user */
        $user = value($userHandler);

        if (blank($user)) {
            return null;
        }

        $oneTimeCode = $user->oneTimeCodes()->create([
            'type' => $type,
        ]);

        return tap($oneTimeCode, function (OneTimeCode $code) use ($user, $type) {
            match ($type) {
                OneTimeCodeType::EMAIL => Mail::to($user)->send(new OneTimeCodeMail($code)),
                OneTimeCodeType::SMS => $user->notify(new OneTimeCodeNotification($code)),
            };
        });
    }
}
