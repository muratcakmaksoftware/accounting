<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    /**
     * @return array
     */
    abstract function rules(): array;

    /**
     * @return array
     */
    public function onlyRuleData(): array
    {
        return $this->only(array_keys($this->rules()));
    }
}
