<?php

namespace App\Models;

use App\Traits\ModelFormatTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payable extends BaseModel
{
    use HasFactory, SoftDeletes, ModelFormatTrait;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * @var string[]
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'expires_at'];

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return BelongsTo
     */
    public function currencyType(): BelongsTo
    {
        return $this->belongsTo(CurrencyType::class);
    }

    /**
     * @return BelongsTo
     */
    public function paymentMethodType(): BelongsTo
    {
        return $this->belongsTo(PaymentMethodType::class);
    }
}
