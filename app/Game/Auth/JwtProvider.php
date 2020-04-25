<?php

namespace App\Game\Auth;

use Lcobucci\JWT\Signer\Keychain;
use RuntimeException;
use Tymon\JWTAuth\Contracts\Providers\JWT;
use Tymon\JWTAuth\Providers\JWT\Lcobucci;

class JwtProvider extends Lcobucci implements JWT
{
    /**
     * {@inheritdoc}
     */
    protected function getSigningKey()
    {
        if ($this->isAsymmetric()) {
            $privateKey = $this->getPrivateKey();

            if (!file_exists($privateKey)) {
                throw new RuntimeException(sprintf('Path [%s] does not exist', $privateKey));
            }

            return (new Keychain())->getPrivateKey(file_get_contents($privateKey), $this->getPassphrase());
        }
    
        return $this->getSecret();
    }

    /**
     * {@inheritdoc}
     */
    protected function getVerificationKey()
    {
        if ($this->isAsymmetric()) {
            $publicKey = $this->getPublicKey();

            if (!file_exists($publicKey)) {
                throw new RuntimeException(sprintf('Path [%s] does not exist', $publicKey));
            }

            return (new Keychain())->getPublicKey(file_get_contents($publicKey));
        }

        return $this->getSecret();
    }
}
