@extends('layout')

@section('title', __('AW Dashboard'))

@section('content')
    <ul class="nav nav-pills justify-content-end p-2 bg-light">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page"
                href="{{ route(config('routes.auth.logout')) }}">{{ __('Logout') }}</a>
        </li>
    </ul>

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8">
                <div class="ticket-form bg-light mt-4 p-4">
                    <form action="{{ route(config('routes.submit.ticket')) }}" method="POST" class="row g-3">
                        @csrf
                        <h4>{{ __('Please fill out the form') }}</h4>
                        <div class="col-6">
                            <label for="userName">{{ __('Username') }}</label>
                            <input type="text" name="user_name" id="userName"  class="form-control"
                                placeholder="{{ __('Your username') }}" value="{{ old('user_name') }}" required>
                        </div>
                        <div class="col-6">
                            <label for="userEmail">{{ __('Email') }}</label>
                            <input type="email" name="user_email" id="userEmail" class="form-control"
                                placeholder="{{ __('Your email') }}" value="{{ old('user_email') }}" required>
                        </div>
                        <div class="col-12">
                            <label for="subject">{{ __('Subject') }}</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="{{ __('Subject') }}"
                                value="{{ old('subject') }}" required>
                        </div>

                        <div class="col-12">
                            <label for="author">{{ __('Author') }}</label>
                            <select name="author" id="author" class="form-select" required>
                                <option value="">{{ __('Please, Select The Author') }}</option>
                                @foreach ($messageAuthors as $messageAuthor)
                                    <option value="{{ $messageAuthor }}" {{ old('author') == $messageAuthor ? "selected" : "" }}>{{ ucfirst(__($messageAuthor)) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="content">{{ __('Content') }}</label>
                            <textarea class="form-control" name="content" id="content" rows="7" required>{{ old('content') }}</textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-dark float-end">{{ __('Submit') }}</button>
                        </div>

                        @error('saveException')
                            <div class="alert alert-danger" role="alert">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
