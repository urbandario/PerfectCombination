@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <h2>{{ $trainer->name }}</h2>
                            <img src="/img/avatars/{{ $trainer->avatar }}" style="width: 150px; height: 150px; float:left; border-radius:50%; margin-right:25px;" alt="Avatar image">
                        </div>
                        <div class="col-12 col-md-9">
                            {!! $trainer->biography !!}
                            @php
                                $i = 1; 
                                $len = count($trainings);
                            @endphp
                            <div>
                                Available trainings by {{ $trainer->name }}:
                                @foreach ($trainings as $training)
                                    <a href="{{ $training->getCleanUrl() }}" class="text-success">{{ $training->name }}</a>
                                    @php
                                        if($i < $len){echo ',';} $i++;
                                    @endphp
                                @endforeach
                            </div>
                        </div>
                        
                    </div>
                </div>
              </div>
        </div>
    </div>
</div>

@endsection
