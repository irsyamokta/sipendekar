<section class="flex flex-col justify-center items-center py-20 h-full">
    <p class="font-semibold xl:text-xl 2xl:text-2xl">Daftar Alamat</p>
    <h1
        class="text-2xl md:text-3xl xl:text-[40px] 2xl:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-accent to-secondary mt-1">
        Puskesmas Kab. Banyumas</h1>
    <div
        class="flex flex-col items-center gap-5 mt-10 pb-5 relative overflow-x-auto mx-4 md:mx-12 bg-white shadow-md rounded-md">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-primary uppercase bg-hard dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Puskesmas
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Alamat
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($puskesmas as $item)
                    <tr class="dark:bg-gray-800 dark:border-gray-700">
                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-xs md:text-sm">
                            {{ $item['id'] }}
                        </td>
                        <td class="px-6 py-4 text-xs md:text-sm">
                            {{ $item['name'] }}
                        </td>
                        <td class="px-6 py-4 text-xs md:text-sm">
                            {{ $item['address'] }}
                        </td>
                        <tr>
                            <td>
                                <hr class="ml-4">
                            </td>
                            <td>
                                <hr>
                            </td>
                            <td>
                                <hr class="mr-4">
                            </td>
                        </tr>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $puskesmas->links('vendor.pagination.custome') }}
    </div>

</section>
