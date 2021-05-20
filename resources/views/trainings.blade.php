@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Available trainings <i class="fas fa-dumbbell"></i></h3></div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($trainings as $training)
                            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                                <div class="card">
                                    @if ($training->thumbnail != null)
                                        <img class="card-img-top" src="/img/trainings/{{ $training->thumbnail }}" alt="Card image cap">
                                    @endif
                                    <div class="card-body">
                                      <h5 class="card-title font-weight-bold">Name: {{ $training->name }} </h5>
                                      <span class="card-text font-weight-bold">Type of training: {{ $training->type }}</span>
                                      <p class="card-text">Description: {{ $training->description }}</p>
                                      @if ($training->recipe()->first() != null)
                                        <p class="card-text">Recepi: {{ $training->recipe()->first()->name }}</p>
                                      @endif
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="{{ $training->getCleanUrl() }}" title="Look in detail" class="btn btn-success w-25 text-black-50"  role="button" aria-pressed="true"><i class="fas fa-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
