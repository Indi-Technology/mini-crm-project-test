<?php

namespace App;

enum RoleEnum: string
{
    case ADMINISTRATOR = 'administrator';
    case AGENT = 'agent';
    case REGULAR = 'regular';
}
