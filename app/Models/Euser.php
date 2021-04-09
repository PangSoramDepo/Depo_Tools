<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Euser extends Model
{
    use HasFactory;

    protected $table = "users";

    protected $guarded = [];

    public $timestamps = false;
}
