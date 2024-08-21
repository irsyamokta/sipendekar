<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Bad Request</title>
</head>

<body class="bg-gradient-to-t from-[#B4D4FF] to-white">
    <section class="flex flex-col justify-center items-center text-center h-[100vh]">
        <img src="{{ asset('assets/img/img-404.png') }}" alt="not found" class="w-56 md:w-96">
        <h1 class="text-2xl font-bold mt-2">Bad Request</h1>
        <p class="text-sm xl:text-base px-5 lg:px-28 mt-2 md:w-1/2">Isi permintaan tidak dapat dibaca dengan benar</p>
        <a href="/" class="px-4 py-3 bg-[#176B87] mt-5 rounded-xl text-white">Kembali ke Homepage</a>
    </section>
</body>
</html>