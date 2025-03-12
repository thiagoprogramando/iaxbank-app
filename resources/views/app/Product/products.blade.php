@extends('app.layout')
@section('content')
    
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title mb-1">Produtos</h5>
                    <p class="text-muted mb-0">Cadastrados na base.</p>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th class="text-center">T. Investidores</th>
                            <th class="text-center">T. Investido</th>
                            <th>Status</th>
                            <th class="text-center">Opções</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <p class="lead"><span class="fw-medium">{{ $product->acronym }}</span> - {{ $product->name }}</p>
                                </td>
                                <td class="text-center">
                                    {{ $product->investiments->count() }}
                                </td>
                                <td class="text-center">
                                    R$ {{ number_format($product->investiments->sum('amount'), 2, ',', '.') }}
                                </td>                                
                                <td>
                                    {!! $product->labelStatus() !!}
                                </td>
                                <td class="d-grid gap-2 mx-auto">
                                    <form action="{{ route('product-delete', ['id' => $product->id]) }}" method="POST" class="btn-group delete">
                                        @csrf
                                        <input type="hidden" name="uuid" value="{{ $product->uuid }}">
                                        <a href="{{ route('product-show', ['uuid' => $product->uuid]) }}" class="btn btn-icon btn-outline-dark waves-effect">
                                            <i class="text-warning tf-icons ri-edit-line ri-22px"></i>
                                        </a>
                                        <button type="button" class="btn btn-icon btn-outline-dark waves-effect">
                                            <i class="text-primary tf-icons ri-file-list-line ri-22px"></i>
                                        </button>
                                        <button type="submit" class="btn btn-icon btn-outline-dark waves-effect">
                                            <i class="text-danger tf-icons ri-delete-bin-4-line ri-22px"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection