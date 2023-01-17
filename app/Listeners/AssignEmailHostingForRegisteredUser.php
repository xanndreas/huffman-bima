<?php

namespace App\Listeners;

use App\Http\Controllers\Traits\EmailTrait;
use Illuminate\Auth\Events\Registered;

class AssignEmailHostingForRegisteredUser
{
    use EmailTrait;

    protected $user;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    public function handle(Registered $event)
    {
        $this->user = $event->user;

        if ($this->assignEmail()) {
            $this->user->update([
                'is_approved' => 1,
            ]);
        }
    }

    protected function assignEmail () {
        $createEmail = $this->createEmail($this->user->email, $this->user->email_credentials);
        return isset($createEmail['status']) && $createEmail['status'] == 1;
    }
}
