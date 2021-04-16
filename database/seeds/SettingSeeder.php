<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput as Output;

class SettingSeeder extends Seeder
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
        $this->output->writeln('<info>--- Settings Seeder Started ---</info>');
        $data = array(
            0 => [
                'name' => 'Logo Login',
                'description' => 'Logo dihalaman login',
                'key' => 'logo_login',
                'value' => 'dist/img/pertamina.png',
                'input_type' => 'file',
            ],
            1 => [
                'name' => 'Background Login ',
                'description' => 'Background gambar di halaman login',
                'key' => 'background_login',
                'value' => 'dist/img/bg-tbbm-wangi.jpeg',
                'input_type' => 'file',
            ],
            2 => [
                'name' => 'Favicon',
                'description' => 'Favicon',
                'key' => 'favicon',
                'value' => 'favicon.ico',
                'input_type' => 'file',
            ],
            3 => [
                'name' => 'Logo Sidebar App',
                'description' => 'Logo sidebar halaman admin',
                'key' => 'logo_sidebar',
                'value' => 'dist/img/pertamina.png',
                'input_type' => 'file',
            ],
        );

        DB::beginTransaction();
        for ($i=0; $i<count($data); $i++) {
            \DB::table('settings')->insert(
                $data[$i]
            );
        }

        DB::commit();
        $this->output->writeln('<info>--- Settings Seeder Finished ---</info>');
    }
}
