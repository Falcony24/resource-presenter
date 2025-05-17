<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConflictTest extends Model
{
    public $timestamps = false;

    protected $table = 'conflict_test';

    protected $fillable = [
        'name',
        'conflict_wiki_url',
        'location',
        'location_wiki_url',
        'side_a_other_sides',
        'side_b_other_sides',
        'start_date_accuracy',
        'start_date',
        'end_date_accuracy',
        'end_date',
        'is_active',
        'casualties_low',
        'casualties_hig',
        'description_complete',
    ];
}
