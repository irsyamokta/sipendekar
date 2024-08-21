import './bootstrap';
import 'flowbite'

document.addEventListener('DOMContentLoaded', () => {
    const scrollButton = document.getElementById('scroll')
    const heroSection = document.getElementById('homepage');

    function toggleButtonVisibility() {
        const heroBottom = heroSection.offsetTop + heroSection.offsetHeight;
        if (window.scrollY >= heroBottom) {
            scrollButton.style.display = 'block';
        } else {
            scrollButton.style.display = 'none';
        }
    }

    toggleButtonVisibility();

    window.addEventListener('scroll', toggleButtonVisibility);
})

document.addEventListener('DOMContentLoaded', () => {
    const preloader = document.getElementById('preloader');
    setTimeout(() => {
        preloader.style.display = 'none';
    }, 400);
});

document.addEventListener('DOMContentLoaded', () => {
    const inputPin = document.getElementById('input_pin');
    const nomorHp = document.getElementById('nomor_hp');
    const inputUsia = document.getElementById('input_usia');
    function handleInputPin(event) {
        event.target.value = event.target.value.replace(/[^0-9]/g, '');
        if (event.target.value.length > 6) {
            event.target.value = event.target.value.slice(0, 6);
        }
    }
    function handleInputNomorHp(event) {
        event.target.value = event.target.value.replace(/[^0-9]/g, '');
        if (event.target.value.length > 13) {
            event.target.value = event.target.value.slice(0, 13);
        }
    }
    function handleInputUsia(event) {
        event.target.value = event.target.value.replace(/[^0-9]/g, '');
        if (event.target.value.length > 6) {
            event.target.value = event.target.value.slice(0, 2);
        }
    }

    if (inputPin) {
        inputPin.addEventListener('input', handleInputPin);
    }

    if (nomorHp) {
        nomorHp.addEventListener('input', handleInputNomorHp);
    }
    if (inputUsia) {
        inputUsia.addEventListener('input', handleInputUsia);
    }
})

document.addEventListener('DOMContentLoaded', () => {
    let currentIndex = 0;
    let radioButtons = document.querySelectorAll('input[type="radio"]');
    let answers = {};
    const nextButton = document.getElementById('next-button');
    const prevButton = document.getElementById('prev-button');
    const finishButton = document.getElementById('finish-button');

    const updateNextButtonState = () => {
        if (answers[currentIndex] !== undefined) {
            nextButton.disabled = false;
        } else {
            nextButton.disabled = true;
        }
    };

    radioButtons.forEach(radio => {
        radio.addEventListener('change', (event) => {
            answers[currentIndex] = event.target.value;
            nextButton.disabled = false;
        });
    });

    document.querySelector('[data-carousel-next]').addEventListener('click', () => {
        if (currentIndex < totalQuestions - 1) {
            currentIndex++;
            updateNextButtonState();
            prevButton.disabled = false; // Enable the "Prev" button
        }
        if (currentIndex === totalQuestions - 1) {
            nextButton.classList.add('hidden');
            finishButton.classList.remove('hidden');
        }
    });

    document.querySelector('[data-carousel-prev]').addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            finishButton.classList.add('hidden');
            nextButton.classList.remove('hidden');
            updateNextButtonState();
        }
        if (currentIndex === 0) {
            prevButton.disabled = true;
        }
    });
    updateNextButtonState();
});

document.addEventListener('DOMContentLoaded', () => {
    const progressBar = document.getElementById('progress-bar');
    const progressText = document.getElementById('progress-text');
    let radioButtons = document.querySelectorAll('input[type="radio"]');
    let answers = new Set();

    const updateProgress = () => {
        const answeredQuestions = answers.size;
        const progressPercentage = Math.round((answeredQuestions / totalQuestions) * 100);
        progressBar.style.width = `${progressPercentage}%`;
        progressText.textContent = `${progressPercentage}%`;
    };

    radioButtons.forEach(radio => {
        radio.addEventListener('change', (event) => {
            const questionIndex = event.target.name.split('-')[1];
            answers.add(questionIndex);
            updateProgress();
        });
    });

    updateProgress();
});

document.addEventListener('DOMContentLoaded', function () {
    if (sessionStorage.getItem('session') === 'true') {
        sessionStorage.removeItem('session');
        window.location.href = "panduan"; 
    }
});

