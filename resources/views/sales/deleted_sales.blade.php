
@extends('layouts.my')

@section('links')

@endsection


@section('page-content')
     @if( session()->has('error') )
<div class="alert alert-danger">
    <p><b>{{ session()->get('error') }}</b></p>
</div>
     @endif
<div class="mb-4 shadow card">
    <div class="col-md-12 col-sm-12 offset-md-0 offset-sm-0">
        <div class="card-body">
<table class="table table-responsive table-hover">
    <thead>
        <th>product</th>
        <th>product cost</th>

        <th>amount</th>

        <th>paid</th>
        <th>remain</th>

        <th>paid_cost</th>
        <th>remain_cost</th>
        <th>who_del</th>
        <th> deleted_at </th>

    </thead>
    <tbody>
        @php
        $b = 0;
    @endphp
        @foreach( $sales as $sale )
        <tr>
            <td>{{ $sale->product->product_name }}</td>
            <td>{{ $sale->product->product_cost }}</td>
            <td>{{ $sale->total_amount }}</td>
            <td>{{ $sale->received_amount }}</td>
            <td>{{ $sale->remain_amount }}</td>
            <td>{{ $sale->paid_money }}</td>
            <td>{{ $sale->remain_money }}</td>
            <td>{{ $sale->user->name }}</td>
            <td>{{ date('y M d h:ia', strtotime($sale->deleted_at)) }}</td>
            @php
                $b++;
            @endphp
        </tr>
        @endforeach
    </tbody>
</table>
<buton data-toggle="modal" data-target="#tempSellModel" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
<div>
    {{  $sales->links() }}
</div>
        </div>
    </div>
</div>
@endsection

@section('models')
<x-models.temp-delete-sell></x-models.temp-delete-sell>
@endsection

@section('customejs')
    <script src="{{ asset('customejs/user/delete-user.js') }}"></script>
    <script src="{{ asset('customejs/user/edit-user.js') }}"></script>
    <script src="{{ asset('customejs/product/edit-sell.js') }}"></script>
    <script src="{{ asset('customejs/product/delete-sell.js') }}"></script>
    <script src="{{ asset('customejs/product/temp-delete-sell.js') }}"></script>

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

