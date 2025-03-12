@extends('app.layout')
@section('content')
    
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title mb-1">Rendimentos</h5>
                    <p class="text-muted mb-0">Os Rendimentos associados ao Produto/Pacote, estarão disponíveis aqui.</p>
                </div>
            </div>
            <div class="card-body">

                <div class="nav-align-top">
                    <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-2 gap-lg-0">
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="{{ route('product-show', ['uuid' => $product->uuid]) }}"><i class="ri-file-list-line me-2"></i>Dados</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="{{ route('packages', ['product' => $product->uuid]) }}"><i class="ri-wallet-3-line me-2"></i>Pacotes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="{{ route('investiments', ['product' => $product->uuid]) }}"><i class="ri-line-chart-line me-2"></i>Investimentos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active waves-effect waves-light" href="javascript:void(0);"><i class="ri-pie-chart-2-line me-2"></i>Rendimentos</a>
                        </li>
                    </ul>
                </div>

                <div class="btn-group mt-2 mb-3">
                    <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#createIncome">Gerar Rendimento</button>
                    <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#filterIncome">Filtrar Rendimentos</button>
                </div>

                <div class="modal-onboarding modal fade animate__animated" id="createIncome" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="" method="POST" class="modal-content text-center">
                            <div class="modal-header border-0">
                                <a class="text-muted close-label" href="javascript:void(0);" data-bs-dismiss="modal">Cancelar</a>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="onboarding-content mb-0">
                                    <h4 class="onboarding-title text-body">Dados do Pacote</h4>
                                    <div class="onboarding-info">
                                        Preencha os dados do Pacote
                                    </div>
                                    @csrf
                                    <input type="hidden" name="product" value="{{ $product }}">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-floating form-floating-outline mb-3">
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Nome:">
                                                <label for="name">Nome:</label>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-6">
                                                <textarea name="description" class="form-control" style="min-height: 120px;" id="description" placeholder="Descrição:"></textarea>
                                                <label for="description">Termos & Condições:</label>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-floating form-floating-outline mb-3">
                                                <input type="text" name="value" class="form-control" id="value" placeholder="Valor:" oninput="maskValue(this)">
                                                <label for="value">Valor:</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-floating form-floating-outline mb-3">
                                                <input type="text" name="performance" class="form-control" id="performance" placeholder="Rendimento (%):" oninput="maskPerformance(this)">
                                                <label for="performance">Rendimento (%):</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-floating form-floating-outline mb-3">
                                                <input type="text" name="binary_left_percent" class="form-control performance" id="binary_left_percent" placeholder="Esquerda (Rede %):" oninput="maskPerformance(this)">
                                                <label for="binary_left_percent">Esquerda (Rede %):</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-floating form-floating-outline mb-3">
                                                <input type="text" name="binary_right_percent" class="form-control performance" id="binary_right_percent" placeholder="Direita (Rede %):" oninput="maskPerformance(this)">
                                                <label for="binary_right_percent">Direita (Rede %):</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-floating form-floating-outline mb-3">
                                                <select name="time" class="form-select" id="time" required>
                                                    <option selected>Opções</option>
                                                    <option value="day">Diário</option>
                                                    <option value="month">Mensal</option>
                                                    <option value="semester">Semestral </option>
                                                    <option value="year">Anual</option>
                                                </select>
                                                <label for="time">Modelo</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-floating form-floating-outline mb-3">
                                                <select name="status" class="form-select" id="status" required>
                                                    <option selected>Opções</option>
                                                    <option value="1">Ativo</option>
                                                    <option value="2">Inativo</option>
                                                </select>
                                                <label for="status">Status</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0 btn-group">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Confirmar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal-onboarding modal fade animate__animated" id="filterIncome" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{ route('incomes', ['product' => $product]) }}" method="GET" class="modal-content text-center">
                            <div class="modal-header border-0">
                                <a class="text-muted close-label" href="javascript:void(0);" data-bs-dismiss="modal">Cancelar</a>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="onboarding-content mb-0">
                                    <h4 class="onboarding-title text-body">Pesquisa de Pacotes</h4>
                                    @csrf
                                    <input type="hidden" name="product" value="{{ $product }}">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-floating form-floating-outline mb-3">
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Nome:">
                                                <label for="name">Nome:</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-floating form-floating-outline mb-3">
                                                <select name="time" class="form-select" id="time">
                                                    <option value="" selected>Opções</option>
                                                    <option value="day">Diário</option>
                                                    <option value="month">Mensal</option>
                                                    <option value="semester">Semestral </option>
                                                    <option value="year">Anual</option>
                                                </select>
                                                <label for="time">Modelo</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0 btn-group">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Filtrar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Pacote</th>
                            <th class="text-center">Valor</th>
                            <th class="text-center">%</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Opções</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($incomes as $income)
                            <tr>
                                <td>
                                    <span class="fw-medium text-primary">{{ $income->package->name }}</span> <br>
                                </td>
                                 <td>
                                    <span class="fw-medium text-success">R$ {{ number_format($income->amount, 2, ',', '.') }}</span> <br>
                                </td>                                
                                <td class="text-center">
                                    <span class="fw-medium text-success">R$ {{ number_format($income->profit_percent, 2, ',', '.') }}</span> <br>
                                </td>
                                <td class="text-center">
                                    {!! $income->labelStatus() !!}
                                </td>
                                <td>
                                    <div class="d-grid gap-2 mx-auto">
                                        <form action="{{ route('income-delete') }}" method="POST" class="btn-group delete">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $income->id }}">
                                            <a data-bs-toggle="modal" data-bs-target="#updateInvestiment{{ $income->id }}" class="btn btn-icon btn-outline-dark waves-effect">
                                                <i class="text-warning tf-icons ri-edit-line ri-22px"></i>
                                            </a>
                                            {{-- <button type="button" class="btn btn-icon btn-outline-dark waves-effect">
                                                <i class="text-primary tf-icons ri-file-list-line ri-22px"></i>
                                            </button> --}}
                                            <button type="submit" class="btn btn-icon btn-outline-dark waves-effect">
                                                <i class="text-danger tf-icons ri-delete-bin-4-line ri-22px"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <form action="{{ route('income-update') }}" method="POST" class="modal-content text-center">
                                <div class="modal-onboarding modal fade animate__animated" id="updateInvestiment{{ $income->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content text-center">
                                            <div class="modal-header border-0">
                                                <a class="text-muted close-label" href="javascript:void(0);" data-bs-dismiss="modal">Cancelar</a>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <div class="onboarding-content mb-0">
                                                    <h4 class="onboarding-title text-body">Dados do Investimento</h4>
                                                    @csrf
                                                    <input type="hidden" name="income_id" value="{{ $income->id }}">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-floating form-floating-outline mb-3">
                                                                <input type="text" name="amount" class="form-control money" id="amount" placeholder="Valor:" value="{{ $income->amount }}" oninput="maskValue(this)">
                                                                <label for="amount">Valor:</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-floating form-floating-outline mb-3">
                                                                <input type="text" name="profit_percent" class="form-control performance" id="profit_percent" placeholder="Rendimento (%):" value="{{ $income->profit_percent }}" oninput="maskPerformance(this)">
                                                                <label for="profit_percent">Rendimento (%):</label>
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
                                </div>
                            </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection