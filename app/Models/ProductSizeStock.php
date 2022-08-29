<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizeStock extends Model
{
    use HasFactory;

    public function size() {
        return $this->belongsTo(Size::class);
    }
}
