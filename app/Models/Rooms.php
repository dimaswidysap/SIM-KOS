<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Facilities;

class Rooms extends Model
{
    //
    protected $fillable = ['no_room','floor','price','status_room'];

    public function facilities()
    {
        return $this->belongsToMany(
            Facilities::class,
            'room_amenities',
            'id_room',
            'id_facility'
        );
    }
}
