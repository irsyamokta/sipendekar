<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function alertPin(message) {
        Swal.fire({
            text: '@lang('screening.pin.message')',
            imageUrl: "../assets/img/img-danger.png",
            imageWidth: 250,
            imageHeight: 250,
            imageAlt: "img danger",
            confirmButtonText: '@lang('screening.pin.cta')',
            confirmButtonColor: '#176B87',
        });
    }
    alertPin('{{ session('error') }}');
</script>