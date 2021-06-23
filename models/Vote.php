<?php namespace SunLab\UpDown\Models;

use Winter\Storm\Database\Model;

class Vote extends Model
{
    public $table = 'sunlab_updown_votes';

    protected $fillable = ['votable_type', 'votable_id'];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $morphTo = [
        'votable' => []
    ];
}
