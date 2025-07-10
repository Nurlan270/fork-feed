<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class GenerateReverbKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reverb:generate {--f|force : Force the operation to run without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Reverb keys for the application';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if (!file_exists(base_path('.env')))
            $this->fail('.env file not found. Please create it first.');

        if (!$this->option('force')) {
            $isset = true;

            $keys = Config::getMany([
                'broadcasting.connections.reverb.app_id',
                'broadcasting.connections.reverb.key',
                'broadcasting.connections.reverb.secret',
            ]);

            foreach ($keys as $key) {
                if (empty($key)) $isset = false;
            }

            if ($isset
                && $this->confirm('Reverb keys already exist. Do you want to overwrite them?', true)
            ) {
                $this->generateKeys();

                $this->info('🎉 Reverb keys generated successfully!');
                $this->info("Run `./vendor/bin/sail npm run build` to make sure Websockets work properly.");
            }
        } else {
            $this->generateKeys();

            $this->info('🎉 Reverb keys generated successfully!');
            $this->info("Run `./vendor/bin/sail npm run build` to make sure Websockets work properly.");
        }
    }

    protected function generateKeys(): void
    {
        $envFile = base_path('.env');
        $appId = mt_rand(100000, 999999);
        $appKey = Str::random(20);
        $appSecret = Str::random(20);

        Env::writeVariable('REVERB_APP_ID', $appId, $envFile, true);
        Env::writeVariable('REVERB_APP_KEY', $appKey, $envFile, true);
        Env::writeVariable('REVERB_APP_SECRET', $appSecret, $envFile, true);
    }
}
