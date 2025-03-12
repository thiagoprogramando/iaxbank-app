@extends('app.layout')
@section('content')
    
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title mb-1">Lista de Acompanhamento</h5>
                    <p class="text-muted mb-0">Títulos, Moedas & Investimentos</p>
                </div>
                <div class="dropdown">
                    <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-calendar-2-line"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Hoje</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Ontem</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Últimos 7 dias</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Últimos 30 dias</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Investir</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Meus Investimentos</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    @foreach ($products as $product)
                        <a href="{{ route('trader', ['uuid' => $product->uuid]) }}">
                            <li class="d-flex align-items-center mb-6">
                                <div class="avatar avatar-md flex-shrink-0 me-4">
                                    <div class="rounded-3">
                                        <div>
                                            <img src="{{ asset('storage/' . $product->photo) ?? asset('tmeplate/img/avatars/1.png') }}" alt="User" class="h-25">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-1">{{ $product->name }}</h6>
                                        <small class="text-white">{{ $product->acronym }}</small>
                                    </div>
                                    <div class="badge bg-label-success rounded-pill">+ 35.9%</div>
                                </div>
                            </li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-md-7 order-2 order-md-1">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Olá, <span class="fw-bold">{{ Auth::user()->labelName() }}!</span> 🎉</h4>
                        <p class="mb-0 text-white">Você pode indicar amigos ou parceiros 😎</p>
                        <p class="text-white">E receber comissões por isso!</p>
                        <button onclick="onClip('{{ route('register', ['indicator' => Auth::user()->uuid]) }}')" class="btn btn-primary">
                            Enviar Indicação
                        </button>                         
                    </div>
                </div>
                <div class="col-md-5 text-center text-md-end order-1 order-md-2">
                    <div class="card-body pb-0 px-0 pt-2">
                        <img src="{{ url('template/img/illustrations/illustration-john-light.png') }}" height="186" class="scaleX-n1-rtl">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection