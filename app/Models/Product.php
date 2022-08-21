<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // CONSTANTS
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
}
