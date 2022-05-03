@extends('layouts.admin')

@section('options')
    <div class="text-center">
        <a class="btn btn-lg btn-primary mt-4 w-50" href="clients/add-client">Dodaj klienta</a>
    </div>
@endsection

@section('table')
    <div id="clients-table" class="mt-3">
        <clients-table :clients="{{ $clients }}" :filters="{{ $filters }}">
        </clients-table>
        <div class="mt-2">
            {!! $pagination !!}
        </div>
    </div>
@endsection

@section('main')
    @yield('options')
    @yield('table')
@endsection
