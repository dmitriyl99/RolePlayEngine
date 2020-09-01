<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class CheckBan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:check-ban';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all banned users';

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
        $bannedUsers = User::query()->whereHas('bans', function (Builder $query) {
            $query->where('active', true);
        })->get();
        $now = now();
        /** @var User $user */
        foreach ($bannedUsers as $user) {
            /** @var \App\Ban $ban */
            $ban = $user->bans()->active()->first();
            if ($ban->expired_at < $now) {
                $user->unban();
                $this->info("Пользователь {$user->nickname} разбанен");
            }
        }
    }
}
