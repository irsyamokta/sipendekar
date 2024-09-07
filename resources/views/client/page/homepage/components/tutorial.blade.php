<section id="tutorial" class="flex justify-center items-center md:h-[50vh] lg:h-[100vh] py-15 lg:py-0 bg-primary">
    <div class="flex flex-col justify-center items-center px-4 md:mx-12 lg:w-full">
        <div class="flex flex-col items-center gap-2 text-center">
            <p class="xl:text-xl 2xl:text-2xl font-semibold delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="200">@lang('message.tutorial.title')</p>
            <h1 class="text-2xl md:text-3xl xl:text-[40px] 2xl:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-accent to-secondary delay-[400ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="200">@lang('message.tutorial.subtitle')</h1>
        </div>
        <div class="flex flex-col md:flex-row justify-center items-center md:gap-6 mt-5 lg:mt-10">
            <div class="mt-5 flex flex-col justify-center items-center gap-5 md:w-1/2 md:h-60 lg:h-70 2xl:w-1/3 2xl:h-96 bg-gradient-to-t from-hard to-accent p-5 rounded-[30px] delay-[500ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="100">
                <img src="{{ asset('assets/icon/icon-test.png') }}" alt="icon" class="w-15 md:w-16 lg:w-24 2xl:w-30">
                <p class="text-white text-xs 2xl:text-lg text-center">@lang('message.tutorial.first')</p>
            </div>
            <div class="mt-5 flex flex-col justify-center items-center gap-5 md:w-1/2 md:h-60 lg:h-70 2xl:w-1/3 2xl:h-96 bg-gradient-to-t from-hard to-accent p-5 rounded-[30px] delay-[600ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="100">
                <img src="{{ asset('assets/icon/icon-result.png') }}" alt="icon" class="w-15 md:w-16 lg:w-24 2xl:w-30">
                <p class="text-white text-xs text-center 2xl:text-lg ">@lang('message.tutorial.second')</p>
            </div>
            <div class="mt-5 flex flex-col justify-center items-center gap-5 md:w-1/2 md:h-60 lg:h-70 2xl:w-1/3 2xl:h-96 bg-gradient-to-t from-hard to-accent p-5 rounded-[30px] delay-[700ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="100">
                <img src="{{ asset('assets/icon/icon-doctor.png') }}" alt="icon" class="w-15 md:w-16 lg:w-24 2xl:w-30">
                <p class="text-white text-xs text-center 2xl:text-lg ">@lang('message.tutorial.third')</p>
            </div>
        </div>
    </div>
</section>
