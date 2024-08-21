<div
    class="srq-question rounded-sm border border-stroke bg-white px-7.5 py-4 shadow-default dark:border-strokedark dark:bg-boxdark">
    {{-- Heading --}}
    <div class="mt-4 flex items-center justify-between">
        <div>
            <span class="text-sm md:text-lg font-regular text-dark dark:text-primary">Pertanyaan {{ $data->urutan }}</span>
        </div>
        <div class="flex gap-2">
            <button>
                <a
                    class="flex justify-center items-center gap-1 text-sm font-medium w-[80px] h-[25px] md:w-[96px] md:h-[30px] cursor-pointer rounded-[30px] bg-[#D9D9D9] text-dark duration-300 ease-linear">
                    <img src="{{ asset('assets/icon/icon-save.png') }}" alt="simpan" class="w-3 h-3 md:w-4 md:h-4">
                    <span>Simpan</span>
                </a>
            </button>
        </div>
    </div>
    {{-- Question --}}
    <div class="mt-4">
        <textarea name="pertanyaan" id="" rows="3" class="w-full overflow-auto text-sm md:text-md dark:bg-transparent"  placeholder="Tulis pertanyaan...">{{ $data->pertanyaan }}</textarea>
    </div>
</div>