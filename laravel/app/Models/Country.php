<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
    protected $table = 'countries';

    public $timestamps = false;

    protected $fillable = ['name'];

    public function conflicts() : BelongsToMany
    {
        return $this->belongsToMany(ConflictTest2::class, 'involvment', 'country_id');
    }
}
