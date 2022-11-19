<?php

namespace Database\Seeders;

use App\Helpers\CalculationHelper;
use App\Models\Bank;
use App\Models\CurrencyType;
use Illuminate\Database\Seeder;

class BankCurrencyTotalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = Bank::all();
        $currencyTypes = CurrencyType::all();

        /** @var Bank $bank */
        foreach ($banks as $bank) {
            $bankCurrencyTotals = [];
            foreach ($currencyTypes as $currencyType) {
                $bankCurrencyTotals[] = [
                    'currency_type_id' => $currencyType->id,
                    'balance' => CalculationHelper::randomDecimal(1000, 50000)
                ];
            }
            $bank->bankAccounts()->createMany($bankCurrencyTotals);
        }
    }
}
