<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arduinos extends Model
{
    use HasFactory;

    protected $fillable = ['arduino_name', 'arduino_ip', 'comment'];
}
