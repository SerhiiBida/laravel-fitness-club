<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class MailService
{
    // Отправка сообщения на почту
    public function send(string $to, string $mailableClass, array $mailData = []): bool
    {
        try {
            Mail::to($to)->queue(new $mailableClass($mailData));

            return true;

        } catch (\Exception $e) {
            \Log::error('MailService error: ' . $e->getMessage());

            return false;
        }
    }
}
