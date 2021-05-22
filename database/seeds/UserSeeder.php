<?php

use App\User;
use Bican\Roles\Models\Role;
use App\Models\PermissionUser;
use Illuminate\Database\Seeder;
use Bican\Roles\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Output\ConsoleOutput as Output;

class UserSeeder extends Seeder
{
    /**
     * @var Output
     */
    private $output;

    public function __construct(Output $output)
    {
        $this->output = $output;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Model::unguard();
        DB::beginTransaction();

        self::role();
        self::user();
        self::attachUserPermision();

        DB::commit();
        Model::reguard();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    public function user()
    {
        $this->output->writeln('<info>--- User Seeder Started ---</info>');
        
        $user = new User;
        $user->name = 'admin';
        $user->username = 'admin';
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('admin');
        $user->save();
        $user->attachRole(1);

        $this->output->writeln('<info>--- User Seeder Finished ---</info>');
    }

    public function role()
    {
        $this->output->writeln('<info>--- Role Seeder Started ---</info>');
        // role
        $admin_role = Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator'
        ]);

        $admin_role = Role::create([
            'name' => 'Student',
            'slug' => 'student'
        ]);

        $this->output->writeln('<info>--- Role Seeder Finished ---</info>');
    }

    public function attachUserPermision()
    {
        $this->output->writeln('<info>--- Attach permision Seeder Started ---</info>');
        // Attact all permission to user all administrator
        $permissions = Permission::get();
        $users = User::all();
        $role = Role::find(1);
        foreach ($users as $user) {
            foreach ($permissions as $permission) {
                $role->attachPermission($permission);
                $user->attachPermission($permission);
            }
        }        
        $this->output->writeln('<info>--- Attach permision Seeder Finished ---</info>');
    }
}
