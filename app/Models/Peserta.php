<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;
    protected $table = 'pesertas';
    protected $guarded = ['id_peserta'];

    protected $fillable = [
        'nama_lengkap', 'tanggal_lahir', 'jenis_kelamin', 'nomor_hp', 'email', 'alamat', 'kelurahan', 'kecamatan', 'kabupaten', 'token'
    ];

    public function sdqResponses()
    {
        return $this->hasMany(SDQResponse::class, 'participant_id', 'id_peserta');
    }
    public function srqResponses()
    {
        return $this->hasMany(SRQResponse::class, 'participant_id', 'id_peserta');
    }
}
