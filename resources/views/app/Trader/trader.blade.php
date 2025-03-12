@extends('app.layout')
@section('content')
    <link rel="stylesheet" href="{{ asset('template/vendor/libs/apex-charts/apex-charts.css') }}"/>

    <div class="col-12 col-sm-12 col-md-8 col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <h5 class="card-title mb-0">{{ $product->acronym }}</h5>
                    <small class="text-muted">{{ $product->name }}</small>
                </div>
                <div class="d-sm-flex d-none align-items-center">
                    <h5 class="mb-0 me-4">R$ {{ number_format($product->value, 2, ',', '.') }}</h5>
                    <span class="badge bg-label-secondary rounded-pill">
                        <i class="ri-arrow-down-line ri-14px text-danger"></i>
                        <span class="align-middle">20%</span>
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div id="lineChart"></div>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
        @foreach ($packages as $package)
            <button type="button" class="btn btn-lg btn-success waves-effect waves-light w-100 mb-2" data-bs-toggle="modal" data-bs-target="#investProduct{{ $package->id }}">{{ $package->name }}</button>

            <form action="{{ route('investiment-create') }}" method="POST">
                @csrf
                <input type="hidden" name="product" value="{{ $product->uuid }}">
                <input type="hidden" name="package" value="{{ $package->id }}">
                <input type="hidden" name="amount" value="{{ $package->value }}">
                <input type="hidden" name="performance" value="{{ $package->performance }}">
                <div class="modal-onboarding modal fade animate__animated" id="investProduct{{ $package->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content text-center">
                            <div class="modal-header border-0">
                                <a class="text-muted close-label" href="javascript:void(0);" data-bs-dismiss="modal">Alterar Opção</a>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0 text-white">
                                <div class="onboarding-content mb-0">
                                    <h4 class="onboarding-title">{{ $package->name }}</h4>
                                    <div class="onboarding-info mb-3">
                                        {{ $package->description }}
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-floating form-floating-outline mb-4">
                                                <select name="method" class="form-select" tabindex="0" id="method">
                                                    <option>PIX</option>
                                                    <option disabled>Cartão de Crédito</option>
                                                    <option disabled>Carteira</option>
                                                </select>
                                                <label for="method">Formas de Pagamento</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-floating form-floating-outline mb-4">
                                                <input name="password" class="form-control" placeholder="Informe sua Senha:" type="password" id="password"/>
                                                <label for="password">Informe sua Senha:</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0 btn-group">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endforeach

        <div class="card p-3 text-white">
            <p class="lead"><b>Descrição</b></p>
            <small>{{ $product->description }}</small>
        </div>
    </div>
@endsection