@extends('layouts.app')

@section('content')
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100"
            style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">{{ __('signin') }}</h4>
                                </div>
                            </div>
                            @php
                                if(isset($data)){
                            @endphp
                                    <span style="color: red">{{ $data }}</span>
                            @php
                                }
                            @endphp
                            <div class="card-body">
                                <form method="post" class="text-start" action="{{ route('store') }}">
                                    @csrf
                                    {{-- Username --}}
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">{{ __('Email') }}</label>
                                        <input type="text" name="email" class="form-control">
                                    </div>
                                    @error('email')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                    {{-- Password --}}
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">{{ __('pass') }}</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    @error('password')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                    <div class="text-center">
                                        <button id="btnLogin" class="btn bg-gradient-primary w-100 my-4 mb-2">{{ __('login') }}</button>
                                    </div>
                                    <p class="mt-4 text-sm text-center">
                                        <a href="{{ route('forgot') }}" id="btnForgot"
                                            class="text-primary text-gradient font-weight-bold">{{ __('forgot') }}?</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
