@extends('layouts.app')
@section('styles')
<style>
    .container-contact {
    max-width: 500px;
    margin: 50px auto;
    text-align: left;
    font-family: sans-serif;
}

form {
    border: 1px solid black;
    background: lightgreen;
    padding: 40px 50px 45px;
}

.form-control:focus {
    border-color: #000;
    box-shadow: none;
}

label {
    font-weight: 600;
}

.error {
    color: red;
    font-weight: 400;
    display: block;
    padding: 6px 0;
    font-size: 14px;
}

.form-control.error {
    border-color: red;
    padding: .375rem .75rem;
}
</style>
@endsection
@section('content')
<div class="container-contact mt-5">

    <form method="post" action="{{ route('contact.store') }}">
        <h3 class="text-center font-weight-bold">Contact form</h3>
        @csrf
    
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'error' : '' }}" value="{{ old('name') }}" name="name" id="name">
    
            <!-- Error -->
            @if ($errors->has('name'))
            <div class="error">
                {{ $errors->first('name') }}
            </div>
            @endif
        </div>
    
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}" value="{{ old('email') }}" name="email" id="email">
    
            @if ($errors->has('email'))
            <div class="error">
                {{ $errors->first('email') }}
            </div>
            @endif
        </div>
    
        <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control {{ $errors->has('phone') ? 'error' : '' }}" value="{{ old('phone') }}" name="phone" id="phone">
    
            @if ($errors->has('phone'))
            <div class="error">
                {{ $errors->first('phone') }}
            </div>
            @endif
        </div>
    
        <div class="form-group">
            <label>Subject</label>
            <input type="text" class="form-control {{ $errors->has('subject') ? 'error' : '' }}" value="{{ old('subject') }}" name="subject"
                id="subject">
    
            @if ($errors->has('subject'))
            <div class="error">
                {{ $errors->first('subject') }}
            </div>
            @endif
        </div>
    
        <div class="form-group">
            <label>Message</label>
            <textarea class="form-control {{ $errors->has('message') ? 'error' : '' }}" name="message" id="message"
                rows="4">{{ old('message') }}</textarea>
    
            @if ($errors->has('message'))
            <div class="error">
                {{ $errors->first('message') }}
            </div>
            @endif
        </div>
    
        <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
    </form>
</div>
@endsection
