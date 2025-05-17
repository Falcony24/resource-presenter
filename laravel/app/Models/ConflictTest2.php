<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ConflictTest2 extends Model
{
    protected $table = 'conflicts_test_2';

    public $timestamps = false;

    public $fillable = [
        'name',
        'link',
        'start_date',
        'end_date',
        'casualties',
    ];

    public function countries() : BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'involvment', 'conflict_id');
    }
}
