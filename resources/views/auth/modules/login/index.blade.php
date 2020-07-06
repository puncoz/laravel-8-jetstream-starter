@extends('auth.layouts.app')

@section('title', 'Login')

@section('content')
    <div class="lg:w-4/12 md:w-6/12 px-4 sm:w-2/3 w-full">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-white border-0">
            <div class="flex-auto px-4 lg:px-8 py-6">
                @if($errors->has('login-failed'))
                    <div class="bg-danger-light border border-danger text-danger text-sm mb-5 px-4 py-3 rounded relative" role="alert">
                        {{ $errors->first('login-failed') }}
                    </div>
                @endif

                {!! Form::open([
                    'route' => 'auth.login.post',
                    'method' => 'post',
                    'id' => 'login-form',
                    'role' => 'form'
                ]) !!}

                <div class="relative w-full mb-3">
                    {!! Form::label('username', 'Username', [
                        'class' => 'block uppercase text-xs font-bold mb-2'
                    ]) !!}

                    {!! Form::text('username', null, [
                        'class' => 'px-3 py-3 placeholder-gray-600 bg-primary-light rounded text-sm shadow focus:outline-none focus:shadow-outline w-full'.($errors->has('username') ? ' border border-danger bg-danger-light' : ''),
                        'placeholder' => 'your username or email',
                        'autofocus' => true,
                        'style' => 'transition: all 0.15s ease 0s;'
                    ]) !!}

                    @if ($errors->has('username'))
                        <span class="text-xs text-danger" role="alert">
                            {{ $errors->first('username') }}
                        </span>
                    @endif
                </div>

                <div class="relative w-full mb-3">
                    {!! Form::label('password', 'Password', [
                        'class' => 'block uppercase text-xs font-bold mb-2'
                    ]) !!}

                    {!! Form::password('password', [
                        'class' => 'px-3 py-3 placeholder-gray-600 bg-primary-light rounded text-sm shadow focus:outline-none focus:shadow-outline w-full'.($errors->has('password') ? ' border border-danger bg-danger-light' : ''),
                        'placeholder' => 'your password',
                        'autofocus' => true,
                        'style' => 'transition: all 0.15s ease 0s;'
                    ]) !!}

                    @if ($errors->has('password'))
                        <span class="text-xs text-danger" role="alert">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>

                <div>
                    <label class="inline-flex items-center cursor-pointer">
                        {!! Form::checkbox('remember', true, null, [
                            'class' => 'form-checkbox ml-1 w-5 h-5 text-primary-light',
                            'id' => 'remember',
                        ]) !!}
                        <span class="ml-2 text-sm font-semibold">Remember me</span>
                    </label>
                </div>

                <div class="text-center mt-6">
                    <button
                        class="bg-primary text-white active:bg-primary text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full"
                        type="submit"
                        style="transition: all 0.15s ease 0s;">
                        Sign In
                    </button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
