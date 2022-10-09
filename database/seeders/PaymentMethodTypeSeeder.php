<?php

namespace Database\Seeders;

use App\Models\PaymentMethodType;
use Illuminate\Database\Seeder;

class PaymentMethodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentMethodTypes = [
            'Yurt Dışı Ödeme',
            'Yurt İçi Ödeme',
            'Vergi',
            'Kredi',
            'Alacak',
            'Çek'
        ];

        foreach ($paymentMethodTypes as $paymentMethodType) {
            PaymentMethodType::create([
                'name' => $paymentMethodType,
            ]);
        }
    }
}
