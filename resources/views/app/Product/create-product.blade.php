@extends('app.layout')
@section('content')
    
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title mb-1">Cadastro de Produto</h5>
                    <p class="text-muted mb-0">Preencha todos os dados para cadastrar um novo Produto.</p>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('product-store') }}" method="POST" class="row" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 row">
                        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nome:">
                                <label for="name">Nome:</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="text" name="acronym" class="form-control" id="acronym" placeholder="Sigla:">
                                <label for="acronym">Sigla:</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-floating form-floating-outline mb-6">
                                <textarea name="description" class="form-control" style="min-height: 120px;" id="description" placeholder="Descrição:"></textarea>
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
                                <select name="time" class="form-select" id="time" required>
                                    <option selected>Opções</option>
                                    <option value="day">Diário</option>
                                    <option value="month">Mensal</option>
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
                    <div class="col-12 col-sm-12 offset-md-8 col-md-4 offset-lg-8 col-lg-4">
                        <div class="d-grid gap-2 mx-auto">
                            <button type="submit" class="btn btn-outline-success">CRIAR E AVANÇAR</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection