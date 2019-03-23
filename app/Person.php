<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'age', 'address', 'phoneNumber', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

   
}
