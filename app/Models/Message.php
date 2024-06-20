<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable=[
        'sender_id',
        'group_id',
        'type',
        'body',
    ];

    //relationships

    public function user()
    {
        return $this->belongsTo(userProfile::class,'sender_id');
    }
}
