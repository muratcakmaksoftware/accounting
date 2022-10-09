<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Company;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            'GARANTİ',
            'FİNANSBANK',
            'VAKIFBANK',
            'TURKISHBANK'
        ];

        foreach ($banks as $bank) {
            Bank::create([
                'name' => $bank,
            ]);
        }
    }
}
