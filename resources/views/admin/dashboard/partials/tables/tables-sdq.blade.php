<table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-white uppercase bg-secondary dark:bg-meta-4 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                No
            </th>
            <th scope="col" class="px-6 text-left py-3 whitespace-nowrap">
                Nama Lengkap
            </th>
            <th scope="col" class="px-6 py-3">
                Usia
            </th>
            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                Jenis Kelamin
            </th>
            <th scope="col" class="px-6 py-3">
                Sekolah
            </th>
            <th scope="col" class="px-6 py-3">
                Email
            </th>
            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                No Hp
            </th>
            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                Jenis Tes
            </th>
            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                Skor Gejala Emosional (E)
            </th>
            <th scope="col" class="px-30 py-3 whitespace-nowrap">
                Interpretasi (E)
            </th>
            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                Skor Masalah Perilaku (C)
            </th>
            <th scope="col" class="px-30 py-3 whitespace-nowrap">
                Interpretasi (C)
            </th>
            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                Skor Masalah Hiperaktifitas (H)
            </th>
            <th scope="col" class="px-30 py-3 whitespace-nowrap">
                Interpretasi (H)
            </th>
            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                Skor Masalah Teman Sebaya (P)
            </th>
            <th scope="col" class="px-30 py-3 whitespace-nowrap">
                Interpretasi (P)
            </th>
            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                Total Skor Kesulitan
            </th>
            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                Total Skor Kekuatan
            </th>
            <th scope="col" class="px-30 py-3 whitespace-nowrap">
                Interpretasi (Pro)
            </th>
            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                Kesimpulan Pemeriksaan
            </th>
            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                Tanggal Pemeriksaan
            </th>
        </tr>
    </thead>
    <tbody>
        @if (count($tableDataSDQ) <= 0)
            <tr>
                <td colspan="2" class="text-start py-8">Tidak ada data</td>
            </tr>
        @else
            @foreach ($tableDataSDQ as $row)
                <tr class="bg-white border-b dark:bg-boxdark">
                    <th scope="row" class="px-6 py-4 font-regular whitespace-nowrap dark:text-white">
                        {{ $row['no'] }}
                    </th>
                    <th scope="row" class="px-6 py-4 text-left font-regular whitespace-nowrap dark:text-white">
                        {{ $row['nama_lengkap'] }}
                    </th>
                    <td class="px-6 py-4 dark:text-white whitespace-nowrap">
                        {{ $row['usia'] }} Tahun
                    </td>
                    <td class="px-6 py-4 dark:text-white whitespace-nowrap">
                        {{ $row['jenis_kelamin'] }}
                    </td>
                    <td class="px-6 py-4 dark:text-white whitespace-nowrap">
                        {{ $row['sekolah'] }}
                    </td>
                    <td class="px-6 py-4 dark:text-white whitespace-nowrap">
                        {{ $row['email'] }}
                    </td>
                    <td class="px-6 py-4 dark:text-white">
                        {{ $row['no_hp'] }}
                    </td>
                    <td class="px-6 py-4 dark:text-white whitespace-nowrap">
                        {{ $row['jenis_tes'] }}
                    </td>
                    <td class="px-6 py-4 dark:text-white">
                        {{ $row['skor_emosional'] }}
                    </td>
                    <td class="px-0 py-4 dark:text-white whitespace-normal">
                        {{ $row['E'] }}
                    </td>
                    <td class="px-6 py-4 dark:text-white">
                        {{ $row['skor_perilaku'] }}
                    </td>
                    <td class="px-0 py-4 dark:text-white">
                        {{ $row['C'] }}
                    </td>
                    <td class="px-6 py-4 dark:text-white">
                        {{ $row['skor_hiperaktifitas'] }}
                    </td>
                    <td class="px-0 py-4 dark:text-white">
                        {{ $row['H'] }}
                    </td>
                    <td class="px-6 py-4 dark:text-white">
                        {{ $row['skor_teman_sebaya'] }}
                    </td>
                    <td class="px-0 py-4 dark:text-white">
                        {{ $row['P'] }}
                    </td>
                    <td class="px-6 py-4 dark:text-white">
                        {{ $row['total_skor_kesulitan'] }}
                    </td>
                    <td class="px-6 py-4 dark:text-white">
                        {{ $row['total_skor_kekuatan'] }}
                    </td>
                    <td class="px-0 py-4 dark:text-white">
                        {{ $row['Pro'] }}
                    </td>
                    <td class="px-6 py-4 dark:text-white">
                        {{ $row['kesimpulan'] }}
                    </td>
                    <td class="px-6 py-4 dark:text-white whitespace-nowrap">
                        {{ $row['tanggal_pemeriksaan'] }}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
