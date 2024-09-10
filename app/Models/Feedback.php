<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'feedbacks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama', 'sekolah', 'umpan_balik'
    ];
}
