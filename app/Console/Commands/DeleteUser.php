<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class DeleteUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete {nickname: The user\'s nickname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete user by nickname';

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
     * @return void
     */
    public function handle()
    {
        $nickname = $this->argument('nickname');
        $user = User::query()->where('nickname', $nickname)->first();
        if (is_null($user)) {
            $this->error("User with nickname $nickname not found");
            return;
        }
        $user->forceDelete();
        $this->info("User with nickname $nickname deleted");
    }
}
