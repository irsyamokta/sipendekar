<div class="grid grid-cols-1 gap-2">
    <div
        class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="flex flex-col md:flex-row gap-2 items-center justify-between">
            <span>
                <h4 class="text-title-sm font-bold text-black dark:text-white">Laporan SDQ</h4>
            </span>
            <div>
                @include('client.partials.date-picker-sdq')
            </div>
        </div>
    </div>
    <div
        class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="relative overflow-x-auto px-1 py-1">
            <div class="flex flex-column sm:flex-row space-y-4 sm:space-y-0 items-center justify-between pb-4">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div
                        class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <form action="{{ route('report') }}" method="GET" enctype="multipart/form-data">
                        <input type="text" id="table-search" name="search_sdq" value="{{ session('search_sdq') }}"
                            class="block p-2 ps-10 text-sm text-gray-900 border-none rounded-lg w-50 md:w-80 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Cari data">
                    </form>
                </div>
                <span>
                    <a href="{{ route('sdqDownloadExcel') }}">
                        <button
                            id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                            class="bg-secondary text-primary duration-300 ease-linear dark:bg-white dark:text-secondary hover:text-white hover:bg-active dark:hover:bg-meta-4 dark:hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-blue-800"
                            type="button">Unduh
                        </button>
                    </a>
                </span>
            </div>
            @include('admin.dashboard.partials.tables.tables-sdq')
            <div class="flex justify-center mt-5 mb-5">
                {{ $participantsSDQ->appends(['sdq_page' => request()->query('sdq_page')])->links('vendor.pagination.custome') }}
            </div>
        </div>
    </div>
</div>
