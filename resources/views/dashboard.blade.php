@extends('layout')

@section('title', __('AW Dashboard'))

@section('content')
    <ul class="nav nav-pills justify-content-end p-2 bg-light">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route(config('routes.auth.logout')) }}">{{ __('Logout') }}</a>
        </li>
    </ul>
@endsection
