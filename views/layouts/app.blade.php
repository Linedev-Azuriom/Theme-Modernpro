@extends('layouts.base')

@section('app')
    <main class="container content">
        @include('elements.session-alerts')

        <div id="go-to-bottom-div"
             class="{{isset(explode('/', url()->current())[3]) ? explode('/', url()->current())[3] :''}}">
            @yield('content')
        </div>
    </main>
@endsection
