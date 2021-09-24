<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Talepler') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-6">
                <table class=" table table-striped table-bordered dt-responsive nowrap" data-order='[[ 3, "asc" ]]'  id="data-tables">
                    <thead>
                    <tr>
                        <th>Ad & Soyad</th>
                        <th>E-mail</th>
                        <th>Mesaj</th>
                        <th>Oluşturulma Zamanı</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @section('datatables.ajax.url'){{route('form.datatables')}}@stop
    @section('datatables.columns')
        [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'message', name: 'message' },
            { data: 'created_at', name: 'created_at' },
        ]
    @stop
</x-app-layout>

