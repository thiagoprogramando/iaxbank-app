@extends('layout')
    @section('content')
        <div class="position-relative">
            <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0">
                <div class="authentication-inner py-6">
                    <div class="card p-md-7 p-1">
                        <div class="app-brand justify-content-center mt-5">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo"></span>
                                <span class="app-brand-text demo text-heading fw-semibold">{{ env('APP_NAME') }}</span>
                            </a>
                        </div>
        
                        <div class="card-body mt-1">
                            <h4 class="mb-1">Faça parte!</h4>
                            <p class="mb-5 text-white">Preenche os seus dados para ter acesso aos nossos benefícios.</p>
                            @if (session('error'))
                                <div class="alert alert-outline-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
            
                            <form id="formAuthentication" class="mb-5" action="{{ route('registrer') }}" method="POST">
                                @csrf
                                <input type="hidden" name="sponsor_id" value="{{ $indicator }}">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nome:"/>
                                    <label for="name">Nome</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="text" class="form-control cpfcnpjS" id="cpfcnpj" name="cpfcnpj" placeholder="CPF/CNPJ:" oninput="maskCpfCnpj(this)"/>
                                    <label for="cpfcnpj">CPF/CNPJ</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail:"/>
                                    <label for="email">E-mail</label>
                                </div>
                                <div class="mb-5">
                                    <div class="form-password-toggle">
                                        <div class="input-group input-group-merge">
                                            <div class="form-floating form-floating-outline">
                                                <input type="password" id="password" class="form-control" name="password" placeholder="Senha:" aria-describedby="password"/>
                                                <label for="password">Senha</label>
                                            </div>
                                            <span class="input-group-text cursor-pointer">
                                                <i class="ri-eye-off-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-5 d-flex justify-content-between mt-5">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="terms" id="terms" checked/>
                                        <label class="form-check-label" for="terms"> Termos e Condições </label>
                                    </div>
                                    <a href="{{ route('forgout') }}" class="float-end mb-1 mt-2 text-white">
                                        <span>Esqueceu a senha?</span>
                                    </a>
                                </div>
                                <div class="mb-5">
                                    <button class="btn btn-primary d-grid w-100" type="submit">Avançar</button>
                                </div>
                            </form>
            
                            <p class="text-center text-white">
                                <span>Já tem uma conta?</span>
                                <a href="{{ route('login') }}" class="text-white">
                                    <span>Acesse!</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
