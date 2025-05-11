<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CommoditiesType extends Model
{
    protected $table = 'commodities_types';

    protected $fillable = ["name", "description"];

    public function prices(): HasMany
    {
        return $this->HasMany(CommoditiesPrice::class, 'commodity', 'id');
    }
}
