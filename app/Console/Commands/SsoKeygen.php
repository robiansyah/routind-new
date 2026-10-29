<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Generates the Ed25519 key pair for single sign-on to Exam, Coretax and LMS.
 * The private key stays in Routind's .env; only the public key goes to the other apps.
 */
class SsoKeygen extends Command
{
    protected $signature = 'sso:keygen';

    protected $description = 'Generate the Ed25519 key pair for SSO tokens';

    public function handle(): int
    {
        $keyPair = sodium_crypto_sign_keypair();
        $private = base64_encode(sodium_crypto_sign_secretkey($keyPair));
        $public = base64_encode(sodium_crypto_sign_publickey($keyPair));

        $this->line('Routind .env (RAHASIA, jangan dibagikan):');
        $this->line("ROUTIND_SSO_PRIVATE_KEY={$private}");
        $this->newLine();
        $this->line('Exam, Coretax dan LMS .env (boleh dibagikan):');
        $this->line("ROUTIND_SSO_PUBLIC_KEY={$public}");

        return self::SUCCESS;
    }
}
