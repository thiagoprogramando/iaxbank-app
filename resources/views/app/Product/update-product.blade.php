@extends('app.layout')
@section('content')
    
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title mb-1">{{ $product->name }}</h5>
                    <p class="text-muted mb-0">Mantenha os dados do Produto atualizados.</p>
                </div>
            </div>
            <div class="card-body">

                <div class="nav-align-top">
                    <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-2 gap-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active waves-effect waves-light" href="javascript:void(0);"><i class="ri-file-list-line me-2"></i>Dados</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="{{ route('packages', ['product' => $product->uuid]) }}"><i class="ri-wallet-3-line me-2"></i>Pacotes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="{{ route('investiments', ['product' => $product->uuid]) }}"><i class="ri-line-chart-line me-2"></i>Investimentos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="{{ route('incomes', ['product' => $product->uuid]) }}"><i class="ri-pie-chart-2-line me-2"></i>Rendimentos</a>
                        </li>
                    </ul>
                </div>

                <form action="{{ route('product-update', ['id' => $product->id]) }}" method="POST" class="row" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 row">
                        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nome:" value="{{ $product->name }}">
                                <label for="name">Nome:</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="text" name="acronym" class="form-control" id="acronym" placeholder="Sigla:" value="{{ $product->acronym }}">
                                <label for="acronym">Sigla:</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-floating form-floating-outline mb-3">
                                <textarea name="description" class="form-control" style="min-height: 120px;" id="description" placeholder="Descrição:">{{ $product->description }}</textarea>
                                <label for="description">Descrição:</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="input-group mb-3">
                                <input type="file" name="photo" class="form-control" id="photo">
                                <label class="input-group-text" for="photo">Ícone</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="text" name="value" class="form-control money" id="value" placeholder="Valor:" value="{{ $product->value }}" oninput="maskValue(this)">
                                <label for="value">Valor:</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="text" name="performance" class="form-control performance" id="performance" placeholder="Rendimento (%):" value="{{ $product->performance }}" oninput="maskPerformance(this)">
                                <label for="performance">Rendimento (%):</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-floating form-floating-outline mb-3">
                                <select name="time" class="form-select" id="time" required>
                                    <option selected>Opções</option>
                                    <option value="day" @selected($product->time == 'day')>Diário</option>
                                    <option value="month" @selected($product->time == 'month')>Mensal</option>
                                    <option value="year" @selected($product->time == 'year')>Anual</option>
                                </select>
                                <label for="time">Modelo</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-floating form-floating-outline mb-3">
                                <select name="status" class="form-select" id="status" required>
                                    <option selected>Opções</option>
                                    <option value="1" @selected($product->status == 1)>Ativo</option>
                                    <option value="2" @selected($product->status == 2)>Inativo</option>
                                </select>
                                <label for="status">Status</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 offset-md-8 col-md-4 offset-lg-8 col-lg-4">
                        <div class="d-grid gap-2 mx-auto">
                            <button type="submit" class="btn btn-outline-success">SALVAR</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection