<?php

use Illuminate\Database\Seeder;

class EmployeeCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_categories')->insert([
            'name' => 'AGENTE',
            'status' => true,
            'created_at' => (new \DateTime('NOW'))->format('Y-m-d h:i:s'),
            'updated_at' => (new \DateTime('NOW'))->format('Y-m-d h:i:s')
        ]);
    }
}
