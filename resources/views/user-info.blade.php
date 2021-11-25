
@extends('layouts.my')

@section('links')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection


@section('page-content')
<div class="mb-4 shadow card">
    <div class="py-3 mb-4 card border-left-primary">
        <div class="card-body">
            <h1 class="display-4">{{ $user->name }}</h1 class="display-4">
            <div class="row justify-content-start">
                <div class="col-sm-12 col-md-7">
                    <table class="table table-sm">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">full name</th>
                            <th scope="col">Access As</th>
                            <th scope="col"></th>
                            <th scope="col">Reg: Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>{{ $user->name }}</td>
                
                            <td>
                                @foreach ( $user->roles->pluck('name') as $role )
                                <li> {{ $role  }} </li>
                            @endforeach
                            <td>{{ $user->name}}</td>
                            </td>
                            <td>{{ $user->created_at }}</td>
                          </tr>
                
                          <td colspan="2">
                            <a class="btn btn-outline-primary btn-block btn-sm" data-toggle="modal" data-target="#editUserModel-0">Edit</a>
                          </td>
                        </tbody>
                      </table>
                <!-- model for edit user model in the table above -->                
                    <x-models.single-user-table :user="$user"></x-models.single-user-table>
                </div>
                
           </div>
        </div>
    </div>
</div>



@endsection

@section('models')


@endsection


@section('customejs')
<script src="{{ asset('customejs/user/delete-user.js') }}"></script>
<script src="{{ asset('customejs/user/edit-user.js') }}"></script>

@endsection

