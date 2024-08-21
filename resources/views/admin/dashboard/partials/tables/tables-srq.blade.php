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
            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                Alamat
            </th>
            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                Email
            </th>
            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                No Hp
            </th>
            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                Jenis Tes
            </th>
            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                Total Score
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
        @if (count($tableDataSRQ) <= 0)
            <tr>
                <td colspan="2" class="text-start py-8">Tidak ada data</td>
            </tr>
        @else
            @foreach ($tableDataSRQ as $row)
                <tr class="bg-white border-b dark:bg-boxdark">
                    <th scope="row" class="px-6 py-4 font-regular text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $row['no'] }}
                    </th>
                    <th scope="row" class="px-6 text-left py-4 font-regular text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $row['nama_lengkap'] }}
                    </th>
                    <td class="px-6 py-4 dark:text-white whitespace-nowrap">
                        {{ $row['usia'] }} Tahun
                    </td>
                    <td class="px-6 py-4 dark:text-white whitespace-nowrap">
                        {{ $row['jenis_kelamin'] }}
                    </td>
                    <td class="px-6 py-4 dark:text-white whitespace-nowrap">
                        {{ $row['alamat'] }}, <span>{{ $row['kelurahan'] }}, </span> <span>{{ $row['kecamatan'] }}, </span> <span>{{ $row['kabupaten'] }}</span>
                    </td>
                    <td class="px-6 py-4 dark:text-white">
                        {{ $row['email'] }}
                    </td>
                    <td class="px-6 py-4 dark:text-white">
                        {{ $row['no_hp'] }}
                    </td>
                    <td class="px-6 py-4 dark:text-white">
                        {{ $row['jenis_tes'] }}
                    </td>
                    <td class="px-6 py-4 dark:text-white">
                        {{ $row['total_score'] }}
                    </td>
                    <td class="px-6 py-4 dark:text-white whitespace-nowrap">
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
