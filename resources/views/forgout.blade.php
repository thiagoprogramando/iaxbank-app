@extends('layout')
    @section('content')
        <div class="position-relative">
            <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0">
                <div class="authentication-inner py-6">
                    <div class="card p-md-7 p-1">
                        <div class="app-brand justify-content-center mt-5">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo"> </span>
                                <span class="app-brand-text demo fw-semibold text-white">{{ env('APP_NAME') }}</span>
                            </a>
                        </div>
        
                        <div class="card-body mt-1">
                            <h4 class="mb-1 text-white text-center">Ops! Esqueceu algo?</h4>
                            <p class="mb-5 text-white text-center">Você pode redefinir sua senha, logo abaixo!</p>
                            
                            @if (empty($code))
                                <form id="formAuthentication" class="mb-5" action="{{ route('generate-code') }}" method="POST">
                                    @csrf
                                    @error('email')
                                        <div class="alert alert-outline-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Qual o seu E-mail?"/>
                                        <label for="email">Qual o seu e-mail?</label>
                                    </div>
                                    <div class="mb-5">
                                        <button class="btn btn-primary d-grid w-100" type="submit">Redefinir</button>
                                    </div>
                                    <div class="mb-5 text-center mt-5">
                                        <a href="{{ route('login') }}" class="mb-1 mt-2 text-white">
                                            <span>Já tem uma conta? Acessar!</span>
                                        </a>
                                    </div>
                                </form>
                            @else
                                <form id="formAuthentication" class="mb-5" action="{{ route('reset-password') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="code" value="{{ $code }}">
                                    @if ($errors->any())
                                        <div class="alert alert-outline-danger" role="alert">
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text" class="form-control" id="password" name="password" placeholder="Escolha uma nova senha:"/>
                                        <label for="password">Escolha uma nova senha:</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="password" class="form-control" id="passwordconfirm" name="passwordconfirm" placeholder="Confirme a nova senha:"/>
                                        <label for="passwordConfirm">Confirme a nova senha:</label>
                                    </div>
                                    <div class="mb-5">
                                        <button class="btn btn-primary d-grid w-100" type="submit">Confirmar</button>
                                    </div>
                                    <div class="mb-5 text-center mt-5">
                                        <a href="{{ route('login') }}" class="mb-1 mt-2 text-white">
                                            <span>Já tem uma conta? Acessar!</span>
                                        </a>
                                    </div>
                                </form>
                            @endif
                            <p class="text-center text-white">
                                <i>V <a href="#" target="_blank" class="text-white">0.0.1</a></i> 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
