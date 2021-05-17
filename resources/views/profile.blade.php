@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <div class="card-body">
                    <img src="/img/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; float:left; border-radius:50%; margin-right:25px;" alt="Avatar image">
                    <h2>{{ $user->name }}'s Profile</h2>
                    <hr>
                    <div class="row">

                        <h2>Change profile image</h2>
                        <div class="col-12">
                            <form enctype="multipart/form-data" action="{{ route('update_avatar') }}" method="POST">
                                @csrf
                                <input type="file" name="avatar"><br><br>
                                <input type="submit" class="pull-right btn btn-sm btn-success" value="Change">
                            </form>
                        </div>
                        <hr class="w-100">

                        <h2>Change biography</h2>
                        <div class="col-12">
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
@endsection
