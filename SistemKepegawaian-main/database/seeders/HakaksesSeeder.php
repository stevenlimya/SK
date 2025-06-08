<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hakakses;

class HakaksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hakakses = [
            [
                "hakakses" => "HRD",
                "created_by" => 1,
            ],
            [
                "hakakses" => "Karyawan",
                "created_by" => 1,
            ],
            [
                "hakakses" => "Direktur",
                "created_by" => 1,
            ],
        ];
        foreach ($hakakses as $hakakses) {
            Hakakses::create([
                'hakakses' => $hakakses['hakakses'],
                'created_by' => $hakakses['created_by'],
            ]);
        };        
    }
}
