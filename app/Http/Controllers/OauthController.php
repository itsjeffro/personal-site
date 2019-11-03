<?php

namespace App\Http\Controllers;

use App\Itsjeffro\OauthClient;
use App\Itsjeffro\OauthTypes;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Http\Rules\RedirectRule;
use Illuminate\Http\RedirectResponse;

class OauthController extends Controller
{
    /** @var ClientRepository */
    private $clients;

    /** @var ValidationFactory */
    private $validation;
    
    /** @var RedirectRule */
    private $redirectRule;

    /**
     * Create a new controller instance.
     *
     * @param ClientRepository $clients
     * @param ValidationFactory $validation
     * @param RedirectRule $redirectRule
     * @return void
     */
    public function __construct(ClientRepository $clients, ValidationFactory $validation, RedirectRule $redirectRule)
    {
        $this->middleware('auth');

        $this->clients = $clients;
        $this->validation = $validation;
        $this->redirectRule = $redirectRule;
    }

    /**
     * Show create form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('backend.oauth.create');
    }

    /**
     * Create record.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validation->make($request->all(), [
            'name' => 'required|max:255',
            'redirect' => ['required', $this->redirectRule],
        ])->validate();

        $isPersonalAccessGrantType = (int) $request->input('grant_type') === OauthTypes::PERSONAL_ACCESS_GRANT_TYPE;
        $isPasswordGrantType = (int) $request->input('grant_type') === OauthTypes::PASSWORD_GRANT_TYPE;

        $this->clients->create(
            $request->user()->getKey(), 
            $request->name, 
            $request->redirect,
            $isPersonalAccessGrantType,
            $isPasswordGrantType
        );
        
        return redirect()->route('home');
    }

    /**
     * Show record.
     *
     * @param OauthClient $oauthClient
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(OauthClient $oauthClient)
    {
        $this->authorize('view', $oauthClient);

        return view('backend.oauth.show')->with(['client' => $oauthClient]);
    }

    /**
     * Update record.
     *
     * @param Request $request
     * @param OauthClient $oauthClient
     * @return RedirectResponse
     */
    public function update(Request $request, OauthClient $oauthClient)
    {
        $this->authorize('view', $oauthClient);

        $this->validation->make($request->all(), [
            'name' => 'required|max:255',
            'redirect' => ['required', $this->redirectRule],
        ])->validate();

        $isPersonalAccessGrantType = (int) $request->input('grant_type') === OauthTypes::PERSONAL_ACCESS_GRANT_TYPE;
        $isPasswordGrantType = (int) $request->input('grant_type') === OauthTypes::PASSWORD_GRANT_TYPE;

        $oauthClient->update([
            'name' => $request->input('name'),
            'redirect' => $request->input('redirect'),
            'personal_access_client' => $isPersonalAccessGrantType,
            'password_client' => $isPasswordGrantType,
        ]);

        return redirect()->route('home');
    }

    /**
     * Remove record.
     *
     * @param Request $request
     * @param OauthClient $oauthClient
     * @return RedirectResponse
     */
    public function destroy(Request $request, OauthClient $oauthClient)
    {
        $this->authorize('delete', $oauthClient);

        $oauthClient->delete();

        return redirect()->route('home');
    }
}
