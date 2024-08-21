<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SRQResponse extends Model
{
    use HasFactory;

    protected $table = 'srq_responses';

    protected $fillable = [
        'participant_id',
        'question_id',
        'test_type',
        'score',
        'date'
    ];

    public function participant()
    {
        return $this->belongsTo(Peserta::class, 'participant_id', 'id_peserta');
    }

    public function question()
    {
        return $this->belongsTo(InstrumenSRQ::class, 'question_id', 'id_srq');
    }
}
