<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blogs extends Model
{
    protected $fillable = [
        'title','description'
    ];
}
