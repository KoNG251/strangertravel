<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;


class User extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use HasFactory;

    protected $fillable=[
        'fname',
        'lname',
        'gender',
        'tel',
        'email',
        'password',
        'citizenID',
        'user',
        'birthdate'
    ];

    public function groups()
    {
        return $this->belongsToMany(CreateGroup::class);
    }

    public function isMemberOfGroup($groupId)
    {
        return $this->groups()->where('id', $groupId)->exists();
    }
}
