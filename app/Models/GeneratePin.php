<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratePin extends Model
{
    use HasFactory;

    protected $table = 'generate_pins';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pin', 'status'
    ];
}
