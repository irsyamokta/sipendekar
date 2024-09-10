<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function alertSuccess() {
        Swal.fire({
            title: '@lang('screening.alert.title_success')',
            text: '@lang('screening.alert.message_success')',
            imageUrl: "../assets/img/img-success.png",
            imageWidth: 250,
            imageHeight: 250,
            imageAlt: "img success",
            confirmButtonText: '@lang('screening.alert.button_success')',
            confirmButtonColor: '#176B87',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ route('homepage') }}';
            }
        });;
    }

    function alertError() {
        Swal.fire({
            title: '@lang('screening.alert.title_error')',
            text: '@lang('screening.alert.message_error')',
            imageUrl: "../assets/img/img-danger.png",
            imageWidth: 250,
            imageHeight: 250,
            imageAlt: "img danger",
            confirmButtonText: '@lang('screening.alert.button_error')',
            confirmButtonColor: '#176B87',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
        });
    }
    @if (session('success'))
        alertSuccess();
    @elseif (session('error'))
        alertError();
    @endif
</script>
