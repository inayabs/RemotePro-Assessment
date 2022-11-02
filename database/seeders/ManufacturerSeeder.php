<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use Illuminate\Database\Seeder;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Manufacturer::insert([
            [
                'name'=>'Toyota Motor Corp'
            ],
            [
                'name'=>'Volkswagen AG'
            ],
            [
                'name'=>'Daimler'
            ],
            [
                'name'=>'Honda'
            ],
            [
                'name'=>'Ford'
            ],
        ]);
    }
}
