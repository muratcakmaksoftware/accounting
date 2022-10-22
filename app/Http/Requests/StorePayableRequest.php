<?php

namespace App\Http\Requests;

use App\Helpers\FormatHelper;

class StorePayableRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        if($this->has('price')){
            $this->request->set('price', FormatHelper::getCurrencyFormInputFix($this->get('price')));
        }

        return [
            'company_id' => 'required|integer',
            'currency_type_id' => 'required|integer',
            'payment_method_type_id' => 'required|integer',
            'price' => 'required|numeric',
            'expires_at' => 'required|date',
            'description' => 'string',
        ];
    }
}
