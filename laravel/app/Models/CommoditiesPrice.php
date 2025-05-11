<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommoditiesPrice extends Model
{
    protected $table = 'commodities_prices';

    protected $fillable = ["commodity", "date", "value", "unit"];

    public $timestamps = false;

    public function unit(): BelongsTo
    {
         return $this->BelongsTo(CommoditiesPricesUnit::class, 'unit', 'id');
    }
}
