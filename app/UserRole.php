<?php

namespace App;

enum UserRole: string
{
    case ADMINISTRATOR = 'administrator';
    case USER = 'user';
    case MANAGER = 'manager';
}
