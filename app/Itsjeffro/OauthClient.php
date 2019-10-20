<?php

namespace App\Itsjeffro;

use Laravel\Passport\Client;

class OauthClient extends Client
{
    /** @var integer */
    const PASSWORD_GRANT_TYPE = 1;

    /** @var string */
    const PASSWORD_GRANT_NAME = 'Password';

    /** @var integer */
    const PERSONAL_ACCESS_GRANT_TYPE = 2;

    /** @var string */
    const PERSONAL_ACCESS_GRANT_NAME = 'Personal access';

    /**
     * Returns grant type name.
     *
     * @return string
     */
    public function getGrantTypeNameAttribute(): string
    {
        if ($this->personal_access_client) {
            return self::PERSONAL_ACCESS_GRANT_NAME;
        }

        if ($this->password_client) {
            return self::PASSWORD_GRANT_NAME;
        }

        return '';
    }
}
