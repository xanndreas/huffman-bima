<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\EmailTrait;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    use RedirectsUsers, EmailTrait;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
        if ($this->assignEmail($request->user())) {
            $user = User::where('id', Auth::id())->first();
            $user->update([
                'is_approved' => 1
            ]);
        }

        $pageConfigs = ['blankPage' => true];

        return $request->user()->is_approved
            ? redirect($this->redirectPath())
            : view('content.auth.awaits-approval', ['pageConfigs' => $pageConfigs]);
    }

    public function assignEmail ($user) {
        $createEmail = $this->createEmail($user->email, $user->email_credentials);
        return isset($createEmail['status']) && $createEmail['status'] == 1;
    }
}
