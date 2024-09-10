<!-- Modal toggle -->
<button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
    class="block text-white bg-gradient-to-r from-accent to-secondary focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium  text-sm px-5 py-2.5 text-center rounded-[30px]"
    type="button">@lang('screening.feedback.button')
</button>
<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5  rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    @lang('screening.feedback.title')
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('submitFeedback') }}" method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 text-start">@lang('screening.feedback.name')</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Tulis nama lengkap" value="{{ $participant->nama_lengkap }}" readonly>
                    </div>
                    <div class="col-span-2">
                        <label for="school"
                            class="block mb-2 text-sm font-medium text-gray-900 text-start">@lang('screening.feedback.school')</label>
                        <input type="text" name="school" id="school"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="@lang('screening.feedback.placeholder-school')" required>
                    </div>
                    <div class="col-span-2">
                        <label for="feedback"
                            class="block mb-2 text-sm font-medium text-gray-900 text-start">@lang('screening.feedback.experience')</label>
                        <textarea id="feedback" name="feedback" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="@lang('screening.feedback.placeholder-experience')" required></textarea>
                    </div>
                </div>
                <button type="submit"
                    class="text-white inline-flex items-center bg-gradient-to-r from-accent to-secondary  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-[30px] text-sm px-5 py-2.5 text-center">
                    @lang('screening.feedback.submit')
                </button>
            </form>
        </div>
    </div>
</div>
