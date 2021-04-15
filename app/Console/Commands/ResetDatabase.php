<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Filesystem\Filesystem;
use App\Models\Migration;

class ResetDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset database and seeding data';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::beginTransaction();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        $array = [];
        foreach(DB::select('SHOW TABLES') as $table) {
            $table_array = get_object_vars($table);
            if (!in_array($table_array[key($table_array)], $array)) {
                \Schema::drop($table_array[key($table_array)]);
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        
        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true, '--class' => 'DatabaseSeeder']);
        self::copyVendorWordLib();
        DB::commit();
    }

    public function ignoreMigration()
    {
        Migration::truncate(); // remove all row in migration
        
        $list_ignore_migration = [
            '2019_09_01_211823_create_tabel_astm_table'
        ];

        foreach ($list_ignore_migration as $ignore_migration) {
            $migration = new Migration;
            $migration->migration = $ignore_migration;
            $migration->batch = 1;
            $migration->save();
        }
    }

    public static function copyVendorWordLib()
    {
        $source = 'app/WordPlugin/TemplateProcessor.php';
        $destination = 'vendor/phpoffice/phpword/src/PhpWord/TemplateProcessor.php';
        $success = \File::copy($source, $destination);

        info('copied');
    }
}
