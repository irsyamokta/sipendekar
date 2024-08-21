document.addEventListener('DOMContentLoaded', () => {
    const generate = document.getElementById('generate');
    const inputPin = document.getElementById('input-pin');

    function generatePin() {
        const newPin = Math.floor(100000 + Math.random() * 900000).toString().padStart(6, '0');
        localStorage.setItem('generatedPin', newPin);
        sessionStorage.setItem('pinActive', 'true');
        inputPin.value = newPin;
    }

    if (localStorage.getItem('generatedPin') && sessionStorage.getItem('pinActive') === 'true') {
        const savedPin = localStorage.getItem('generatedPin');
        inputPin.value = savedPin;
        generate.textContent = 'Akhiri';
        generate.classList.add('bg-red-900');
    }

    generate.addEventListener('click', () => {
        if (generate.textContent === 'Mulai') {
            generatePin();
            generate.textContent = 'Akhiri';
            generate.classList.remove('bg-secondary');
            generate.classList.add('bg-red-900');
        } else {
            localStorage.removeItem('generatedPin');
            sessionStorage.removeItem('pinActive');
            inputPin.value = '';
            generate.textContent = 'Mulai';
            generate.classList.remove('bg-red-900');
            generate.classList.add('bg-secondary');
        }
    });
});

document.querySelectorAll('.delete-confirm').forEach((button) => {
    button.addEventListener('click', function (e) {
        e.preventDefault();
        const url = this.href;
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Kamu tidak akan bisa mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#176B87',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const elements = [
        { id: 'domain', value: domainValue },
        { id: 'tidak-benar', value: tidakBenar },
        { id: 'agak-benar', value: agakBenar },
        { id: 'selalu-benar', value: selaluBenar }
    ];

    elements.forEach(element => {
        const selectElement = document.getElementById(element.id);
        if (selectElement && element.value) {
            Array.from(selectElement.options).forEach((option, index) => {
                if (option.value === element.value) {
                    selectElement.remove(index);
                }
            });
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const addSdqFirst = document.getElementById("add-sdq-first")
    const addSdqSecond = document.getElementById("add-sdq-second")
    const addSrq = document.getElementById("add-srq")
    let questionsAdd = false


    if (addSdqFirst) {
        addSdqFirst.addEventListener('click', () => {
            const container = document.getElementById("sdq-container")
            const newCard = document.createElement('div')
            const newQuestionCount = container.getElementsByClassName('sdq-question').length + 1

            if (questionsAdd) {
                return
            }

            newCard.className = 'sdq-question rounded-sm border border-stroke bg-white px-7.5 py-4 shadow-default dark:border-strokedark dark:bg-boxdark'
            newCard.innerHTML = `
                        <div class="flex flex-col">
                            <div id="toast-warning" class="items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-yellow-300 ease-in hidden" role="alert">
                                <div class="flex items-center">
                                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div>
                                        <span class="font-medium">Form tidak lengkap!</span> Pastikan formulir tidak ada yang kosong
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-lg font-regular text-dark dark:text-primary">Pertanyaan ${newQuestionCount}</span>
                                    <span class="hidden"><input type="text" name="kategori" value="4-10 Tahun"></span>
                                </div>
                                <div class="flex gap-2">
                                    <button>
                                        <a class="flex justify-center items-center gap-1 text-sm font-medium w-[80px] h-[25px] md:w-[96px] md:h-[30px] cursor-pointer rounded-[30px] bg-[#D9D9D9] text-dark duration-300 ease-linear">
                                            <img src="/assets/icon/icon-save.png" alt="simpan" class="w-3 h-3 md:w-4 md:h-4">
                                            <span>Simpan</span>
                                        </a>
                                    </button>
                                    <a href="" class="delete-sdq flex justify-center items-center gap-1 text-sm font-medium w-[70px] h-[25px] md:w-[80px] md:h-[30px] cursor-pointer rounded-[30px] bg-[#D9D9D9] text-dark duration-300 ease-linear">
                                        <img src="/assets/icon/icon-delete.png" alt="edit" class="w-3 h-3 md:w-4 md:h-4">
                                        <span>Hapus</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex flex-col md:flex-row gap-2">
                            <textarea name="pertanyaan" rows="3" class="w-full overflow-auto dark:bg-transparent" placeholder="Tulis pertanyaan..." required></textarea>
                            <select name="domain" id="domain" class="h-12 text-sm md:text-md dark:bg-transparent">
                                <option class="text-xs md:text-md" value="" disabled selected>Pilih Domain</option>
                                <option class="text-xs md:text-md" value="E">E</option>
                                <option class="text-xs md:text-md" value="C">C</option>
                                <option class="text-xs md:text-md" value="H">H</option>
                                <option class="text-xs md:text-md" value="P">P</option>
                                <option class="text-xs md:text-md" value="Pro">Pro</option>
                            </select>
                        </div>
                        <div class="flex flex-col md:flex-row gap-2 mt-2">
                            <select name="tidak_benar" id="tidak-benar" class="h-12 text-sm md:text-md dark:bg-transparent">
                                <option class="text-xs md:text-md" value="" disabled selected>Tidak Benar</option>
                                <option class="text-xs md:text-md" value="0">0</option>
                                <option class="text-xs md:text-md" value="1">1</option>
                                <option class="text-xs md:text-md" value="2">2</option>
                            </select>
                            <select name="agak_benar" id="agak-benar" class="h-12 text-sm md:text-md dark:bg-transparent">
                                <option class="text-xs md:text-md" value="" disabled selected>Agak Benar</option>
                                <option class="text-xs md:text-md" value="0">0</option>
                                <option class="text-xs md:text-md" value="1">1</option>
                                <option class="text-xs md:text-md" value="2">2</option>
                            </select>
                            <select name="selalu_benar" id="selalu-benar" class="h-12 text-sm md:text-md dark:bg-transparent">
                                <option class="text-xs md:text-md" value="" disabled selected>Selalu Benar</option>
                                <option class="text-xs md:text-md" value="0">0</option>
                                <option class="text-xs md:text-md" value="1">1</option>
                                <option class="text-xs md:text-md" value="2">2</option>
                            </select>
                        </div>
                            
                    `
            container.appendChild(newCard)
            questionsAdd = true
            newCard.querySelector('.delete-sdq').addEventListener('click', function (e) {
                e.preventDefault();
                container.removeChild(newCard);
                questionsAdd = false
            })
        })

        document.querySelectorAll('.delete-sdq').forEach(function (deleteButton) {
            deleteButton.addEventListener('click', function (e) {
                e.preventDefault();
                const questionDiv = this.closest('.sdq-question');
                questionDiv.parentNode.removeChild(questionDiv);
            })
        })

        document.getElementById('sdq-form').addEventListener('submit', function (e) {
            const selectDomain = document.getElementById('domain');
            const selectTidakBenar = document.getElementById('tidak-benar');
            const selectAgakBenar = document.getElementById('agak-benar');
            const selectSelaluBenar = document.getElementById('selalu-benar');
            const toastWarning = document.getElementById('toast-warning');
            if (selectDomain.value === "" || selectTidakBenar.value === "" || selectAgakBenar.value === "" || selectSelaluBenar.value === "") {
                e.preventDefault();
                toastWarning.classList.remove('hidden');
            }
        })
    }
    if (addSdqSecond) {
        addSdqSecond.addEventListener('click', () => {
            const container = document.getElementById("sdq-container")
            const newCard = document.createElement('div')
            const newQuestionCount = container.getElementsByClassName('sdq-question').length + 1
            if (questionsAdd) {
                return
            }
            newCard.className = 'sdq-question rounded-sm border border-stroke bg-white px-7.5 py-4 shadow-default dark:border-strokedark dark:bg-boxdark'
            newCard.innerHTML = `
                        <div class="flex flex-col">
                            <div id="toast-warning" class="items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-yellow-300 ease-in hidden" role="alert">
                                <div class="flex items-center">
                                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div>
                                        <span class="font-medium">Form tidak lengkap!</span> Pastikan formulir tidak ada yang kosong
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-lg font-regular text-dark dark:text-primary">Pertanyaan ${newQuestionCount}</span>
                                    <span class="hidden"><input type="text" name="kategori" value="11-17 Tahun"></span>
                                </div>
                                <div class="flex gap-2">
                                    <button>
                                        <a class="flex justify-center items-center gap-1 text-sm font-medium w-[80px] h-[25px] md:w-[96px] md:h-[30px] cursor-pointer rounded-[30px] bg-[#D9D9D9] text-dark duration-300 ease-linear">
                                            <img src="/assets/icon/icon-save.png" alt="simpan" class="w-3 h-3 md:w-4 md:h-4">
                                            <span>Simpan</span>
                                        </a>
                                    </button>
                                    <a href="" class="delete-sdq flex justify-center items-center gap-1 text-sm font-medium w-[70px] h-[25px] md:w-[80px] md:h-[30px] cursor-pointer rounded-[30px] bg-[#D9D9D9] text-dark duration-300 ease-linear">
                                        <img src="/assets/icon/icon-delete.png" alt="edit" class="w-3 h-3 md:w-4 md:h-4">
                                        <span>Hapus</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex flex-col md:flex-row gap-2">
                            <textarea name="pertanyaan" rows="3" class="w-full overflow-auto dark:bg-transparent" placeholder="Tulis pertanyaan..." required></textarea>
                            <select name="domain" id="domain" class="h-12 text-sm md:text-md dark:bg-transparent">
                                <option class="text-xs md:text-md" value="" disabled selected>Pilih Domain</option>
                                <option class="text-xs md:text-md" value="E">E</option>
                                <option class="text-xs md:text-md" value="C">C</option>
                                <option class="text-xs md:text-md" value="H">H</option>
                                <option class="text-xs md:text-md" value="P">P</option>
                                <option class="text-xs md:text-md" value="Pro">Pro</option>
                            </select>
                        </div>
                        <div class="flex flex-col md:flex-row gap-2 mt-2">
                            <select name="tidak_benar" id="tidak-benar" class="h-12 text-sm md:text-md dark:bg-transparent">
                                <option class="text-xs md:text-md" value="" disabled selected>Tidak Benar</option>
                                <option class="text-xs md:text-md" value="0">0</option>
                                <option class="text-xs md:text-md" value="1">1</option>
                                <option class="text-xs md:text-md" value="2">2</option>
                            </select>
                            <select name="agak_benar" id="agak-benar" class="h-12 text-sm md:text-md dark:bg-transparent">
                                <option class="text-xs md:text-md" value="" disabled selected>Agak Benar</option>
                                <option class="text-xs md:text-md" value="0">0</option>
                                <option class="text-xs md:text-md" value="1">1</option>
                                <option class="text-xs md:text-md" value="2">2</option>
                            </select>
                            <select name="selalu_benar" id="selalu-benar" class="h-12 text-sm md:text-md dark:bg-transparent">
                                <option class="text-xs md:text-md" value="" diasabled selected>Selalu Benar</option>
                                <option class="text-xs md:text-md" value="0">0</option>
                                <option class="text-xs md:text-md" value="1">1</option>
                                <option class="text-xs md:text-md" value="2">2</option>
                            </select>
                        </div>
                    `
            container.appendChild(newCard)
            questionsAdd = true
            newCard.querySelector('.delete-sdq').addEventListener('click', function (e) {
                e.preventDefault();
                container.removeChild(newCard);
                questionsAdd = false
            })
        })

        document.querySelectorAll('.delete-sdq').forEach(function (deleteButton) {
            deleteButton.addEventListener('click', function (e) {
                e.preventDefault();
                const questionDiv = this.closest('.sdq-question');
                questionDiv.parentNode.removeChild(questionDiv);
            })
        })

        document.getElementById('sdq-form').addEventListener('submit', function (e) {
            const selectDomain = document.getElementById('domain');
            const selectTidakBenar = document.getElementById('tidak-benar');
            const selectAgakBenar = document.getElementById('agak-benar');
            const selectSelaluBenar = document.getElementById('selalu-benar');
            const toastWarning = document.getElementById('toast-warning');
            if (selectDomain.value === "" || selectTidakBenar.value === "" || selectAgakBenar.value === "" || selectSelaluBenar.value === "") {
                e.preventDefault();
                toastWarning.classList.remove('hidden');
            }
        })
    }

    if (addSrq) {
        addSrq.addEventListener('click', () => {
            const container = document.getElementById("srq-container")
            const newCard = document.createElement('div')
            const newQuestionCount = container.getElementsByClassName('srq-question').length + 1
            if (questionsAdd) {
                return
            }
            newCard.className = 'srq-question rounded-sm border border-stroke bg-white px-7.5 py-4 shadow-default dark:border-strokedark dark:bg-boxdark'
            newCard.innerHTML = `
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-lg font-regular text-dark dark:text-primary">Pertanyaan ${newQuestionCount}</span>
                            </div>
                            <div class="flex gap-2">
                                <button>
                                    <a class="flex justify-center items-center gap-1 text-sm font-medium w-[80px] h-[25px] md:w-[96px] md:h-[30px] cursor-pointer rounded-[30px] bg-[#D9D9D9] text-dark duration-300 ease-linear">
                                        <img src="/assets/icon/icon-save.png" alt="simpan" class="w-3 h-3 md:w-4 md:h-4">
                                        <span>Simpan</span>
                                    </a>
                                </button>
                                <a href="" class="delete-srq flex justify-center items-center gap-1 text-sm font-medium w-[70px] h-[25px] md:w-[80px] md:h-[30px] cursor-pointer rounded-[30px] bg-[#D9D9D9] text-dark duration-300 ease-linear">
                                    <img src="../assets/icon/icon-delete.png" alt="edit" class="w-3 h-3 md:w-4 md:h-4">
                                    <span>Hapus</span>
                                </a>
                            </div>
                        </div>
                        <div class="mt-4">
                            <textarea name="pertanyaan" rows="3" placeholder="Tulis pertanyaan..." class="w-full overflow-auto dark:bg-transparent" required></textarea>
                        </div>
                    `
            container.appendChild(newCard)
            questionsAdd = true
            newCard.querySelector('.delete-srq').addEventListener('click', function (e) {
                e.preventDefault();
                container.removeChild(newCard);
                questionsAdd = false
            })
        })

        document.querySelectorAll('.delete-srq').forEach(function (deleteButton) {
            deleteButton.addEventListener('click', function (e) {
                e.preventDefault();
                const questionDiv = this.closest('.srq-question');
                questionDiv.parentNode.removeChild(questionDiv);
            });
        });
    }
})

