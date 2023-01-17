<?php

namespace App\Http\Controllers\Traits;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use PhpImap\Exceptions\InvalidParameterException;
use PhpImap\Mailbox;

trait EmailTrait
{

    public function createEmail($email, $email_credentials)
    {
        $response = Http::withHeaders([
            'Authorization' => 'cpanel u6929295:' . config('cpanel.token'),
        ])->get('https://cpanel.open-projects.org/execute/Email/add_pop', [
            'email' => $email,
            'password' => $email_credentials,
            'domain' => 'huffman.mythesis.website',
            'quota' => '128',
            'send_welcome_email' => '1',
        ]);

        return $response->json();
    }

    /**
     * @throws InvalidParameterException
     */
    public function getMailContents($email, $email_credentials): array
    {
        $mailbox = new Mailbox(
            '{mail.open-projects.org:993/imap/ssl}INBOX', // IMAP server and mailbox folder
            $email, // Username for the before configured mailbox
            $email_credentials, // Password for the before configured username
            storage_path('app\public\email_attachment'), // Directory, where attachments will be saved (optional)
            'UTF-8', // Server encoding (optional)
            true, // Trim leading/ending whitespaces of IMAP path (optional)
            false // Attachment filename mode (optional; false = random filename; true = original filename)
        );
        $mailbox->setAttachmentsIgnore(true);

        $mailIds = $mailbox->searchMailbox('ALL');
        $mailContents = [];

        foreach ($mailIds as $mailId) {
            $getContents = $mailbox->getMail($mailId);

            $mailContents[] = [
                'id' => $getContents->id,
                'subject' => $getContents->subject,
                'content' => $getContents->textHtml,
                'date' => Carbon::createFromFormat('Y-m-d H:i:s', explode('+', str_replace('T', ' ', $getContents->date))[0])->diffForHumans(),
                'senderName' => $getContents->senderName,
                'senderAddress' => $getContents->senderAddress,
                'to' => auth()->user()->email
            ];
        }

        usort($mailContents, function ($item1, $item2) {
            return $item2['id'] <=> $item1['id'];
        });

        return $mailContents;
    }

    public function encodingCheck($text): bool
    {
        $result = false;
        if (base64_encode(base64_decode($text, true)) === $text) {
            $result = true;
        }

        return $result;
    }
}
