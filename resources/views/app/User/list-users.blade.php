@extends('app.layout')
@section('content')
    
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title mb-1">Usuários</h5>
                    <p class="text-muted mb-0">Cadastrados na base.</p>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Detalhes</th>
                            <th>Patrocinador</th>
                            <th class="text-center">T. Investido</th>
                            <th class="text-center">Carteira</th>
                            <th class="text-center">Opções</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <i class="ri-user-line ri-22px me-4"></i><span class="fw-medium">{{ $user->name }}</span> <br>
                                    <span>{{ $user->email }} | {{ $user->cpfcnpj }}</span>
                                </td>
                                <td>
                                    <i class="ri-user-2-line ri-22px me-4"></i><span class="fw-medium">{{ $user->sponsor->name ?? 'N/A' }}</span> <br>
                                    <span>{{ $user->sponsor->email ?? 'N/A' }} | {{ $user->sponsor->cpfcnpj ?? 'N/A' }}</span>
                                </td>
                                <td class="text-center">
                                    R$ ---
                                </td>  
                                <td class="text-center">
                                    R$ {{ number_format($user->wallet, 2, ',', '.') }}
                                </td>                                
                                <td class="d-grid gap-2 mx-auto">
                                    <form action="{{ route('user-delete', ['uuid' => $user->uuid]) }}" method="POST" class="btn-group delete">
                                        @csrf
                                        <input type="hidden" name="confirm" value="on">
                                        <input type="hidden" name="uuid" value="{{ $user->uuid }}">
                                        <a href="{{ route('user-show', ['uuid' => $user->uuid]) }}" target="_blank" class="btn btn-icon btn-outline-dark waves-effect">
                                            <i class="text-warning tf-icons ri-edit-line ri-22px"></i>
                                        </a>
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