<h2>Olá, {{ $data['toName'] }}</h2>
<p>Recebemos sua solicitação de redefinição de senha!</p>
<small>Para redefinir sua senha acesse o link abaixo:</small>
<a href="{{ env('APP_URL') }}/forgout/{{ $data['message'] }}">Redefinir minha senha!</a>