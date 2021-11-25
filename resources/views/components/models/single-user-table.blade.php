<div>

<!-- model section -->
      @for( $b=0; $b < 1; $b++ )
            <div class="modal fade" id="editUserModel-{{$b}}" tabindex="-1" role="dialog"
                 aria-labelledby="editUserModalLabel-{{$b}}"
                 aria-hidden="true">
                <div id="model-dialogue" class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel">Ready to Leave?</h5>
                            <button id="model-user-btn-{{$b}}" class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <div id="edit-user-model-{{$b}}" class="w-100" >
                              <!-- component -->
                              <div class="p-0 w-100">
                                  <form id="editUserForm-{{ $b }}" class="w-100">
                                       @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                    <div class="col-md-12">
                        <input value="{{ $user->name }}" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                    <div class="col-md-12">
                        <input value="{{ $user->email }}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('role') }}</label>
                    <div class="col-md-12">
                          <select id="role" name="role[]" required class="custom-select form-control @error('role') is-invalid @enderror" multiple>
                            @foreach ( \App\Role::all() as $role )
                            <option @if ( $user->roles->pluck('id')->contains($role->id) )
                                selected
                            @endif value="{{ $role->id }}">{{ $role->name }}</option>
                             @endforeach
                          </select>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                    <div class="col-md-12">
                        <input placeholder='leave default' id="password" type="password" class="form-control" name="password" >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                    <div class="col-md-12">
                        <input placeholder='leave default' id="password-confirmation" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                    </div>
                </div>

                <div class="mb-0 form-group row">
                    <div class="col-md-12 offset-md-4">
                        <button id="regBtn" type="submit" class="btn btn-primary">
                            {{ __('update') }}
                        </button>
                    </div>
                </div>
                <input type="hidden" value="{{ $user->id }}" name="userId">
                <input type="hidden" value="{{ $b }}" name="userFormId">
                                  </form>
                              </div>
                          </div>
                              <div class="row justify-content-center">
                                  <div class="col-md-12 col-sm-12">
                                      <div id="edit-user-loader-{{ $b }}" style="display: none " class="text-center modal-body">
                                          <div class="loader1">
                                              <span></span>
                                              <span></span>
                                              <span></span>
                                              <span></span>
                                              <span></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endfor

    <!-- element counter very important -->
    <input type="hidden" value="1" id="allUsers">
</div>