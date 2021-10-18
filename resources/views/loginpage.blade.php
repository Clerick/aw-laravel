@extends('layout')

@section('title', __('AW Laravel Technical Test'))

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-4">
                <div class="login-form bg-light mt-4 p-4">
                    <form action="{{ route('auth.login') }}" method="POST" class="row g-3">
                        @csrf
                        <h4>{{ __('AW Ticket Platform') }}</h4>
                        <div class="col-12">
                            <label>{{ __('Username') }}</label>
                            <input type="text" name="username" class="form-control" placeholder="{{ __('Username') }}"
                                required>
                        </div>
                        <div class="col-12">
                            <label>{{ __('Password') }}</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="{{ __('Password') }}" required>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember">
                                <label class="form-check-label" for="rememberMe">{{ __('Remember me') }}</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-dark float-end">{{ __('Login') }}</button>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
