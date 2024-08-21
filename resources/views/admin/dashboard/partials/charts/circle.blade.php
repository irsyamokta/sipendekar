<div
    class="col-span-12 mt-5 md:mt-7 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:col-span-5">
    <div class="mb-3 justify-between gap-4 sm:flex">
        <div>
            <h4 class="text-xl font-bold text-black dark:text-white">
                Data Usia Pengguna
            </h4>
        </div>
        <div>
            <p class="text-sm font-medium text-black dark:text-white">
                Bulan {{ $formatDate }}
            </p>
        </div>
    </div>
    <div class="mb-2">
        @if ($totalParticipants <= 0)
            <div class="mx-auto flex justify-center py-20">Tidak ada data</div>
        @else
            <div id="chartThree" class="mx-auto flex justify-center"></div>
        @endif
    </div>
    <div class="-mx-8 flex flex-wrap items-center justify-center gap-y-3">
        <div class="w-full px-8 sm:w-1/2">
            <div class="flex w-full items-center">
                <span class="mr-2 block h-3 w-full max-w-3 rounded-full bg-[#83B7FD]"></span>
                <p class="flex w-full justify-between text-sm font-medium text-black dark:text-white">
                    <span> 4 - 18 Tahun </span>
                    <span> {{ $usia_4_18_percentage }}%</span>
                </p>
            </div>
        </div>
        <div class="w-full px-8 sm:w-1/2">
            <div class="flex w-full items-center">
                <span class="mr-2 block h-3 w-full max-w-3 rounded-full bg-[#176B87]"></span>
                <p class="flex w-full justify-between text-sm font-medium text-black dark:text-white">
                    <span> Di atas 18 Tahun </span>
                    <span> {{ $usia_18_keatas_percentage }}% </span>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    const usia4_18 = @json($usia_4_18_percentage);
    const usia18_keatas = @json($usia_18_keatas_percentage);
</script>
