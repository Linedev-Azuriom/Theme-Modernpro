@extends('layouts.base')

@section('app')
    <main class="container content">
        @include('elements.session-alerts')

        <div id="go-to-bottom-div">
            @yield('content')
        </div>
    </main>
@endsection
