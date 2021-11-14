@extends('layout')

@section('title', __('Success'))

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center mt-5 p-4 bg-info">
            <h2 class="text-center">
                {{ __('Your Request Has Been Successfuly submitted with uid:') }}<br>
                {{ $uid }}
            </h2>
        </div>
    </div>
@endsection
