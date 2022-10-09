<?php

namespace Database\Seeders;

use App\Models\CurrencyType;
use Illuminate\Database\Seeder;

class CurrencyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            ['name' => 'Türk Lirası', 'sembol' => '₺'],
            ['name' => 'Dolar', 'sembol' => '$'],
        ];

        foreach ($currencies as $currency) {
            CurrencyType::create([
                'name' => $currency['name'],
                'sembol' => $currency['sembol'],
            ]);
        }
    }
}
