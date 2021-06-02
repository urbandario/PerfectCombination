@extends('layouts.admin')

@section('pageTitle','Check trainers')

@section('content')
    <style>
        th {
            cursor: pointer;
        }
        .vl {
          border-left: 1px solid #dee2e6;
          height: 337px;
          position: absolute;
          left: 50%;
          margin-left: -3px;
          top: 0;
        }
    </style>
    <div class="container" style="max-width: max-content; text-align: center">
        <div class="row justify-content-center">
            <div class="table-responsive" id="check-trainers-table">
                <table class="table table-striped" id="check-trainers-table-element">
                    <thead class="text-left" style="color: white;background: #a0a0a0">
                        <tr>
                            <th scope="col" onclick="sortTable(0)"># <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(1)">Name <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(2)">Email <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(3)">Verified <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(4)">Trainer <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(5)">Trainer approved <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(6)">Admin <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(7)">Biography <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(8)">Phone <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(9)">Avatar <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(10)">Created at <i class="fa fa-sort-down"></i></th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-left">
                        <div class="clearfix"></div>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->email_verified_at?$user->email_verified_at:"--" }}</td>
                                <td class="text-center">
                                    @if($user->trainer) <i class="fa fa-check" title="Trainer" style="font-size: 25px; color:lawngreen" aria-hidden="true"></i>
                                    @else <i class="fa fa-times" title="User/Admin" style="font-size: 25px; color:red" aria-hidden="true"></i> 
                                    @endif 
                                </td>
                                <td class="text-center">
                                    @if($user->trainer_approved) <i class="fa fa-check" title="Approved Trainer" style="font-size: 25px; color:lawngreen" aria-hidden="true"></i>
                                    @else <i class="fa fa-times" title="Disapproved Trainer" style="font-size: 25px; color:red" aria-hidden="true"></i> 
                                    @endif 
                                </td>
                                <td class="text-center">
                                    @if($user->admin) <i class="fa fa-check" title="Admin" style="font-size: 25px; color:lawngreen" aria-hidden="true"></i>
                                    @else <i class="fa fa-times" title="User/Trainer" style="font-size: 25px; color:red" aria-hidden="true"></i> 
                                    @endif 
                                </td>
                                <td style="width: 300px">{!! $user->biography !!}</td>
                                <td>{{ $user->phone }}</td>
                                <td><img src="/img/avatars/{{ $user->avatar }}" style="width: 50px; height: 50px; float:left; border-radius:50%; margin-right:25px;" alt="Avatar image"></td>
                                <td>{{ $user->created_at }}</td>
                                <td class="text-center">                                    
                                    <button type="button" title="Delete user" class="btn btn-sm btn-danger text-black-50" style="width: 30.6px;height: 28.9px" onclick="deleteUser({{ $user->id }})"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                @include('partials.js.admin')
            </div>
        </div>
    </div>
    @if ($errors->any())
        <script>
            Toast.fire({
                icon: 'error',
                title: '{{ $errors->first() }}'
            });
        </script>
    @endif
@stop
