<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(roleSeeder::class);
    }

}

class userSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'admin',
            'email'=>'admin',
            'password'=>bcrypt('admin'),
            'role_id'=>1,
        ]);
    }
}

class roleSeeder extends Seeder
{
    public function run()
    {
        DB::table('role')->insert([
            ['role_name'=>'admin'],
            ['role_name'=>'Quản lý']
        ]);
    }
}
