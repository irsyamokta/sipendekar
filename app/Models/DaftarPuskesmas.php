<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPuskesmas extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected static function getDummyData()
    {
        return [
            ['id' => 1, 'name' => 'AJIBARANG I', 'address' => 'Jl. Raya Ajibarang-Purwokerto RT 2 RW 5 Ds. Ajibarang Wetan'],
            ['id' => 2, 'name' => 'AJIBARANG II', 'address' => 'Ds. Kalibenda, Kec. Ajibarang'],
            ['id' => 3, 'name' => 'BANYUMAS', 'address' => 'Jl. Gatot Subroto No. 181, Kec. Banyumas'],
            ['id' => 4, 'name' => 'BATURADEN I', 'address' => 'Jl.Raya Kebumen No.1 Kec.Baturraden'],
            ['id' => 5, 'name' => 'BATURADEN II', 'address' => 'Jl.Brigade No.17 Kec.Baturraden'],
            ['id' => 6, 'name' => 'CILONGOK I', 'address' => 'Jl.Raya Cikidang Cilongok-Ajibarang Kec.Cilongok'],
            ['id' => 7, 'name' => 'CILONGOK II', 'address' => 'Jl.Raya Jatisaba Desa Jatisaba Kec.Cilongok'],
            ['id' => 8, 'name' => 'GUMELAR', 'address' => 'Jl. Raya Gumelar No.34 RT 03 RW 01 Ds.Gumelar'],
            ['id' => 9, 'name' => 'JATILAWANG', 'address' => 'Jl. Raya Jatilawang, Ds. Tunjung, Kec. Jatilawang'],
            ['id' => 10, 'name' => 'KALIBAGOR', 'address' => 'Jl. Suwardjono No. 48 Kec. Kalibagor'],
            ['id' => 11, 'name' => 'KARANG LEWAS', 'address' => 'Jl. Raya Karangkemiri No. 19, Karang Lewas'],
            ['id' => 12, 'name' => 'KEBASEN', 'address' => 'Jl. Raya PUK Kebasen Kec. Kebasen'],
            ['id' => 13, 'name' => 'KEDUNG BANTENG', 'address' => 'Jl.Raya Kedungbanteng No.380 Kec.Kedungbanteng'],
            ['id' => 14, 'name' => 'KEMBARAN I', 'address' => 'Jl.Raya Sokaraja-Sumbang RT 1 RW VI Ds.Linggasari'],
            ['id' => 15, 'name' => 'KEMBARAN II', 'address' => 'Jl.Raya Kramat No.1 RT 06 RW 1 Ds.Kramat'],
            ['id' => 16, 'name' => 'KEMRANJEN I', 'address' => 'Jl. Assistenan No. 301, Kec. Kemrajen'],
            ['id' => 17, 'name' => 'KEMRANJEN II', 'address' => 'Jl. Raya Perempatan Buntu, Desa Sidamulya'],
            ['id' => 18, 'name' => 'LUMBIR', 'address' => 'Jl. Raya Lumbir, Kec. Lumbir'],
            ['id' => 19, 'name' => 'PATIK RAJA', 'address' => 'Jl. Raya Notog No. 81, Kec. Patik Raja'],
            ['id' => 20, 'name' => 'PEKUNCEN I', 'address' => 'Ajibarang Tegal Rt 02 RW 4 No 5 , Desa Banjaranyar, Kec. Pekuncen'],
            ['id' => 21, 'name' => 'PURWOJATI', 'address' => 'Jl. Raya Inpres Purwojati RT 1 RW 3'],
            ['id' => 22, 'name' => 'PURWOKERTO BARAT', 'address' => 'Jl. H. Mashuri No. 37 B RT 02 RW 01 Rejasari Kec. Purwokerto Barat'],
            ['id' => 23, 'name' => 'PURWOKERTO SELATAN', 'address' => 'Jl. Mr.Moch. Yamin kel. Karang Klesem, Kec. Purwokerto Selatan'],
            ['id' => 24, 'name' => 'PURWOKERTO TIMUR I', 'address' => 'Jl. Adipati Mersi No. 51, Kec. Purwokerto Timur'],
            ['id' => 25, 'name' => 'PURWOKERTO TIMUR II', 'address' => 'Jl.Adyaksa RT 8 RW 4 Kranji Kec.Purwokerto Timur'],
            ['id' => 26, 'name' => 'PURWOKERTO UTARA I', 'address' => 'Jl. Beringin No. 1, Kec. Purwokerto Utara'],
            ['id' => 27, 'name' => 'PURWOKERTO UTARA II', 'address' => 'Jl.Jatisari RT 3 RW 5 Kel.Sumampir'],
            ['id' => 28, 'name' => 'RAWALO', 'address' => 'Jl. HM. Bachrun No. 369, Kec. Rawalo'],
            ['id' => 29, 'name' => 'SOKARAJA I', 'address' => 'Jl.Jenderal Soeparto No.5 Kec.Sokaraja'],
            ['id' => 30, 'name' => 'SOKARAJA II', 'address' => 'Jl.Raya Sokaraja-Purbalingga Ds.Banjarsari Kidul'],
            ['id' => 31, 'name' => 'SOMAGEDE', 'address' => 'Jl. Raya Somagede RT 4 RW 1 Somagede'],
            ['id' => 32, 'name' => 'SUMBANG I', 'address' => 'Jl.Raya Baturraden Timur Ds.Sumbang Kec.Sumbang'],
            ['id' => 33, 'name' => 'SUMBANG II', 'address' => 'Jl. Baturaden Timur No. 35, Kec. Sumbang'],
            ['id' => 34, 'name' => 'SUMPIUH I', 'address' => 'Jl. Raya Barat Sumpiuh Desa Kebokura'],
            ['id' => 35, 'name' => 'SUMPIUH II', 'address' => 'Jl. Raya Sumpiuh Timur, Kec. Sumpiuh'],
            ['id' => 36, 'name' => 'TAMBAK I', 'address' => 'Jl. Raya Barat Tambak, Kec. Tambak'],
            ['id' => 37, 'name' => 'TAMBAK II', 'address' => 'Jl. Balai Desa Pesantren No. 28, Kec. Tambak'],
            ['id' => 38, 'name' => 'WANGON I', 'address' => 'Jl. Raya Wangon No.59 Wangon, Kec. Wangon'],
            ['id' => 39, 'name' => 'WANGON II', 'address' => 'Jl. Raya Wangon Aji barang Km 6, Kec. Wangon'],
        ];
    }

}
