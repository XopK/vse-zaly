<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteOldPasswordResetTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password_resets:delete-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Удаление устаревших токенов сброса пароля (старше 1 часа)';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::table('password_resets')->where('created_at', '<', Carbon::now()->subHour())
            ->delete();

        $this->info('Старые токены сброса пароля удалены.');
    }
}
