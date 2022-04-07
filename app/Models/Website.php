<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'email',
    ];


    //get subscribers of a website
    public function subscribtions()
    {
        return $this->hasMany(Subscribtion::class);
    }

    //get posts of a website
    public function posts()
    {
        return $this->hasMany(Post::class);
    }



}
