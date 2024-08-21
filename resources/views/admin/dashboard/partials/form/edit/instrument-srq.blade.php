<!-- ====== Form Layout Section Start -->
<form action="{{ route('editSRQ', $data->id_srq) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 gap-9 sm:grid-cols-1">
        <div
            class="rounded-sm border border-stroke bg-white px-7.5 py-4 shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="flex items-center justify-between">
                <h4 class="text-title-sm font-bold text-black dark:text-white">
                    Edit Pertanyaan SRQ
                </h4>
            </div>
        </div>
    </div>
    <div id="srq-container" class="mt-4 grid grid-cols-1 gap-5 sm:grid-cols-1">
        @include('admin.dashboard.partials.form.container.edit-srq')
    </div>
</form>
<!-- ====== Form Layout Section End -->