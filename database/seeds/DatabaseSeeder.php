<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(TopicSeeder::class);
    }
}
