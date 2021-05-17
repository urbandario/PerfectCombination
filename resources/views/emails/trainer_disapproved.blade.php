@component('mail::message')
<div><img style="display:block; margin:auto; width: 120px" src="{{ asset('img/logo.png') }}" alt="Logo" class="logo"/></div><br>
<p class="text-center row"><strong>Validation Disapproved!</strong></p><br><br>

<p>Hello! We validated your data and we are sorry to say that we had to decline your request for a name: <strong>{{$user->name}}</strong></p>

Regards,<br>
{{ config('app.name') }}.
@endcomponent
