<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    protected $fillable=['content'];

    public static function orderBy(string $string, string $string1)
    {
        //
    }

    public static function findOrFail($id)
    {
        //
    }
}
