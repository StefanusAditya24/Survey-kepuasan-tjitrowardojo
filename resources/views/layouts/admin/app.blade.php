<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ $title ?? 'Page' }} &mdash; Admin Survei Kepuasan</title>
    @include('layouts.admin.partials.styles')
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('layouts.admin.partials.navbar')
            @include('layouts.admin.partials.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>{{ $title ?? 'Page' }}</h1>
                    </div>

                    <div class="section-body">
                        @include('layouts.admin.partials.scripts')
                        {{ $slot }}
                    </div>
                </section>
            </div>
            @include('layouts.admin.partials.footer')
        </div>
    </div>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
</body>

</html>
