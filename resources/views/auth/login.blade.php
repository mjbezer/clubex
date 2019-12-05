@extends('layouts.template')

@section('content')

<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class="card-box">
        <div class="panel-heading">
            <img class="img-logo" src="{{asset('assets/images/logo_clubex.png')}}" alt="">

        </div>


        <div class="p-20">
            <form class="form-horizontal m-t-20" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group-custom">
                    <input type="email" id="email" name="email" class="@error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required autocomplete="email" autofocus />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label class="control-label" for="email">
                        E-Mail
                    </label><i class="bar"></i>

                </div>

                <div class="form-group-custom">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label class="control-label" for="password">Senha</label><i class="bar"></i>
                </div>

                <div class="form-group ">
                    <div class="col-12">
                        <div class="checkbox checkbox-primary">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group text-center m-t-40">
                    <div class="col-12">
                        <button class="btn btn-success btn-block text-uppercase waves-effect waves-light"
                            type="submit">Acessar
                        </button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-12">
                        @if (Route::has('password.request'))

                        <a href="{{ route('password.request') }}" class="text-dark"><i class="fa fa-lock m-r-5"></i>
                            Esqueceu
                            sua
                            senha?</a>
                        @endif


                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-12 text-center">
        <p class="text-white">Não tem Acesso? <a href="{{ route('associate.register') }}"
                class="text-white m-l-5"><b>Cadastre-se!</b></a>
        </p>

    </div>
</div>

</div>
@endsection