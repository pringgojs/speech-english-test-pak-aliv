<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Filesystem\Filesystem;

class FixVendor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:word';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Digunakan untuk memperbaiki bug FindReplace di PhpWordPlugin';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        self::copyVendorWordLib();
    }

    public static function copyVendorWordLib()
    {
        $source = 'app/WordPlugin/TemplateProcessor.php';
        $destination = 'vendor/phpoffice/phpword/src/PhpWord/TemplateProcessor.php';
        $success = \File::copy($source, $destination);

        info('copied');
    }
}
