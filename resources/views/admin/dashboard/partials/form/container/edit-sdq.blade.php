<div
    class="sdq-question rounded-sm border border-stroke bg-white px-7.5 py-4 shadow-default dark:border-strokedark dark:bg-boxdark">
    {{-- Heading --}}
    <div class="mt-4 flex items-center justify-between">
        <div>
            <span class="text-sm md:text-lg font-regular text-dark dark:text-primary">Pertanyaan {{ $data->urutan }}
            </span>
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
    <div class="mt-4 flex flex-col gap-2">
        <div class="mt-4 flex flex-col md:flex-row gap-2">
            <textarea name="pertanyaan" rows="3" class="w-full overflow-auto dark:bg-transparent"
                placeholder="Tulis pertanyaan..." required>{{ $data->pertanyaan }}</textarea>
            <select name="domain" id="domain" class="h-12 text-sm md:text-md dark:bg-transparent">
                <option class="text-xs md:text-md" value="" selected>{{ $data->domain }}</option>
                <option class="text-xs md:text-md" value="E">E</option>
                <option class="text-xs md:text-md" value="C">C</option>
                <option class="text-xs md:text-md" value="H">H</option>
                <option class="text-xs md:text-md" value="P">P</option>
                <option class="text-xs md:text-md" value="Pro">Pro</option>
            </select>
        </div>
        <div class="flex flex-col md:flex-row gap-2">
            <select name="tidak_benar" id="tidak-benar" class="h-12 text-sm md:text-md dark:bg-transparent">
                <option class="text-xs md:text-md" value="" selected>{{ $data->tidak_benar }}</option>
                <option class="text-xs md:text-md" value="0">0</option>
                <option class="text-xs md:text-md" value="1">1</option>
                <option class="text-xs md:text-md" value="2">2</option>
            </select>
            <select name="agak_benar" id="agak-benar" class="h-12 text-sm md:text-md dark:bg-transparent">
                <option class="text-xs md:text-md" value="" selected>{{ $data->agak_benar }}</option>
                <option class="text-xs md:text-md" value="0">0</option>
                <option class="text-xs md:text-md" value="1">1</option>
                <option class="text-xs md:text-md" value="2">2</option>
            </select>
            <select name="selalu_benar" id="selalu-benar" class="h-12 text-sm md:text-md dark:bg-transparent">
                <option class="text-xs md:text-md" value="" selected>{{ $data->selalu_benar }}</option>
                <option class="text-xs md:text-md" value="0">0</option>
                <option class="text-xs md:text-md" value="1">1</option>
                <option class="text-xs md:text-md" value="2">2</option>
            </select>
        </div>
    </div>
</div>

<script>   
    const domainValue = "{{ $data->domain }}"
    const tidakBenar = "{{ $data->tidak_benar }}"
    const agakBenar = "{{ $data->agak_benar }}"
    const selaluBenar = "{{ $data->selalu_benar }}"
</script>

