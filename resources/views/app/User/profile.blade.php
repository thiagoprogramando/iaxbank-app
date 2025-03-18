@extends('app.layout')
@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-6">
          <div class="card-body">
            <form id="avatarForm" action="{{ route('user-update', ['uuid' => $user->uuid]) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="text-center">
                <img src="{{ Auth::user()->photo ? Storage::url(Auth::user()->photo) : asset('template/img/avatars/1.png') }}"
                      alt="Perfil de {{ Auth::user()->name }}"
                      class="d-block w-px-100 h-px-100 rounded-4"
                      id="uploadedAvatar"
                      style="cursor: pointer;"/>
                  <input type="file" id="avatarInput" name="photo" accept="image/*" class="d-none">
              </div>
            </form>
          </div>

          <div class="card-body pt-0 row">
            <form id="formAccountSettings"action="{{ route('user-update', ['uuid' => $user->uuid]) }}" method="POST" class="col-12 col-sm-12 col-md-6 col-lg-6 row g-3">
              @csrf
              <div class="col-md-12">
                <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}"/>
                    <label for="name">Nome</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                  <input class="form-control phone" type="text" name="phone" id="phone" value="{{ $user->phone }}" oninput="maskPhone(this)"/>
                  <label for="phone">Telefone</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="email" name="email" id="email" value="{{ $user->email }}"/>
                  <label for="email">E-mail</label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-floating form-floating-outline">
                  <input class="form-control cpfcnpj" type="text" name="cpfcnpj" id="cpfcnpj" value="{{ $user->cpfcnpj }}" oninput="maskCpfCnpj(this)"/>
                  <label for="cpfcnpj">CPF/CNPJ</label>
                </div>
              </div>
              @if (Auth::user()->type === 1)
                <div class="col-md-12">
                  <div class="form-floating form-floating-outline">
                    <select id="type" class="form-select">
                      <option value="1" @selected($user->type == 1)>Administrador</option>
                      <option value="2" @selected($user->type == 2)>Usuário</option>
                      <option value="3" @selected($user->type == 3)>Colaborador</option>
                    </select>
                    <label for="type">Permissões</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control money" type="text" name="wallet" id="wallet" value="{{ $user->wallet }}" oninput="maskValue(this)"/>
                    <label for="wallet">Carteira</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control money" type="text" name="wallet_accumulated" id="wallet_accumulated" value="{{ $user->wallet_accumulated }}" oninput="maskValue(this)"/>
                    <label for="wallet_accumulated">Carteira Acumulada</label>
                  </div>
                </div>
              @endif
              <div class="mt-12 text-center">
                <button type="submit" class="btn btn-primary me-3">Salvar</button>
              </div>
            </form>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 row g-3">
              <div class="card">
                <h5 class="card-header mb-1">Excluir conta</h5>
                <div class="card-body">
                  <div class="mb-6 col-12 mb-0">
                    <div class="alert alert-warning">
                      <h6 class="alert-heading mb-1">Tem certeza de que deseja excluir sua conta?</h6>
                      <p class="mb-0">Depois de excluir sua conta, não há como recuperar os dados.</p>
                    </div>
                  </div>
                  <form id="formAccountDeactivation" action="{{ route('user-delete', ['uuid' => $user->uuid]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="uuid" value="{{ $user->uuid }}">
                    <div class="form-check mb-6">
                      <input class="form-check-input" type="checkbox" name="confirm" id="confirm"/>
                      <label class="form-check-label" for="confirm">Confirmo a desativação da conta</label>
                    </div>
                    <button type="submit" class="btn btn-danger deactivate-account"> Confirmar </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('uploadedAvatar').addEventListener('click', function () {
        document.getElementById('avatarInput').click();
    });

    document.getElementById('avatarInput').addEventListener('change', function () {
        if (this.files.length > 0) {
            document.getElementById('avatarForm').submit();
        }
    });
  </script>
@endsection