<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
