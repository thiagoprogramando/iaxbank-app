@extends('app.layout')
@section('content')
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 row">
        <div class="col-12 col-sm-12 offset-md-4 col-md-4 offset-lg-4 col-lg-4">
            <div class="card mt-5 mb-5">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Carteira Digital</h5>
                    <div class="dropdown">
                        <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-1 waves-effect waves-light" type="button" id="mostSales" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-more-2-line ri-20px"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="mostSales">
                            <a class="dropdown-item waves-effect" href="javascript:void(0);">Mês atual</a>
                            <a class="dropdown-item waves-effect" href="javascript:void(0);">Últimos 60 dias</a>
                            <a class="dropdown-item waves-effect" href="javascript:void(0);">Personalizado</a>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-1 pt-0">
                    <div class="mb-6 mt-1">
                        <div class="d-flex align-items-center">
                            <h1 class="mb-0 me-2">R$ {{ number_format($user->wallet, 2, ',', '.') }}</h1>
                        </div>
                        {{-- <a href="{{ route('wallet-investiment', ['uuid' => Auth::user()->uuid]) }}" class="mt-0 text-white">Acessar Carteira de Investimentos</a> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 offset-md-3 col-md-6 offset-lg-3 col-lg-6">
          <div class="table-responsive text-nowrap border-top">
            <table class="table">
              <tbody class="table-border-bottom-0">
                @foreach ($transfers as $transfer)
                  <tr>
                    <td class="ps-0 pe-12 py-4"><span class="text-heading">{{ $transfer->labelType() }}</span></td>
                    <td class="text-end py-4"><span class="text-heading fw-medium">R$ {{ number_format($transfer->value, 2, ',', '.') }}</span></td>
                    <td class="pe-0 py-4">
                      <div class="d-flex align-items-center justify-content-end">
                        <span class="text-heading fw-medium me-2">
                          {{ \Carbon\Carbon::parse($transfer->created_at)->format('d/m/Y') }}
                        </span>
                        @if ($transfer->from_id === Auth::user()->id)
                          <i class="ri-arrow-down-s-line ri-24px text-danger"></i>
                        @else
                          <i class="ri-arrow-up-s-line ri-24px text-success"></i>
                        @endif
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
@endsection