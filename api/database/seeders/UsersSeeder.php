<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Schema::disableForeignKeyConstraints();

        DB::table('users')->truncate();

        $units = [
            [
                'id' => 0,
                'name' => 'Admin',
                'email' => 'admin@influendoo.com',
                'password' => 'admin',
                'role' => 'admin',
            ],
            [
                'id' => 1,
                'name' => 'Client',
                'email' => 'client@influendoo.com',
                'password' => 'admin',
                'role' => 'client',
            ],
        ];

        foreach ($units as $unit) {
            User::create($unit);
        }

        Schema::enableForeignKeyConstraints();
        Model::reguard();
    }
}
