<table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-white uppercase bg-secondary dark:bg-meta-4 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                No
            </th>
            <th scope="col" class="px-5 py-3 whitespace-nowrap">
                Nama Lengkap
            </th>
            <th scope="col" class="px-30 py-3">
                Ulasan
            </th>
            <th scope="col" class="px-5 py-3">
                Rating
            </th>
            <th scope="col" class="px-5 py-3">
                Tanggal
            </th>
        </tr>
    </thead>
    <tbody>
        @if (count($feedback) <= 0)
            <tr>
                <td colspan="4" class="text-center py-8">Tidak ada data</td>
            </tr>
        @else
            @foreach ($feedback as $row)
                <tr class="bg-white border-b dark:bg-boxdark">
                    <th scope="row" class="px-6 py-4 font-regular whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-regular whitespace-nowrap dark:text-white">
                        {{ $row->nama }}
                    </th>
                    <th scope="row" class="px-3 py-4 font-regular dark:text-white">
                        {{ $row->ulasan }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-regular whitespace-nowrap dark:text-white">
                        @if ($row->rating == 1)
                            @include('admin.dashboard.partials.ratings.rating-1')
                        @elseif($row->rating == 2)
                            @include('admin.dashboard.partials.ratings.rating-2')
                        @elseif($row->rating == 3)
                            @include('admin.dashboard.partials.ratings.rating-3')
                        @elseif($row->rating == 4)
                            @include('admin.dashboard.partials.ratings.rating-4')
                        @elseif($row->rating == 5)
                            @include('admin.dashboard.partials.ratings.rating-5')
                        @endif
                    </th>
                    <th scope="row" class="px-3 md:px-20 py-4 font-regular dark:text-white whitespace-nowrap">
                        {{ $row->created_at->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                    </th>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
