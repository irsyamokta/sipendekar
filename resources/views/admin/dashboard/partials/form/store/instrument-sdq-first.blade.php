<!-- ====== Form Layout Section Start -->
<form id="sdq-form" action="{{ route('storeSDQFirst') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
        <nav class="flex justify-end" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('sdq') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-secondary dark:text-gray-400 dark:hover:text-white">
                        Instruments
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">SDQ 4 - 10 Tahun</span>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="rounded-sm border border-stroke bg-white px-7.5 py-4 shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-title-sm 2xl:text-title-lg font-bold text-black dark:text-white">
                        Instrument Strengths and Difficulties Questionnaire (SDQ)
                    </h4>
                    <span class="text-sm 2xl:text-base font-medium">Usia 4 - 10 Tahun</span>
                </div>
            </div>
        </div>
    </div>
    <div id="sdq-container" class="mt-4 grid grid-cols-1 gap-5 sm:grid-cols-1">
        @if ($data->count() > 0)
            @include('admin.dashboard.partials.form.container.store-sdq-first')
        @endif
    </div>
    <div class="mt-4">
        <div class="flex justify-center">
            <a id="add-sdq-first"
                class="flex justify-center items-center gap-1 text-sm  w-[180px] h-[35px] md:w-[200px] md:h-[40px] cursor-pointer rounded-[30px] bg-secondary text-primary duration-300 ease-linear dark:bg-white dark:text-secondary hover:text-white hover:bg-active dark:hover:bg-meta-4 dark:hover:text-white"><span>Tambah Pertanyaan</span></a>
        </div>
    </div>
</form>
<!-- ====== Form Layout Section End -->
