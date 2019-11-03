<?php

namespace App\Itsjeffro;

use Laravel\Passport\Client;

class OauthClient extends Client
{
    /**
     * Returns grant type name.
     *
     * @return string
     */
    public function getGrantTypeNameAttribute(): string
    {
        if ($this->personal_access_client) {
            return OauthTypes::PERSONAL_ACCESS_GRANT_NAME;
        }

        if ($this->password_client) {
            return OauthTypes::PASSWORD_GRANT_NAME;
        }

        if (empty($this->password_client) && empty($this->personal_access_client)) {
            return OauthTypes::CLIENT_CREDENTIALS_GRANT_NAME;
        }

        return '';
    }

    /**
     * Returns grant type id.
     *
     * @return int
     */
    public function getGrantTypeIdAttribute(): int
    {
        if ($this->personal_access_client) {
            return OauthTypes::PERSONAL_ACCESS_GRANT_TYPE;
        }

        if ($this->password_client) {
            return OauthTypes::PASSWORD_GRANT_TYPE;
        }

        if (empty($this->password_client) && empty($this->personal_access_client)) {
            return OauthTypes::CLIENT_CREDENTIALS_GRANT_TYPE;
        }

        return 0;
    }
}
