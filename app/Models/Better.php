<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Better extends Model
{
    use HasFactory;
    public function horses()
    {
        return $this->belongsTo('App\Models\Better', 'horse_id', 'id');
    }
}
