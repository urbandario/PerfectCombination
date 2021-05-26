@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Favorited trainings <i class="fas fa-heart"></i></h3></div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($favorites as $training)
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
                                        <i class="{{ auth()->check()?auth()->user()->favoriteTrainings->contains($training->id)?'fas':'far':'far' }} fa-heart fa-lg pointer-cursor mr-2 text-secondary animated" id="updateFavorites"onclick="updateFavorite('{{ $training->id }}')"
                                            @if(auth()->user())
                                                @if(auth()->user()->favoriteTrainings->contains($training->id))
                                                    title="Remove from favorites"
                                                @else
                                                    title="Add to favorites"
                                                @endif
                                            @else
                                                title="Need to be looged"
                                            @endif
                                                id="favorite_{{ $training->id }}" style="animation-duration: 0.2s;"></i>
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
<script>
    loggedIn = '{{ auth()->check()?"true":"false" }}';

    function updateFavorite(id) {
        if (loggedIn === 'true'){
            var icon = document.getElementById('updateFavorites');
            $.ajax({
                url: "{{ route('update_favorite')}}",
                type: "POST",
                data: {"_token": "{{ csrf_token() }}", 'id': id},
                success: function (data) {
                    if (data == 400){
                        window.location.href = "/login";
                    }
                    let appIcon = document.getElementById('updateFavorites');

                    appIcon.classList.toggle('far');
                    appIcon.classList.toggle('fas');
                    appIcon.classList.add('pulse');
                    window.setTimeout( function(){
                        appIcon.classList.remove('pulse');
                    }, 500);

                    swal({
                        title: "Success", 
                        text: "Updated favorites!", 
                        type: "success",
                        showCancelButton: false,
                        showConfirmButton: false
                    });

                    if(!data['added']){
                        appIcon.title = "Add to favorite";
                    }
                },
                error: function (data) {
                    handleError(data);
                }
            })
        }
        else {
            window.location.href = "{{ route('login') }}";
        }
    }
</script>
@endsection
