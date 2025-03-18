@extends('app.layout')
@section('content')
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 row">
        <div class="col-12 col-sm-12 offset-md-3 col-md-6 offset-lg-4 col-lg-4">
            <div class="card mt-5 mb-5">
                <div class="card-header text-center">
                    <h5 class="card-title m-0 me-2">Transferência Digital</h5>
                </div>
                <div class="card-body pb-1 pt-0">
                    @if (empty($to))
                        <form action="{{ route('transfer') }}" method="GET" class="mb-6 mt-1">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="key" class="form-control" placeholder="Chave, CPF, CNPJ ou e-mail" oninput="applyMask(this)">
                                <button type="submit" class="btn btn-success">Avançar</button>
                            </div>
                        </form>
                    @else
                        <div class="table-responsive text-nowrap border-top">
                            <table class="table">
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td class="ps-0 pe-12 py-4" title="{{ $to->name }}"><span class="text-heading">{{ $to->labelName() }}</span></td>
                                        <td class="text-end py-4"><span class="text-heading fw-medium">{{ $to->labelCpfCnpj() }}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form action="{{ route('transfer-send') }}" method="POST" class="mb-6 mt-1 password">
                            @csrf
                            <input type="hidden" name="to" value="{{ $to->uuid }}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="value" placeholder="Valor" oninput="maskValue(this)">
                                <button type="submit" class="btn btn-success">Confirmar</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template/js/password.js') }}"></script>
@endsection