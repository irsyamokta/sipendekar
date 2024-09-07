<section id="about" class="flex justify-center items-center lg:h-[100vh] py-15 lg:py-0">
    <div class="flex flex-col lg:flex-row justify-center items-center px-4 md:mx-12 lg:w-full ">
        <div>
            <div>
                <p class="font-semibold text-center lg:text-start xl:text-xl 2xl:text-2xl delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">@lang('message.about.title')</p>
                <h1 class="text-2xl text-center lg:text-start md:text-3xl xl:text-[40px] 2xl:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-accent to-secondary mt-1 delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">@lang('message.about.subtitle')</h1>
                <p class="text-center lg:text-start mt-5 xl:mt-8 2xl:mt-10 text-xs md:text-sm xl:text-base 2xl:text-lg delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">@lang('message.about.description')</p>
                <p class="text-center lg:text-start mt-5 xl:mt-6 2xl:mt-7 text-xs md:text-sm xl:text-base 2xl:text-lg delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">@lang('message.about.type')</p>
                <div class="flex flex-col md:flex-row justify-center items-center gap-3 mt-5 2xl:mt-8">
                    <div class="flex flex-col items-center lg:items-start">
                        <div class="flex items-center  gap-3 delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">
                            <img src="{{ asset('assets/icon/icon-sdq.png') }}" alt="test" class="w-10 md:w-16 lg:w-12 2xl:w-20">
                            <p class="text-center md:text-start font-semibold text-xs md:text-sm xl:text-base 2xl:text-lg">Strengths and Difficulties Questionnaire (SDQ)</p>
                        </div>
                        <p class="text-center md:text-start mt-5 text-xs md:text-sm xl:text-base 2xl:text-lg delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">@lang('message.about.sdq')</p>
                    </div>
                    <div class="flex flex-col items-center lg:items-start">
                        <div class="flex items-center gap-3 delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">
                            <img src="{{ asset('assets/icon/icon-srq.png') }}" alt="test" class="w-10 md:w-16 lg:w-12 2xl:w-20">
                            <p class="text-center md:text-start font-semibold text-xs md:text-sm md:pr-20 xl:text-base 2xl:text-lg 2xl:pr-36">Self-Reporting Questionnaire (SRQ)</p>
                        </div>
                        <p class="text-center md:text-start mt-5 text-xs md:text-sm xl:text-base 2xl:text-lg delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">@lang('message.about.srq')</p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <img src="{{ asset('assets/img/img-about.png') }}" alt="about" class="mt-5 w-56 md:w-100 lg:w-[1500px] xl:w-[1700px] delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="400">
        </div>
    </div>
</section>