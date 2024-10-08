@extends('client.index')
@section('content')
    @include('client.partials.preloader')
    <section class="flex justify-center items-center h-[100vh] bg-gradient-to-t from-soft to-white">
        <div>
            <form action="{{ route('checkUsia') }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col justify-center items-center gap-2">
                @csrf
                <h1 class="font-bold mb-3 xl:mb-5 md:text-xl">Silakan Masukkan Usia Anda</h1>
                <input type="text" name="input_usia" inputmode="numeric" pattern="[0-9]*" maxlength="2" id="input_usia"
                    class="rounded-xl w-[300px] md:w-[500px] md:h-16 lg:w-[400px] lg:h-14 xl:w-[500px] xl:h-16 text-center text-4xl font-bold tracking-wider border-none bg-slate-100"
                    required>
                <button
                    class="mt-5 md:mt-8 w-30 2xl:w-40 2xl:h-12 2xl:text-lg py-2 bg-gradient-to-r from-accent to-secondary text-sm text-center text-white rounded-[30px]">Mulai
                    Tes</button>
            </form>
        </div>
    </section>
    @if (session('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function alertUsia(message) {
                Swal.fire({
                    text: message,
                    imageUrl: "../assets/img/img-danger.png",
                    imageWidth: 250,
                    imageHeight: 250,
                    imageAlt: "img danger",
                    confirmButtonText: 'Coba Lagi',
                    confirmButtonColor: '#176B87',
                });
            }
            alertUsia('{{ session('error') }}');
        </script>
    @endif
@endsection
