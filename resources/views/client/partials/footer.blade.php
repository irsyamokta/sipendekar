<footer class="flex justify-center items-center bg-secondary h-64 lg:h-60 py-10">
    <div class="flex flex-col justify-center md:justify-between px-4 md:mx-12 w-full gap-5">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div class="flex justify-center mb-4 sm:mb-0">
                <img src="{{ asset('assets/logo/logo-horizontal-white.png') }}" alt="logo sipendekar" class="w-50 lg:w-70">
            </div>
            <ul class="flex flex-wrap justify-center items-center mb-2 md:mb-6 text-xs md:text-sm font-medium text-white sm:mb-0">
                <li>
                    <a href="https://psikologi.ump.ac.id/" target="_blank" class="hover:underline me-4 md:me-6">@lang('message.footer.partner')</a>
                </li>
                <li>
                    <a href="" class="hover:underline me-4 md:me-6">@lang('message.footer.copyright')</a>
                </li>
                <li>
                    <a href="{{ route('review') }}" class="hover:underline me-4 md:me-6">@lang('message.footer.feedback')</a>
                </li>
                <li>
                    <a href="mailto:admin@sipendekar.com" class="hover:underline">@lang('message.footer.email')</a>
                </li>
            </ul>
        </div>
        <hr class="text-white">
        <p class="text-white text-[8px] lg:text-xs 2xl:text-[14px] mt-3 text-center">Copyright © SiPendekar {{ date('Y') }}. All Right Reserves</p>
    </div>
</footer>

