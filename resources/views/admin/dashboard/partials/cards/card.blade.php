<div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 2xl:gap-7.5">
    <!-- Card Item Start -->
    <div
        class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
            <img src="{{ asset('assets/icon/icon-user.png') }}" alt="total user">
        </div>
        <div class="mt-4 flex items-end justify-between">
            <div>
                <h4 class="text-title-md font-bold text-black dark:text-white">
                    {{ $totalParticipants }}
                </h4>
                <span class="text-sm font-medium">Total Peserta Bulan {{ $formatDate }}</span>
            </div>
        </div>
    </div>
    <!-- Card Item End -->

    <!-- Card Item Start -->
    @forelse ($pin as $item)
        @if ($item->status == 'active')
            <!-- Card Item Start -->
            <div
                class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex justify-between">
                    <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                        <img src="{{ asset('assets/icon/icon-pin.png') }}" alt="generate pin">
                    </div>
                    <p class="flex items-center text-sm text-gray-500 dark:text-gray-400"><button
                            data-popover-target="popover-description" data-popover-placement="bottom-end"
                            type="button"><svg class="w-4 h-4 ms-2 text-gray-400 hover:text-gray-500"
                                aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg><span class="sr-only">Show information</span></button></p>
                    <div data-popover id="popover-description" role="tooltip"
                        class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border rounded-lg shadow-sm opacity-0 w-72 dark:bg-meta-4 dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Penting</h3>
                            <p>Jangan lupa untuk mengakhiri sesi untuk menghindari penyalahgunaa</p>
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                </div>
                <div>
                    <form id="start-form" action="{{ route('updatePinStatus') }}" method="POST"
                        enctype="multipart/form-data" class="mt-4 flex items-end justify-between">
                        @csrf
                        <div>
                            <input id="input-pin" type="text" name="pin" value="567834" class="hidden">
                            @foreach ($pin as $item)
                                <h4 id="pin" class="text-title-md font-bold text-black dark:text-white">
                                    @if ($item == null)
                                        {{ 'xxxxxx' }}
                                    @else
                                        {{ $item->pin }}
                                    @endif
                                </h4>
                            @endforeach
                            <span class="text-sm font-medium">PIN Sesi {{ $item->status }}</span>
                        </div>
                        <span class="flex items-center gap-1 text-sm font-medium text-primary">
                            <button id="generate"
                                class="w-[100px] h-[35px] rounded-[30px] bg-red-900 text-primary duration-300 ease-linear dark:bg-white dark:text-secondary hover:text-white hover:bg-active dark:hover:bg-meta-4 dark:hover:text-white">Akhiri</button>
                        </span>
                    </form>
                </div>
            </div>
            <!-- Card Item End -->
        @else
            <div
                class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex justify-between">
                    <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                        <img src="{{ asset('assets/icon/icon-pin.png') }}" alt="generate pin">
                    </div>
                    <p class="flex items-center text-sm text-gray-500 dark:text-gray-400"><button
                            data-popover-target="popover-description" data-popover-placement="bottom-end"
                            type="button"><svg class="w-4 h-4 ms-2 text-gray-400 hover:text-gray-500"
                                aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg><span class="sr-only">Show information</span></button></p>
                    <div data-popover id="popover-description" role="tooltip"
                        class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border rounded-lg shadow-sm opacity-0 w-72 dark:bg-meta-4 dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Penting</h3>
                            <p>Jangan lupa untuk mengakhiri sesi untuk menghindari penyalahgunaan</p>
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                </div>
                <div>
                    <form id="start-form" action="{{ route('generatePin') }}" method="POST"
                        enctype="multipart/form-data" class="mt-4 flex items-end justify-between">
                        @csrf
                        <div>
                            <input id="input-pin" type="text" name="pin" value="567834" class="hidden">
                            @foreach ($pin as $item)
                                <h4 id="pin" class="text-title-md font-bold text-black dark:text-white">
                                    @if ($item == null)
                                        {{ 'xxxxxx' }}
                                    @else
                                        {{ $item->pin }}
                                    @endif
                                </h4>
                            @endforeach
                            <span class="text-sm font-medium">PIN Sesi {{ $item->status }}</span>
                        </div>
                        <span class="flex items-center gap-1 text-sm font-medium text-primary">
                            <button id="generate"
                                class="w-[100px] h-[35px] rounded-[30px] bg-secondary text-primary duration-300 ease-linear dark:bg-white dark:text-secondary hover:text-white hover:bg-active dark:hover:bg-meta-4 dark:hover:text-white">Mulai</button>
                        </span>
                    </form>
                </div>
            </div>
            <!-- Card Item End -->
        @endforelse
    @empty
        <!-- Handle case where $pin is empty -->
        <div
            class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="flex justify-between">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                    <img src="{{ asset('assets/icon/icon-pin.png') }}" alt="generate pin">
                </div>
                <p class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                    <button data-popover-target="popover-description" data-popover-placement="bottom-end"
                        type="button">
                        <svg class="w-4 h-4 ms-2 text-gray-400 hover:text-gray-500" aria-hidden="true"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Show information</span>
                    </button>
                </p>
                <div data-popover id="popover-description" role="tooltip"
                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border rounded-lg shadow-sm opacity-0 w-72 dark:bg-meta-4 dark:text-gray-400">
                    <div class="p-3 space-y-2">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Penting</h3>
                        <p>Jangan lupa untuk mengakhiri sesi untuk menghindari penyalahgunaa</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
            </div>
            <div>
                <form id="start-form" action="{{ route('generatePin') }}" method="POST"
                    enctype="multipart/form-data" class="mt-4 flex items-end justify-between">
                    @csrf
                    <div>
                        <input id="input-pin" type="text" name="pin" value="567834" class="hidden">
                        <h4 id="pin" class="text-title-md font-bold text-black dark:text-white">xxxxxx</h4>
                        <span class="text-sm font-medium">PIN Sesi Tidak Ada</span>
                    </div>
                    <span class="flex items-center gap-1 text-sm font-medium text-primary">
                        <button id="generate"
                            class="w-[100px] h-[35px] rounded-[30px] bg-secondary text-primary duration-300 ease-linear dark:bg-white dark:text-secondary hover:text-white hover:bg-active dark:hover:bg-meta-4 dark:hover:text-white">Mulai</button>
                    </span>
                </form>
            </div>
        </div>
        <!-- Card Item End -->
    @endempty
</div>
