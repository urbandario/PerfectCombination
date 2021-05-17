@component('mail::message')
<div><img style="display:block; margin:auto; width: 120px" src="{{ asset('img/logo.png') }}" alt="Logo" class="logo"/></div><br>
<p class="text-center row"><strong>Validation Approved!</strong></p><br><br>

<p>Hello! We validated your data and approved your request for a name: <strong>{{$user->name}}</strong></p>

Regards,<br>
{{ config('app.name') }}.
@endcomponent
