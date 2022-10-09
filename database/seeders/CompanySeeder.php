<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            'UNİNATİON',
            'VEİCHİ',
            'FONKSİYONEL',
            'MUSTAFA ÇOPUOĞLU'
        ];

        foreach ($companies as $company) {
            Company::create([
                'name' => $company,
            ]);
        }
    }
}
