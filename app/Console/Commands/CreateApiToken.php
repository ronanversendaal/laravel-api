<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;

class CreateApiToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:create-token {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an API token for authorisated requests';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $token = bin2hex($name.random_bytes(64));

        try{
            DB::table('api_tokens')->insert(['name' => $name, 'value' => $token]);

            $this->info('Token created!');
            $this->info($token);
        } catch (Exception $e){
            $this->info('Token creation failed!');
        }
    }
}
