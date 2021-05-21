@component('mail::message')
<div><img style="display:block; margin:auto; width: 120px" src="{{ asset('img/logo.png') }}" alt="Logo" class="logo"/></div><br>
<p class="text-center row"><strong>Contact form</strong></p><br><br>

You have got an email from : {{ $contact->name }} <br><br>

User details: <br><br>

Name: {{ $contact->name }} <br>
Email: {{ $contact->email }} <br>
Phone: {{ $contact->phone }} <br>
Subject: {{ $contact->subject }} <br>
Message: {{ $contact->message }} <br><br>

Regards,<br>
{{ config('app.name') }}.
@endcomponent
