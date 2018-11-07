<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Status extends Model
{
    //
    protected $fillable = [
        'content', 'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
