<table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-white uppercase bg-secondary dark:bg-meta-4 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-5 py-3">
                No
            </th>
            <th scope="col" class="px-5 py-3 whitespace-nowrap">
                Nama Lengkap
            </th>
            <th scope="col" class="px-5 py-3">
                Asal Sekolah
            </th>
            <th scope="col" class="px-5 py-3">
                Umpan Balik
            </th>
            <th scope="col" class="px-5 py-3">
                Tanggal
            </th>
        </tr>
    </thead>
    <tbody>
        @if (count($feedback) <= 0)
            <tr>
                <td colspan="2" class="text-start py-8">Tidak ada data</td>
            </tr>
        @else
            @foreach ($feedback as $row)
                <tr class="bg-white border-b dark:bg-boxdark">
                    <th scope="row" class="px-3 py-4 font-regular whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}
                    </th>
                    <th scope="row" class="px-3 py-4 font-regular whitespace-nowrap dark:text-white">
                        {{ $row->nama }}
                    </th>
                    <th scope="row" class="px-3 py-4 font-regular dark:text-white">
                        {{ $row->sekolah }}
                    </th>
                    <th scope="row" class="px-3 py-4 font-regular whitespace-nowrap overflow-y-auto max-w-[200px] no-scroll dark:text-white">
                        {{ $row->umpan_balik }}
                    </th>
                    <th scope="row" class="px-3 py-4 font-regular dark:text-white whitespace-nowrap">
                        {{ $row->created_at->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                    </th>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
