<section class="flex flex-col justify-center items-center h-[100vh] bg-gradient-to-t from-soft to-white">
    <div class="flex flex-col justify-center items-center w-full px-5 md:px-20 lg:px-30 xl:px-60">
        <h1 class="font-bold mb-3 text-2xl md:text-3xl xl:text-4xl text-center">SDQ Test</h1>
        <div class="w-full p-1 md:p-5">
            <div class="flex justify-end mb-1">
                <span id="progress-text" class="text-sm font-medium text-secondary">0%</span>
            </div>
            <div class="w-full bg-slate-300 rounded-full h-2.5">
                <div id="progress-bar" class="bg-gradient-to-r from-accent to-secondary h-2.5 rounded-full"
                    style="width: 0%"></div>
            </div>
        </div>
        <div id="controls-carousel" class="relative w-full mt-10 lg:mt-0 xl:mt-10" data-carousel="static">
            <div class="relative h-96 lg:h-80 xl:h-100 overflow-hidden rounded-lg">
                <form id="sdq-form" action="{{ route('submitScreeningSDQ') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @foreach ($sdqQuestions as $index => $item)
                        <div class="hidden duration-100"
                            data-carousel-item="{{ $index === 0 ? 'active' : '' }}">
                            <div class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                <p
                                    class="text-sm md:text-lg h-20 lg:h-0 xl:h-10 lg:text-sm xl:md:text-lg text-center font-medium">
                                    {{ $item->pertanyaan }}</p>
                                <ul class="grid w-full gap-3 md:grid-cols-1 mt-2 lg:mt-8 p-1 md:p-5">
                                    <li>
                                        <span class="hidden"><input type="text" name="test_type"
                                                value="SDQ {{ $item->kategori }}"></span>
                                        <input type="radio" id="tidak-benar-{{ $item->urutan }}"
                                            name="sdq-{{ $item->urutan }}" value="{{ $item->tidak_benar }}"
                                            class="hidden peer" required/>
                                        <label for="tidak-benar-{{ $item->urutan }}"
                                            class="inline-flex items-center justify-center w-full p-5 xl:p-7 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:bg-green-100 peer-checked:border-secondary peer-checked:text-secondary peer-checked:font-bold hover:text-gray-600 hover:bg-gray-100">
                                            <div class="block">
                                                <div class="w-full">@lang('screening.choice-sdq.option-1')</div>
                                            </div>
                                        </label>
                                    </li>
                                    <li>
                                        <input type="radio" id="agak-benar-{{ $item->urutan }}"
                                            name="sdq-{{ $item->urutan }}" value="{{ $item->agak_benar }}"
                                            class="hidden peer">
                                        <label for="agak-benar-{{ $item->urutan }}"
                                            class="inline-flex items-center justify-center w-full p-5 xl:p-7 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:bg-green-100 peer-checked:border-secondary peer-checked:text-secondary peer-checked:font-bold hover:text-gray-600 hover:bg-gray-100">
                                            <div class="block">
                                                <div class="w-full">@lang('screening.choice-sdq.option-2')</div>
                                            </div>
                                        </label>
                                    </li>
                                    <li>
                                        <input type="radio" id="selalu-benar-{{ $item->urutan }}"
                                            name="sdq-{{ $item->urutan }}" value="{{ $item->selalu_benar }}"
                                            class="hidden peer">
                                        <label for="selalu-benar-{{ $item->urutan }}"
                                            class="inline-flex items-center justify-center w-full p-5 xl:p-7 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:bg-green-100 peer-checked:border-secondary peer-checked:text-secondary peer-checked:font-bold hover:text-gray-600 hover:bg-gray-100">
                                            <div class="block">
                                                <div class="w-full">@lang('screening.choice-sdq.option-3')</div>
                                            </div>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </form>
            </div>
            <div class="flex justify-center lg:mt-0 xl:mt-8 gap-2">
                <button type="button" id="prev-button"
                    class="flex items-center justify-center h-full px-2 cursor-pointer group focus:outline-none"
                    data-carousel-prev disabled>
                    <span
                        class="inline-flex items-center justify-center w-15 h-15 md:w-15 md:h-15 lg:w-12 lg:h-12 xl:w-15 xl:h-15 rounded-full bg-gradient-to-t from-secondary to-accent p-2 disabled-button">
                        <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 1 1 5l4 4" />
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" id="next-button"
                    class="flex items-center justify-center h-full px-2 cursor-pointer group focus:outline-none"
                    data-carousel-next disabled>
                    <span
                        class="inline-flex items-center justify-center w-15 h-15 md:w-15 md:h-15 lg:w-12 lg:h-12 xl:w-15 xl:h-15  rounded-full bg-gradient-to-t from-secondary to-accent p-2 disabled-button">
                        <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
                <button type="submit" id="finish-button"
                    class="hidden items-center justify-center h-full px-2 cursor-pointer group focus:outline-none"
                    form="sdq-form">
                    <span
                        class="inline-flex items-center justify-center w-30 h-15 md:w-30 md:h-15 lg:w-24 lg:h-12 xl:w-30 xl:h-15 rounded-full bg-gradient-to-t from-secondary to-accent p-2">
                        <span class="text-white">@lang('screening.choice-sdq.button')</span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let totalQuestions = @json(count($sdqQuestions));
    let age = "{{ $umur }}"

    function checkAge(age) {
        Swal.fire({
            text: `@lang('screening.alert.message-sdq', ["age" => $umur])`,
            imageUrl: "/assets/img/img-sdq-test.png",
            imageWidth: 250,
            imageHeight: 250,
            imageAlt: "img danger",
            confirmButtonText: 'Ok',
            confirmButtonColor: '#176B87',
        });
    }
    let formSubmitting = false;

    window.addEventListener('beforeunload', function(e) {
        if (!formSubmitting) {
            sessionStorage.setItem('session', 'true');
            const message = "Apakah Anda yakin ingin meninggalkan halaman ini?";
            e.returnValue = message;
            return message;
        }
    });

    document.getElementById('finish-button').addEventListener('click', function() {
        formSubmitting = true;
    });
    checkAge(age)
</script>
