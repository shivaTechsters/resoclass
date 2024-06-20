<?php 

namespace App\Enums;

enum Gender:string 
{
    case MALE = "MALE";
    case FEMALE = "FEMALE";
    case OTHER = "OTHER";

    public function label(): string {
        return ucwords(str_replace('_',' ',strtolower($this->name)));
    }
}