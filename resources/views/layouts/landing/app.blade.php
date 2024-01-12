<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Survei Kepuasan RS. Tjitro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('modules/izitoast/css/iziToast.min.css') }}">
</head>

<body>
    {{ $slot }}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    <script src="{{ asset('modules/izitoast/js/iziToast.min.js') }}"></script>
    @livewireScripts
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.on('showError', (error) => {
                const errorMessages = Object.values(error[0]).flatMap(errorArray => errorArray).join("; ");
                iziToast.error({
                    title: 'Gagal',
                    message: errorMessages,
                    position: 'topRight'
                });
            })
        })
        @if (session()->has('error'))
            iziToast.error({
                title: 'Gagal',
                message: '{{ session()->get('error') }}',
                position: 'topRight'
            });
        @endif
        @if (session()->has('status'))
            iziToast.success({
                title: 'Berhasil',
                message: '{{ session()->get('status') }}',
                position: 'topRight'
            });
        @endif
    </script>
</body>

</html>
