
@extends('layouts.my')

@section('links')

@endsection


@section('page-content')
<div class="mb-4 shadow card">
    <div class="row justify-content-start">
        <div class="col-md-8 col-sm-12">
            <div class="card-body">
                <div class="card-body">
                    @if( session()->has('stockCreate'))
                    <div class="p-2 alert alert-success">
                       <p><i class="far fa-check-circle"></i> {{ session()->get('stockCreate') }}</p>
                    </div>
                    @endif
                    <div>
                        <h3>Add Product To Stock</h3>
                    </div>
                   <form method="POST" action="{{ route('stock.store') }}">
                        @csrf
                        <div class="form-group row">

                            <div class="col-md-12">
                                     <label for="product_id" class="col-md-4 col-form-label text-md-right">{{ __('product name') }}</label>
                                <select id="product_id" class="form-control @error('product_id') is-invalid @enderror" name="product_id" required >
                                    @foreach( App\Product::all() as $product )
                                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>

                                @error('product_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Product Amount') }}</label>
                                <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}"  autocomplete="amount">

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-0 form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
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

<script>
    var allDataCountDelete = $('#allData').val();
</script>

     <script>
    $(document).ready(function() {
        var manageUsersTable = function (){
            $('#users-table').DataTable({
                responsive: true,
                autoWidth: true
            });
        }
        manageUsersTable();
});
         </script>


@endsection

