<?php 

namespace App\Enums;

enum Permission: string
{
    case VIEW_ACCESS = 'VIEW_ACCESS';
    case ADD_ACCESS = 'ADD_ACCESS';
    case EDIT_ACCESS = 'EDIT_ACCESS';
    case DELETE_ACCESS = 'DELETE_ACCESS';

    case VIEW_REGISTRATION = 'VIEW_REGISTRATION';
    case ADD_REGISTRATION = 'ADD_REGISTRATION';
    case EDIT_REGISTRATION = 'EDIT_REGISTRATION';
    case DELETE_REGISTRATION = 'DELETE_REGISTRATION';

    case MANAGE_ROLES_AND_PERMISSION = 'MANAGE_ROLES_AND_PERMISSION';

    public function label(): string {
        return ucwords(str_replace('_',' ',strtolower($this->name)));
    }
}