<?php

namespace App\Http\Helpers;

use MyCLabs\Enum\Enum;

class Roles extends Enum
{
    public const ADMIN = 'Admin';
    public const SALES = "Sales";
}
