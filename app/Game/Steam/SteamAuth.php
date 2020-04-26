<?php

namespace App\Game\Steam;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SteamAuth
{
    /** @var string */
    const STEAM_LOGIN = 'https://steamcommunity.com/openid/login';

    /** @var Client */
    private $http;

    /** @var string */
    private $returnUrl;

    /**
     * SteamAuth construct.
     *
     * @param Client $http
     */
    public function __construct(Client $http)
    {
        $this->http = $http;
    }

    /**
     * Sets the return url.
     *
     * @param string $returnUrl
     * @return self
     */
    public function setReturnUrl(string $returnUrl)
    {
        $this->returnUrl = $returnUrl;

        return $this;
    }

    /**
     * Returns the return url.
     *
     * @return string
     */
    public function getReturnUrl(): string
    {
        return $this->returnUrl;
    }

    /**
     * Returns the url to redirect users to log in through steam.
     *
     * @return string
     */
    public function steamLoginUrl(): string
    {
        $queries = [
            'openid.ns' => 'http://specs.openid.net/auth/2.0',
            'openid.mode' => 'checkid_setup',
            'openid.return_to' => $this->getReturnUrl(),
            'openid.identity' => 'http://specs.openid.net/auth/2.0/identifier_select',
            'openid.claimed_id' => 'http://specs.openid.net/auth/2.0/identifier_select',
        ];

        return self::STEAM_LOGIN . '?' . http_build_query($queries);
    }

    /**
     * Authenticates the parameters back through Steam and returns the STEAM64 user id.
     *
     * @param Request $request
     * @return string
     */
    public function authenticate(Request $request): string
    {
        $params = $this->prepareSteamLoginParams($request);

        $response = $this->http->request('POST', self::STEAM_LOGIN, [
            'form_params' => $params,
        ]);

        $isValid = false;

        if ((int) $response->getStatusCode() === 200) {
            $isValid = strpos($response->getBody(), 'is_valid:true') !== false;
        }

        return $isValid ? $params['openid.claimed_id'] : '';
    }

    /**
     * Prepare params for Steam login validation.
     *
     * @param Request $request
     * @return array
     */
    public function prepareSteamLoginParams(Request $request): array
    {
        $params = [
			'openid.assoc_handle' => $request->get('openid_assoc_handle'),
			'openid.signed' => $request->get('openid_signed'),
			'openid.sig' => $request->get('openid_sig'),
			'openid.ns' => 'http://specs.openid.net/auth/2.0',
        ];

        $signedItems = explode(',', $request->get('openid_signed'));

		foreach($signedItems as $signedItem)
		{
            $openIdKey = 'openid_' . str_replace('.', '_', $signedItem);

            $value = $request->get($openIdKey);
            
			$params['openid.' . $signedItem] = $value;
        }
        
        $params['openid.mode'] = 'check_authentication';

        return $params;
    }
}
