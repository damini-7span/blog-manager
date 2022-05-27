<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                "name" => "admin",
                "guard_name" => "api"
            ],
            [
                "name" => "user",
                "guard_name" => "api"
            ]
        ]);
    }
}
