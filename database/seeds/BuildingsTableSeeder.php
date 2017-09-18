<?php

use Illuminate\Database\Seeder;

class BuildingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($cont = 0; $cont < 10; $cont++) {
            DB::table('buildings')->insert([
                'name' => 'UNIDADE TESTE #'.$cont,
                'address' => 'ENDEREÇO UNIDADE TESTE #'.$cont,
                'description' => 'DESCRIÇÃO UNIDADE TESTE #'.$cont,
                'status' => true
            ]);
        }
    }
}
