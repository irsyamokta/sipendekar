@extends('client.index')
@section('content')
    @include('client.partials.preloader')
    @include('client.partials.navbar-test')
    <section class="flex justify-center items-center h-[100vh] bg-gradient-to-t from-soft to-white">
        <div class="flex flex-col justify-center items-center text-center mx-5 mt-5 md:px-4 md:mt-10 md:mx-12 lg:w-full">
            <h1
                class="mt-5 text-3xl md:text-4xl lg:text-3xl xl:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-accent to-secondary">Terima Kasih Telah Berpartisipasi</h1>
            <img src="{{ asset('assets/img/img-finish.png') }}" alt="result"
                class="w-56 md:w-96 lg:w-56 xl:w-80 mt-5">
            <p class="text-xs md:text-base lg:text-sm xl:text-base px-4 lg:px-40 xl:px-56 mt-5">Jika Anda membutuhkan informasi lebih lanjut atau ingin berkonsultasi lebih lanjut, jangan ragu untuk menghubungi tim kami. Tetap jaga kesehatan fisik dan mental Anda, karena kesejahteraan Anda adalah prioritas kami</p>
        </div>
    </section>
@endsection
