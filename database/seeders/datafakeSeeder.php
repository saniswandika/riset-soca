<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class datafakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	$faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 50; $i++){
 
    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('pengaduans')->insert([
    			// 'pegawai_nama' => $faker->pegawai_nama,
                'no_pendaftaran' => $faker->name,
                'id_alur' => $faker->numberBetween(25,40),
                'id_provinsi' => $faker->numberBetween(1,2),
                'id_kabkot' => $faker->numberBetween(1,2),
                'id_kecamatan' => $faker->numberBetween(1,2),
                'id_kelurahan'=> $faker->numberBetween(1,2),
                'jenis_pelapor' => $faker->numberBetween(20,40),
                'ada_nik' => $faker->numberBetween(20,25),
                'nik' => $faker->numberBetween(25,30),
                'no_kk'=> $faker->numberBetween(16,20),
                'no_kis'=> $faker->numberBetween(20,50),
                'nama'=> $faker->name,
                'tgl_lahir'=> $faker->DateTime,
                'alamat'=> $faker->Address,
                'telp'=> $faker->PhoneNumber,
                'email'=> $faker->Text,
                'hubungan_terlapor'=> $faker->Text,
                'file_penunjang'=> $faker->Image,
                'keluhan_tipe'=> $faker->Text,
                'keluhan_id_program'=> $faker->numberBetween(5,12),
                'keluhan_detail'=> $faker->text,
                'keluhan_foto'=> $faker->Image,
                'tl_catatan'=> $faker->text,
                'tl_file'=> $faker->Image,
                'createdby'=> $faker->name,
                'updatedby'=> $faker->name,
                'ada_dtks' => $faker->text
    		]);
 
    	}
    }
}
