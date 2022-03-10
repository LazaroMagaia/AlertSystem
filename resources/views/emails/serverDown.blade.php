@component('mail::message')
# O servidor caiu

Ola {{$user->name}} vimos que o seu site esta offline, por favor verifique a situacao

site: <h2>{{$servidor->url_name}}</h2>
Obrigado,<br>
{{ config('app.name') }}
@endcomponent
