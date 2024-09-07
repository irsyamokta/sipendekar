<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ url('assets/icon/fav-icon.png') }}">
    <title>Feedback</title>
    @vite(['resources/css/style.css', 'resources/js/app.js', 'resources/js/index.js', 'resources/js/script.js'])
</head>

<body class="bg-gradient-to-t from-soft to-white to-16%">
    <section class="h-[100vh] flex lg:flex-row">
        <div class="hidden w-full lg:w-1/2 lg:flex flex-col justify-center items-center px-16 py-16 bg-secondary">
            <a class="flex justify-center" href="https://storyset.com/online" target="_blank">
                <img class="sm:w-[60%] lg:w-[80%]" src="{{ asset('assets/img/img-feedback.png') }}"
                    alt="Feedback">
            </a>
        </div>
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center lg:py-10 gap-10">
            <div class="flex px-10 w-full md:px-0 justify-center">
                @include('client.partials.toast')
            </div>
            <div class="flex flex-col justify-center items-center gap-5 md:bg-white px-10 py-5 md:px-20 md:py-10 rounded-lg md:shadow-sm">
                <h1 class="text-2xl font-poppins font-bold text-secondary">@lang('message.feedback.title')</h1>
                <form action="{{ route('submitFeedback') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-row-reverse justify-center items-center gap-2 mb-6">
                        <input id="hs-ratings-readonly-1" type="radio"
                            class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                            name="rating" value="5">
                        <label for="hs-ratings-readonly-1"
                            class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none dark:peer-checked:text-yellow-600 dark:text-neutral-600">
                            <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                </path>
                            </svg>
                        </label>
                        <input id="hs-ratings-readonly-2" type="radio"
                            class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                            name="rating" value="4">
                        <label for="hs-ratings-readonly-2"
                            class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none dark:peer-checked:text-yellow-600 dark:text-neutral-600">
                            <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                </path>
                            </svg>
                        </label>
                        <input id="hs-ratings-readonly-3" type="radio"
                            class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                            name="rating" value="3">
                        <label for="hs-ratings-readonly-3"
                            class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none dark:peer-checked:text-yellow-600 dark:text-neutral-600">
                            <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                </path>
                            </svg>
                        </label>
                        <input id="hs-ratings-readonly-4" type="radio"
                            class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                            name="rating" value="2">
                        <label for="hs-ratings-readonly-4"
                            class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none dark:peer-checked:text-yellow-600 dark:text-neutral-600">
                            <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                </path>
                            </svg>
                        </label>
                        <input id="hs-ratings-readonly-5" type="radio"
                            class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                            name="rating" value="1">
                        <label for="hs-ratings-readonly-5"
                            class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none dark:peer-checked:text-yellow-600 dark:text-neutral-600">
                            <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                </path>
                            </svg>
                        </label>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <div class="mb-5">
                            <label for="name" class="text-sm">@lang('message.feedback.name')</label>
                            <br>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                placeholder="Jhon Doe"
                                class="rounded-lg w-[250px] lg:w-[300px] placeholder:text-sm placeholder:text-[#C4C4C4]">
                        </div>
                        <div class="mb-5">
                            <label for="feedback" class="text-sm">@lang('message.feedback.review')</label>
                            <br>
                            <textarea type="text" rows="4" name="feedback" required placeholder="@lang('message.feedback.placeholder')"
                                class="rounded-lg w-[250px] lg:w-[300px] placeholder:text-sm placeholder:text-[#C4C4C4]">{{ old('feedback') }}</textarea>
                        </div>
                        <button
                            class="w-40 h-10 mt-5 rounded-[30px] bg-secondary text-primary hover:bg-active hover:text-primary duration-300 ease-linear">@lang('message.feedback.submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>
</html>
