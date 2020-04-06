<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $guarded = [];

    public function getStatusAttribute($attribute)
    {
        return [
            0 => 'Open',
            1 => 'Pending',
            2 => 'Rejected',
            3 => 'Approved'
        ][$attribute];
    }    

    public function User()
    {
        return $this->belongsTo(User::class);
           
    }
}
