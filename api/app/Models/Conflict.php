<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conflict extends Model
{
    protected $table = 'conflicts';

    public $timestamps = false;

    protected $fillable = ['conflict_id',
        'location',
        'side_a',
        'side_a_2nd',
        'side_b',
        'side_b_2nd',
        'incompatibility',
        'territory_name',
        'year',
        'intensity_level',
        'cumulative_intensity',
        'type_of_conflict',
        'start_date',
        'start_date_2nd',
        'end_date',
        'region'];
}
