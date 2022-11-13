<?php

namespace App\Models;

use App\Traits\ModelFormatTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethodType extends BaseModel
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
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return HasMany
     */
    public function payables(): HasMany
    {
        return $this->hasMany(Payable::class);
    }

    /**
     * @return HasMany
     */
    public function receivables(): HasMany
    {
        return $this->hasMany(Receivable::class);
    }
}
