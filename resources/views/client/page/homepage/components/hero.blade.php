<section id="homepage" class="flex justify-center items-center h-[100vh] bg-gradient-to-t from-soft to-white">
    <div class="flex flex-col md:items-center lg:flex-row lg:justify-between mt-10 px-4 md:mx-12 md:mt-0 lg:w-full gap-5 md:gap-10">
        <div class="flex flex-col items-center lg:items-start gap-2 xl:gap-3 2xl:gap-4">
            <h2 class="text-lg md:text-xl lg:text-lg xl:text-3xl font-medium delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">@lang('message.hero.welcome')</h2>
            <h1 class="text-5xl md:text-7xl xl:text-8xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-accent to-secondary delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">SiPendekar</h1>
            <h3 class="text-xs text-center md:text-xl lg:text-lg xl:text-[22px] 2xl:text-2xl delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">@lang('message.hero.akronim')</h3>
            <p class="text-sm md:text-lg lg:text-base xl:text-lg 2xl:text-2xl font-semibold mt-5 delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">"@lang('message.hero.tagline')"</p>
            <a href="{{ route('screening') }}" class="flex justify-center items-center bg-transparent bg-clip-border bg-gradient-to-r from-accent to-secondary text-white mt-8 py-2 rounded-[30px] w-40 md:w-45 md:h-10 2xl:h-15 2xl:w-60 text-xs md:text-sm 2xl:text-lg text-center delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0"><button>@lang('message.hero.cta')</button></a>
        </div>
        <div>
            <img src="{{ asset('assets/img/img-hero.png') }}" alt="image hero" class="w-115 lg:w-96 xl:w-[450px] 2xl:w-[600px] mt-5 delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0 [animation-iteration-count:infinite]" data-taos-offset="0">
        </div>
    </div>
</section>
