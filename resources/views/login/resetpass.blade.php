@extends('layouts.app')

@section('content')
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">{{ __('resetpass') }}
                                    </h4>
                                </div>
                            </div>
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @elseif ($message = Session::get('error'))
                                <div class="alert alert-danger">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
                            <div class="card-body">
                                <form method="post" class="text-start" action="{{ route('storeResetPass') }}">
                                    @csrf
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">{{ __('oldpass') }}: </label>
                                        <input type="password" name="oldpass" class="form-control">
                                    </div>
                                    @error('oldpass')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">{{ __('newpass') }}: </label>
                                        <input type="password" name="newpass" class="form-control">
                                    </div>
                                    @error('newpass')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">{{ __('confirmpass') }}: </label>
                                        <input type="password" name="confirmpass" class="form-control">
                                    </div>
                                    @error('confirmpass')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                    <div class="text-center">
                                        <button
                                            class="btn bg-gradient-primary w-70 my-4 mb-2">{{ __('resetpass') }}</button>
                                    </div>
                                    <div class="text-center">
                                        <a href="{{ route('home') }}"
                                            class="btn bg-gradient-primary w-70 my-4 mb-2">{{ __('home') }}</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
