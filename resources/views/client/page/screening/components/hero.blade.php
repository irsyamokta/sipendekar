<section id="" class="flex justify-center items-center h-[100vh] bg-gradient-to-t from-soft to-white">
    <div class="flex flex-col lg:flex-row justify-center items-center mx-5 mt-5 md:px-4 md:mt-10 md:mx-12 lg:w-full">
        <div class="flex flex-col gap-2 lg:w-4/6">
            <h1 class="mt-6 md:mt-0 text-3xl md:text-5xl lg:text-4xl xl:text-5xl 2xl:text-7xl py-2 md:py-4 font-bold text-transparent bg-clip-text bg-gradient-to-r from-accent to-secondary delay-[700ms] duration-[400ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">@lang('message.screening.title')</h1>
            <p class="text-xs md:text-sm xl:text-base 2xl:text-lg delay-[700ms] duration-[400ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">@lang('message.screening.description')</p>
            <p class="mt-3 text-sm 2xl:text-lg md:text-md font-bold delay-[700ms] duration-[400ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">@lang('message.screening.guide')</p>
            <ul class="list-outside list-disc px-4">
                <li class="text-xs md:text-sm xl:text-base 2xl:text-lg delay-[700ms] duration-[400ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">@lang('message.screening.first')</li>
                <li class="text-xs md:text-sm xl:text-base 2xl:text-lg delay-[700ms] duration-[400ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">@lang('message.screening.second')</li>
                <li class="text-xs md:text-sm xl:text-base 2xl:text-lg delay-[700ms] duration-[400ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">@lang('message.screening.third')</li>
                <li class="text-xs md:text-sm xl:text-base 2xl:text-lg delay-[700ms] duration-[400ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">@lang('message.screening.fourth')</li>
            </ul>
            <a href="{{ route('pinScreening') }}" class="mt-5 md:mt-8 w-30 2xl:w-40 2xl:h-12 2xl:text-lg py-2 bg-gradient-to-r from-accent to-secondary text-sm text-center text-white rounded-[30px] delay-[700ms] duration-[400ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">@lang('message.screening.button')</a>
        </div>
        <div>
            <img src="{{ asset('assets/img/img-screening.png') }}" alt="image hero" class="w-56 md:w-96 xl:w-[550px] 2xl:w-[600px] mt-5 delay-[700ms] duration-[400ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function disclaimer() {
        Swal.fire({
            title: 'Disclaimer',
            text: '@lang('message.screening.disclaimer')',
            imageUrl: "/assets/img/img-disclaimer.png",
            imageWidth: 250,
            imageHeight: 250,
            imageAlt: "img danger",
            confirmButtonText: 'Ok',
            confirmButtonColor: '#176B87',
        });
    }
    if (performance.navigation.type === performance.navigation.TYPE_BACK_FORWARD) {
        disclaimer();
    } else if (performance.navigation.type === performance.navigation.TYPE_RELOAD) {
    } else {
        disclaimer(); 
    }
</script>
