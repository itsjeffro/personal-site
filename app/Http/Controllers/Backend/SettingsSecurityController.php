<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SettingsSecurityController extends Controller
{
    /** @var User */
    private $user;

    /** @var Validator */
    private $validator;

    /**
     * SettingsSecurityController constructor.
     *
     * @param User $user
     * @param Validator $validator
     */
    public function __construct(User $user, Validator $validator)
    {
        $this->user = $user;
        $this->validator = $validator;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('backend.settings.security-show');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable
     */
    public function update(Request $request)
    {
        $validator = $this->validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if ($validator) {
            return redirect()
                ->route('settings.security.show')
                ->withErrors($validator);
        }

        $this->user
            ->where('id', Auth::id())
            ->update([]);

        return redirect()->route('settings.security.show');
    }
}
