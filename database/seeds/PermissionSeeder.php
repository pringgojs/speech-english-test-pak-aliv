<?php

use App\User;
use Bican\Roles\Models\Role;
use Illuminate\Database\Seeder;
use App\Helpers\PermissionHelper;
use Bican\Roles\Models\Permission;
use Symfony\Component\Console\Output\ConsoleOutput as Output;

class PermissionSeeder extends Seeder
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
        $this->output->writeln('<info>--- Permission Seeder Started ---</info>');
        self::permission();
        $this->output->writeln('<info>--- Permission Seeder Finished ---</info>');
        
    }

    public function permission()
    {
        $this->output->writeln('<info>--- Permission Seeder Started ---</info>');

        
        $group = 'USER';
        PermissionHelper::create($group, ['create', 'read', 'update', 'delete', 'permission'], $group);
        $this->output->writeln('<info>updated user permission</info>');
        
        $group = 'SETTING';
        PermissionHelper::create($group, ['menu', 'create', 'read', 'update', 'delete'], $group);
        $this->output->writeln('<info>updated setting permission</info>');

        $group = 'MASTER';
        PermissionHelper::create('MASTER KATEGORI', ['create', 'read', 'update', 'delete'], $group);
        $this->output->writeln('<info>updated master permission</info>');
        
    }
}
