@extends('app.layout')
@section('content')
    
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title mb-1">Meus Investimentos</h5>
                    <p class="text-muted mb-0">Títulos, Moedas & Investimentos</p>
                </div>
                <div class="dropdown">
                    <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-settings-4-line"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="{{ route('cart') }}" class="dropdown-item d-flex align-items-center">Todos</a>
                        </li>
                        <li>
                            <a href="{{ route('cart') }}?status=1" class="dropdown-item d-flex align-items-center">Ativos</a>
                        </li>
                        <li>
                            <a href="{{ route('cart') }}?status=2" class="dropdown-item d-flex align-items-center">Pendentes</a>
                        </li>
                        <li>
                            <a href="{{ route('cart') }}?status=3" class="dropdown-item d-flex align-items-center">Cancelados</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    @foreach ($investiments as $investiment)
                        <a href="{{ route('trader', ['uuid' => $investiment->product->uuid]) }}">
                            <li class="d-flex align-items-center mb-6">
                                <div class="avatar avatar-md flex-shrink-0 me-4">
                                    <div class="rounded-3">
                                        <div>
                                            <img src="{{ asset('storage/' . $investiment->product->photo) ?? asset('tmeplate/img/avatars/1.png') }}" alt="User" class="h-25">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-1">{{ $investiment->product->name }}</h6>
                                        <small class="text-white">{{ $investiment->package->name ?? 'Pacote não disponível' }}</small>
                                    </div>
                                    <div class="badge bg-label-dark rounded-pill">R$ {{ number_format($investiment->amount, 2, ',', '.') }}</div>
                                </div>
                            </li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection