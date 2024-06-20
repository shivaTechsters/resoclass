<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResoStudent extends Model
{
    use HasFactory;

    protected $fillable  = [
        'neet_application_no',
        'name',
        'father_name',
        'date_of_birth',
        'gender',
        'email',
        'neet_registred_mobile_no',
        'alternate_number',
        'examination_center'
    ];
}
