<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class SettingsAccountController extends Controller
{
    /** @var User */
    private $user;

    /**
     * SettingsAccountController constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Show record.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('backend.settings.account-show');
    }

    /**
     * Update record
     *
     * @param Request $request
     */
    public function update(Request $request)
    {
        //
    }
}
