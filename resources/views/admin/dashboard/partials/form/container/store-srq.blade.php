@foreach ($data as $item)
    <div
        class="srq-question rounded-sm border border-stroke bg-white px-7.5 py-4 shadow-default dark:border-strokedark dark:bg-boxdark">
        {{-- Heading --}}
        <div class="mt-4 flex items-center justify-between">
            <div>
                <span class="text-md md:text-lg font-regular text-dark dark:text-primary">Pertanyaan {{ $loop->iteration }}</span>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('viewSRQ', $item->id_srq) }}"
                    class="edit-sdq flex justify-center items-center gap-1 text-sm font-medium w-[60px] h-[25px] md:w-[80px] md:h-[30px] cursor-pointer rounded-[30px] bg-[#D9D9D9] text-dark duration-300 ease-linear">
                    <img src="{{ asset('assets/icon/icon-edit.png') }}" alt="edit" class="w-3 h-3 md:w-4 md:h-4">
                    <span>Edit</span>
                </a>
                
                <a href="{{ route('deleteSRQ', $item->id_srq) }}"
                    class="delete-confirm flex justify-center items-center gap-1 text-sm font-medium w-[70px] h-[25px] md:w-[80px] md:h-[30px] cursor-pointer rounded-[30px] bg-[#D9D9D9] text-dark duration-300 ease-linear">
                    <img src="{{ asset('assets/icon/icon-delete.png') }}" alt="hapus" class="w-3 h-3 md:w-4 md:h-4">
                    <span>Hapus</span>
                </a>
            </div>
        </div>
        {{-- Question --}}
        <div class="mt-4">
            <div type="text" name="pertanyaan" class="text-wrap break-word border-none px-0 w-full md:text-md dark:bg-transparent" contenteditable="false">
                {{ $item->pertanyaan }}
            </div>
        </div>
    </div>
@endforeach