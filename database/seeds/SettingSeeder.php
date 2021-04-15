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
                'name' => 'Approval ke Sr. Spv. RSD',
                'description' => 'Pengaturan approval ke pegawai yang mempunyai jabatan Sr. Spv. RSD',
                'key' => 'spv_rsd',
                'value' => 2,
                'input_type' => 'user',
            ],
            1 => [
                'name' => 'Approval ke OH ',
                'description' => 'Pengaturan approval ke pegawai yang mempunyai jabatan OH',
                'key' => 'spv_oh',
                'value' => 3,
                'input_type' => 'user',
            ],
            2 => [
                'name' => 'Approval ke Spv. EPM ',
                'description' => 'Pengaturan approval ke pegawai yang mempunyai jabatan Spv. EPM',
                'key' => 'spv_epm',
                'value' => 4,
                'input_type' => 'user',
            ]
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
