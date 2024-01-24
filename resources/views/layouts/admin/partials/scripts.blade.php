<!-- General JS Scripts -->
<script src="{{ asset('modules/jquery.min.js') }}"></script>
<script src="{{ asset('modules/popper.js') }}"></script>
<script src="{{ asset('modules/tooltip.js') }}"></script>
<script src="{{ asset('modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('modules/moment.min.js') }}"></script>
<script src="{{ asset('js/stisla.js') }}"></script>

<!-- JS Libraries -->
<script src="{{ asset('modules/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('modules/chart.min.js') }}"></script>
<script src="{{ asset('modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('modules/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
<script src="{{ asset('modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('modules/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('modules/izitoast/js/iziToast.min.js') }}"></script>

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

@livewireScripts
<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.on('showError', (error) => {
            iziToast.error({
                title: 'Gagal',
                message: error,
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
