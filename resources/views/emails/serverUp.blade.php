@component('mail::message')
# O servidor Voltou ao ar

Ola {{$user->name}}, parabens o seu site voltou a ficar online

site: <h2>{{$servidor->url_name}}</h2>
Obrigado,<br>
{{ config('app.name') }}
@endcomponent
