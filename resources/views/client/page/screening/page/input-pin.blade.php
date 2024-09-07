@extends('client.index')
@section('content')
    @include('client.partials.preloader')
    <section class="flex justify-center items-center h-[100vh] bg-gradient-to-t from-soft to-white">
        <div>
            <form action="{{ route('checkPin') }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col justify-center items-center gap-2">
                @csrf
                <h1 class="font-bold mb-3 xl:mb-5 md:text-xl">@lang('screening.pin.title')</h1>
                <input type="text" name="input_pin" inputmode="numeric" pattern="[0-9]*" maxlength="6" id="input_pin"
                    class="rounded-xl w-[300px] md:w-[500px] md:h-16 lg:w-[400px] lg:h-14 xl:w-[500px] xl:h-16 text-center text-4xl font-bold tracking-wider border-none bg-slate-100"
                    required>
                <button
                    class="mt-5 md:mt-8 w-30 2xl:w-40 2xl:h-12 2xl:text-lg py-2 bg-gradient-to-r from-accent to-secondary text-sm text-center text-white rounded-[30px]">@lang('screening.pin.button')</button>
            </form>
        </div>
    </section>
    @if (session('error'))
        @include('client.partials.alert')
    @endif
@endsection
