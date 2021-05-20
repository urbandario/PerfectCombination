@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <img src="/img/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; float:left; border-radius:50%; margin-right:25px;" alt="Avatar image">
                        </div>
                        <div class="col-12 col-md-4">
                            <h2>{{ $user->name }}'s Profile</h2>

                        </div>
                        <div class="col-12 col-md-4">
                            <h2>Change profile image</h2>
                            <form enctype="multipart/form-data" action="{{ route('update_avatar') }}" method="POST">
                                @csrf
                                <input type="file" name="avatar"><br><br>
                                <input type="submit" class="pull-right btn btn-sm btn-success" value="Change">
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <hr class="w-100">
                        <div class="col-12">
                            <h2>Change biography</h2>

                            <form action="{{ route('update_biography') }}" method="POST">
                                @csrf
                                <textarea name="biography" id="biography">
                                    {!! $user->biography !!}
                                </textarea><br>
                                <input type="submit" class="pull-right btn btn-sm btn-success" value="Change">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                  Profile created-{{ $user->created_at->diffForHumans() }}
                </div>
              </div>
        </div>
    </div>
</div>
<script>
    ClassicEditor
        .create( document.querySelector( '#biography' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
