<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CommoditiesPricesUnit extends Model
{
    protected $table = 'commodities_prices_units';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function prices(): HasMany
    {
        return $this->hasMany(CommoditiesPrice::class, 'unit', 'id');
    }
}
