<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateUserRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:user-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate roles from model_has_roles to users table';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $userRoles = DB::table('model_has_roles')->get();

        foreach ($userRoles as $userRole) {
            DB::table('users')
                ->where('id', $userRole->model_id)
                ->update(['role_id' => $userRole->role_id]);
        }

        $this->info('Roles migrated successfully!');
    }
}
