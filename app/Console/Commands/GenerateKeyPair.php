<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Passport\Passport;
use phpseclib3\Crypt\RSA;

class GenerateKeyPair extends Command
{
    protected $signature = 'platform:keys
                            {--name=platform : The file name of the key pairs}
                            {--force : Overwrite keys if they already exist}
                            {--length=4096 : The length of the private key}';

    protected $description = 'Generate a key pair.';

    public function handle(): int
    {
        $name = $this->option('name');

        [$publicKey, $privateKey] = [
            Passport::keyPath("$name-public.key"),
            Passport::keyPath("$name-private.key"),
        ];

        if ((file_exists($publicKey) || file_exists($privateKey)) && ! $this->option('force')) {
            $this->components->error('The encryption keys already exist. Use the --force option to overwrite them.');

            return static::FAILURE;
        }

        $key = RSA::createKey($this->input ? (int) $this->option('length') : 4096);

        file_put_contents($publicKey, (string) $key->getPublicKey());
        file_put_contents($privateKey, (string) $key);

        if (! windows_os()) {
            chmod($publicKey, 0660);
            chmod($privateKey, 0600);
        }

        $this->components->info('The encryption keys were successfully generated.');

        return static::SUCCESS;
    }
}
