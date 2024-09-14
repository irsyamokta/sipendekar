@extends('client.index')
@section('content')
    @include('client.partials.preloader')
    <section class="flex md:justify-center items-center md:h-[100vh] bg-gradient-to-t from-soft to-white">
        <div class="w-full p-5">
            <form action="{{ route('inputData') }}" method="POST" enctype="multipart/form-data auto" autocomplete="off"
                class="flex flex-col md:items-center gap-2">
                @csrf
                <h1 class="font-bold mb-10 md:text-xl text-center">@lang('screening.form.title')</h1>
                <div class="w-full md:px-12">
                    @if ($errors->any())
                        <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50"
                            role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Danger</span>
                            <div>
                                <span class="font-medium">Pastikan persyaratan berikut dipenuhi:</span>
                                <ul class="mt-1.5 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="flex flex-col justify-center md:flex-row md:px-12 gap-5 w-full">
                    {{-- Firts Column --}}
                    <div class="flex flex-col gap-5 lg:w-2/4">
                        <div class="flex flex-col gap-3">
                            <label for="nama_lengkap" class="text-sm">@lang('screening.form.name')<span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Jhon doe" class="text-sm rounded-2xl w-full lg:h-12 placeholder:text-[#C4C4C4]"
                                value="{{ old('nama_lengkap') }}" required>
                        </div>
                        <div class="flex flex-col gap-3">
                            <label for="datepicker-autohide" class="text-sm">@lang('screening.form.birth')<span
                                    class="text-red-500">*</span></label>
                            <div class="relative max-w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="datepicker-autohide" datepicker datepicker-autohide type="text"
                                    name="tanggal_lahir"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full lg:h-12 ps-10 p-2.5  placeholder:text-[#C4C4C4]"
                                    placeholder="@lang('screening.form.date')" value="{{ old('tanggal_lahir') }}" required>
                            </div>
                        </div>
                        <div class="flex flex-col gap-3">
                            <label for="countries" class="text-sm">@lang('screening.form.gender')<span class="text-red-500">*</span></label>
                            <select id="countries" name="jenis_kelamin"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full lg:h-12 p-2.5">
                                <option value="" selected>@lang('screening.form.select')</option>
                                <option value="Laki - laki">@lang('screening.form.boy')</option>
                                <option value="Perempuan">@lang('screening.form.girl')</option>
                            </select>
                        </div>
                    </div>
                    {{-- Second Column --}}
                    <div class="flex flex-col gap-5 lg:w-2/4">
                        <div class="flex flex-col gap-3">
                            <label for="nomor_hp" class="text-sm">@lang('screening.form.phone')</label>
                            <input type="text" name="nomor_hp" inputmode="numeric" pattern="[0-9]*" maxlength="13"
                                id="nomor_hp" class="text-sm rounded-2xl w-full lg:h-12 placeholder:text-[#C4C4C4]" value="{{ old('nomor_hp') }}" placeholder="08xxxxxxxx">
                        </div>
                        <div class="flex flex-col gap-3">
                            <label for="email" class="text-sm">@lang('screening.form.email')</label>
                            <input type="email" name="email" id="email" class="text-sm rounded-2xl w-full lg:h-12 placeholder:text-[#C4C4C4]"
                                value="{{ old('email') }}" placeholder="example@gmail.com">
                        </div>
                        <div class="flex flex-col gap-3">
                            <label for="sekolah" class="text-sm">@lang('screening.form.school')<span class="text-red-500">*</span></label>
                            <input type="text" name="sekolah" id="sekolah" class="text-sm rounded-2xl w-full lg:h-12 placeholder:text-[#C4C4C4]"
                                value="{{ old('sekolah') }}" placeholder="SMA Negeri 1 Banyumas" required>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button
                        class="mt-5 md:mt-8 w-30 2xl:w-40 2xl:h-12 2xl:text-lg py-2 bg-gradient-to-r from-accent to-secondary text-sm text-center text-white rounded-[30px]">Submit</button>
                </div>
            </form>
        </div>
    </section>
@endsection
