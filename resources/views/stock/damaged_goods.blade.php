
@extends('layouts.my')

@section('links')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection


@section('page-content')
<div class="mb-4 shadow card">
    <div class="py-3 mb-4 card border-left-primary">
        <div class="card-body">
            <h1 class="display-4"></h1 class="display-4">
            <div class="row justify-content-start">
                <div class="col-sm-12 col-md-7">
                    @if ( session()->has('damaged') )
                        <div class="p-3 alert-success">
                            <p><i class="far fa-check-circle"></i>{{ session()->get('damaged') }}</p>
                        </div>
                    @endif
                     @if ( session()->has('damagedError') )
                        <div class="p-3 alert-danger">
                            <p><i class="far fa-times-circle"></i> {{ session()->get('damagedError') }}</p>
                        </div>
                    @endif
<h2>Add Damaged Goods Form</h2>
 <fieldset>
    <form method="POST" action="{{ route('damaged.store') }}" class="w-100">
        @csrf
<div class="form-group row">
<label for="product_id" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
<div class="col-md-12">
<select name="product_id"  id="product_id" class="form-control @error('product_id') is-invalid @enderror" required >
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
<label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('amount') }}</label>
<div class="col-md-12">
<input name="amount" value="" id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" amount="amount" value="{{ old('amount') }}" required autocomplete="amount" autofocus>
@error('amount')
<span class="invalid-feedback" role="alert">
 <strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>



<div class="mb-0 form-group row">
<div class="col-md-12 offset-md-4">
<button id="regBtn" type="submit" class="btn btn-primary">
{{ __('update') }}
</button>
</div>
</div>
</form>
 </fieldset>
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

