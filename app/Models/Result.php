<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable  = [
        'admit_card_no',
        'phone',
        'bot_marks',
        'zoo_marks',
        'phy_marks',
        'che_marks',
        'total_marks',
        'percentage',
        'rank',
    ];
}
