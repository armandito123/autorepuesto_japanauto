@extends('auth.homeLogin')
@section('content')
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{login('title')}}</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3 input-group">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                        autofocus class="form-control @error('email') is-invalid @enderror"
                        placeholder="{{login('placeholder-email')}}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>


                <div class="mb-3 input-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" placeholder="{{login('placeholder-password')}}" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <button type="submit" class="btn btn-primary btn-block">{{login('title')}}</button>
                    </div>
                </div>
            </form>
            <p class="mb-0">
                <a href="{{ route('showRegister') }}" class="text-center">{{login('registrar?')}}</a>
            </p>
        </div>
    </div>
@endsection
