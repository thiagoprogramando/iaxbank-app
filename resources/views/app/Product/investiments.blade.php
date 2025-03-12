@extends('app.layout')
@section('content')
    
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title mb-1">Investimentos</h5>
                    <p class="text-muted mb-0">Os investimentos/depósitos associados ao Produto, estarão disponíveis aqui.</p>
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
                            <a class="nav-link active waves-effect waves-light" href="javascript:void(0);"><i class="ri-line-chart-line me-2"></i>Investimentos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="{{ route('incomes', ['product' => $product->uuid]) }}"><i class="ri-pie-chart-2-line me-2"></i>Rendimentos</a>
                        </li>
                    </ul>
                </div>

                <div class="btn-group mt-2 mb-3">
                    <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#filterPackage">Filtrar Investimentos</button>
                </div>

                <div class="modal-onboarding modal fade animate__animated" id="filterPackage" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{ route('investiments', ['product' => $product->uuid]) }}" method="GET" class="modal-content text-center">
                            <div class="modal-header border-0">
                                <a class="text-muted close-label" href="javascript:void(0);" data-bs-dismiss="modal">Cancelar</a>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="onboarding-content mb-0">
                                    <h4 class="onboarding-title text-body">Pesquisa de Investimentos</h4>
                                    @csrf
                                    <input type="hidden" name="product" value="{{ $product->uuid }}">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-floating form-floating-outline mb-3">
                                                <select name="users[]" id="select2Multiple" class="select2 form-select" multiple>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="select2Multiple">Usuários</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-floating form-floating-outline mb-3">
                                                <select name="package_id" class="form-select" id="status">
                                                    <option value="" selected>Opções</option>
                                                    @foreach ($packages as $package)
                                                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="package_id">Pacotes</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-floating form-floating-outline mb-3">
                                                <select name="status" class="form-select" id="status">
                                                    <option value="" selected>Opções</option>
                                                    <option value="1">Aprovado</option>
                                                    <option value="2">Pendente</option>
                                                    <option value="3">Cancelado</option>
                                                </select>
                                                <label for="status">Status</label>
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
                            <th>Investidor</th>
                            <th>Valores</th>
                            <th class="text-center">Pagamento/Token</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Opções</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($investiments as $investiment)
                            <tr>
                                <td>
                                    <span class="fw-medium text-primary">{{ $investiment->user->name }}</span> <br>
                                    <small>{{ $investiment->user->email }}</small>
                                </td>
                                 <td>
                                    <span class="fw-medium text-success">R$ {{ number_format($investiment->amount, 2, ',', '.') }}</span> <br>
                                    <small>{{ $investiment->package->name ?? 'Pacote indisponível' }}</small>
                                </td>                                
                                <td class="text-center">
                                    <a class="fw-medium text-success" href="{{ $investiment->payment_payload }}" target="_blank">{{ $investiment->payment_payload }}</a> <br>
                                    <small>{{ $investiment->payment_token }}</small>
                                </td>
                                <td class="text-center">
                                    {!! $investiment->labelStatus() !!}
                                </td>
                                <td>
                                    <div class="d-grid gap-2 mx-auto">
                                        <form action="{{ route('investiment-delete') }}" method="POST" class="btn-group delete">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $investiment->id }}">
                                            <a data-bs-toggle="modal" data-bs-target="#updateInvestiment{{ $investiment->id }}" class="btn btn-icon btn-outline-dark waves-effect">
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

                            <form action="{{ route('investiment-update') }}" method="POST" class="modal-content text-center">
                                <div class="modal-onboarding modal fade animate__animated" id="updateInvestiment{{ $investiment->id }}" tabindex="-1" aria-hidden="true">
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
                                                    <input type="hidden" name="investiment_id" value="{{ $investiment->id }}">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-floating form-floating-outline mb-3">
                                                                <input type="text" name="amount" class="form-control money" id="amount" placeholder="Valor:" value="{{ $investiment->amount }}" oninput="maskValue(this)">
                                                                <label for="amount">Valor:</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-floating form-floating-outline mb-3">
                                                                <input type="text" name="profit_percent" class="form-control performance" id="profit_percent" placeholder="Rendimento (%):" value="{{ $investiment->profit_percent }}" oninput="maskPerformance(this)">
                                                                <label for="profit_percent">Rendimento (%):</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                            <div class="form-floating form-floating-outline mb-3">
                                                                <select name="status" class="form-select" id="status" required>
                                                                    <option selected>Opções</option>
                                                                    <option value="1" @selected($investiment->status == 1)>Aprovado</option>
                                                                    <option value="2" @selected($investiment->status == 2)>Pendente</option>
                                                                    <option value="3" @selected($investiment->status == 3)>Cancelado</option>
                                                                </select>
                                                                <label for="status">Status</label>
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