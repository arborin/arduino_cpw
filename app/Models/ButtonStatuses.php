<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ButtonStatuses extends Model
{
    use HasFactory;

    protected $fillable = ['button_pin', 'button_val', 'action_name'];
}
