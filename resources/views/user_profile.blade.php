
@extends('layouts.my')

@section('links')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection


@section('page-content')
 @if( session()->has('error') )
<div class="alert alert-danger">
    <p><b>{{ session()->get('error') }}</b></p>
</div>
@endif
 @if( session()->has('success') )
<div class="alert alert-success">
    <p><b>{{ session()->get('success') }}</b></p>
</div>
@endif
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
                        </tbody>
                      </table>
                </div>
                <div class="col-md-4">
                  <ul class="list-group list-group-flush">
  <li class="list-group-item"> <a href="#" data-toggle="modal" data-target="#changePass">change password</a></li>
    <li class="list-group-item">A second item</li>
  <li class="list-group-item">A third item</li>
</ul>
                </div>
           </div>
        </div>
    </div>
</div>
@endsection


<!-- change password model-->
@section('models')
<!-- Modal -->
<div class="modal fade" id="changePass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body p-5">
         <form method="POST" action="{{ route('user.change.password') }}">
           @csrf
         <h3>Password Change Form</h3>            
    <div class="col-sm-12">
          <label for="current-password" class="col-sm-4 control-label">Current Password</label>
      <div class="form-group">
        <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current-password" name="current_password" placeholder="Password">
         @error('current_password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
      </div>
    </div>
    <div class="col-sm-12">
          <label for="password" class="col-sm-4 control-label">New Password</label>
      <div class="form-group">
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
         @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
    </div>
   
    <div class="col-sm-12">
       <label for="password_confirmation" class="col-sm-4 control-label">Re-enter Password</label>
      <div class="form-group">
        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password">
         @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
      </div>
    </div>

  <div class="form-group">
    <div class=" col-sm-12">
      <button type="submit" class="btn btn-info">Submit</button>
    </div>
  </div>

         </form>
      </div>
    </div>
  </div>
</div>
@endsection


@section('customejs')
<script src="{{ asset('customejs/user/delete-user.js') }}"></script>
<script src="{{ asset('customejs/user/edit-user.js') }}"></script>

@endsection

