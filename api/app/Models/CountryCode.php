<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryCode extends Model
{
    protected $table = 'country_code';

    public $timestamps = false;

    protected $fillable = ['iso_name',
        'official_state_name',
        'other_names',
        'wiki_link',
        'iso_a-2_code',
        'iso_a-3_code',
        'iso_num_code',
    ];
}
