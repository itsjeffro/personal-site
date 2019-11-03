<?php

namespace App\Itsjeffro;

class OauthTypes
{
    /** @var integer */
    const PASSWORD_GRANT_TYPE = 1;

    /** @var string */
    const PASSWORD_GRANT_NAME = 'Password';

    /** @var integer */
    const PERSONAL_ACCESS_GRANT_TYPE = 2;

    /** @var string */
    const PERSONAL_ACCESS_GRANT_NAME = 'Personal access';

    /** @var integer */
    const CLIENT_CREDENTIALS_GRANT_TYPE = 3;

    /** @var string */
    const CLIENT_CREDENTIALS_GRANT_NAME = 'Client credentials';

    /**
     * Undocumented function
     *
     * @param OauthClient|null $oauthClient
     * @return array
     */
    public function options() :array
    {
        return [
            self::PASSWORD_GRANT_TYPE => [
                'id' => self::PASSWORD_GRANT_TYPE,
                'name' => self::PASSWORD_GRANT_NAME,
            ],
            self::PERSONAL_ACCESS_GRANT_TYPE => [
                'id' => self::PERSONAL_ACCESS_GRANT_TYPE,
                'name' => self::PERSONAL_ACCESS_GRANT_NAME,
            ],
            self::PASSWORD_GRANT_TYPE => [
                'id' => PASSWORD_GRANT_TYPE,
                'name' => self::PASSWORD_GRANT_NAME,
            ],
        ];
    }
}
