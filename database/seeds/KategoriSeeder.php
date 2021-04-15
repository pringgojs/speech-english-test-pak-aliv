<?php

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput as Output;

class KategoriSeeder extends Seeder
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
        $this->output->writeln('<info>--- Kategori Seeder Started ---</info>');
        $array_data = array(
            'pelaksanaan' => ['Own Use', 'Bunker Umum', 'Loading ke PLN', 'Loading APMS PATRA' ],
            'agen_kapal' => [
                'PT. IKAN LUMBA - LUMBA', 'PT. PEL. BAHTERA ADIGUNA', 'PT. MULIA UTAMA BAHARI',
                'PT. PELNI CAB. BWI', 'PT. DJAKARTA LLOYD CAB BWI', 'PT. PELAYARAN NUSA TENGGARA', 'PT. BOSOWA TRADING  INTERNASIONAL'
            ],
            'jenis_kapal' => ['Penangkap Ikan', 'Pengangkut Ikan', 'Cargo', 'Cargo Semen', 'Cargo Pupuk', 'Cargo & Penumpang Perintis'],
            'harga' => ['PSO/SUBSIDI', 'KEEKONOMIAN'],
            'pemberi_order' => ['AHMAD ZAENI', 'AUFAR NUGROHO', 'FARCHAN KAMIL', 'PANDU PRASENA']
        );

        DB::beginTransaction();
        foreach($array_data as $index => $categories) {
            foreach ($categories as $value) {
                $kategori = new Kategori;
                $kategori->nama = $value;
                $kategori->tipe = $index;
                $kategori->save();
            }
        }
        DB::commit();
        $this->output->writeln('<info>--- Kategori Seeder Finished ---</info>');
    }
}
