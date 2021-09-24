<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.foundation.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @yield('css')
        @livewireStyles
        <script src="{{ mix('js/app.js') }}" defer></script>

    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://raw.githubusercontent.com/johnny/jquery-sortable/master/source/js/jquery-sortable-min.js"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script>
        $(function() {
            var datatables = $('#data-tables').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax : '@yield('datatables.ajax.url')',
                columns : @yield('datatables.columns'),
                language:{"url":"//cdn.datatables.net/plug-ins/1.10.12/i18n/Turkish.json"}
            });
        });
    </script>
    @yield('script')
    @if (session('message'))
        @if(session('message')[2] == 'info')
            <script>
                toastr.info('{{ session('message')[1] }}','{{ session('message')[0] }}');
            </script>
        @endif
        @if(session('message')[2] == 'success')
            <script>
                toastr.success('{{ session('message')[1] }}','{{ session('message')[0] }}');
            </script>
        @endif
        @if(session('message')[2] == 'warning')
            <script>
                toastr.warning('{{ session('message')[1] }}','{{ session('message')[0] }}');
            </script>
        @endif
        @if(session('message')[2] == 'error')
            <script>
                toastr.error('{{ session('message')[1] }}','{{ session('message')[0] }}');
            </script>
        @endif
    @endif
</html>
<div class="inline-flex items-center px-1 py-1 bg-purple-800 hover:bg-purple-700 active:bg-purple-900 focus:border-purple-900 focus:ring-purple-300 mr-2 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest  hover:text-white focus:outline-none  focus:ring  disabled:opacity-25 transition" style="display: none"></div>
<div class="inline-flex items-center px-1 text-red-500 hover:text-red-800 py-1 bg-red-800 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-red-700 hover:text-white active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition" style="display: none"></div>
<div class="inline-flex items-center px-1 py-1 bg-blue-800 mr-2 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-blue-700 hover:text-white active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition" style="display: none"></div>
<div class="inline-flex items-center px-1 py-1 mr-2 bg-blue-800 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-blue-700 hover:text-white active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition" style="display: none"></div>
<div class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm pl-4 pr-0 text-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" style="display: none"></div>
