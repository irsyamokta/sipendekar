<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ url('assets/icon/fav-icon.png') }}">
    <title>Login</title>
    @vite(['resources/css/style.css', 'resources/js/app.js', 'resources/js/index.js', 'resources/js/script.js'])
</head>

<body class="bg-gradient-to-t from-soft to-white to-16%">
    <section class="md:h-[100vh] flex flex-col md:flex lg:flex-row">
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center px-16 py-16 bg-secondary">
            <a class="flex justify-center" href="https://storyset.com/online" target="_blank">
                <img class="sm:w-[60%] lg:w-[80%]" src="{{ asset('assets/img/img-login.png') }}" alt="Online illustrations by Storyset" >
            </a>
            <p class="text-primary text-center text-sm md:text-lg">Silakan masuk dengan akun Anda. Jika Anda lupa
                password silakan hubungi staff bagian IT</p>
        </div>
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center py-10 gap-10">
            <h1 class="text-5xl font-poppins font-bold text-secondary">SiPendekar</h1>
            @include('admin.dashboard.partials.toast.register-toast')
            <form action="{{ route('login') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col justify-center items-center">
                    <div class="mb-5">
                        <label for="email" class="text-sm">Email</label>
                        <br>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="example@gmail.com" class="rounded-[30px] w-[250px] lg:w-[300px] placeholder:text-xs placeholder:text-[#C4C4C4]">
                    </div>
                    <div class="mb-5">
                        <label for="password" class="text-sm">Password</label>
                        <br>
                        <input type="password" name="password" required autocomplete="current-password" placeholder="Password" class="rounded-[30px] w-[250px] lg:w-[300px] placeholder:text-xs placeholder:text-[#C4C4C4]">
                        @if($errors->has('email'))
                            <p class="mt-3 text-red-500 text-xs">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <button class="w-40 h-10 mt-5 rounded-[30px] bg-secondary text-primary hover:bg-active hover:text-primary duration-300 ease-linear">Masuk</button>
                </div>
            </form>
            <p class="mt-5 text-xs text-secondary font-regular">Copyright © SiPendekar {{ date('Y') }}. All Right Reserves</p>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>

</html>
