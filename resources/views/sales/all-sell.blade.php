
@extends('layouts.my')

@section('links')

@endsection


@section('page-content')

<div class="mb-4 shadow card">
    <div class="col-md-12 col-sm-12 offset-md-0 offset-sm-0">
        <div class="card-body">
<table class="table-responsive table table-hover">
    <thead>
        <th>product</th>
        <th>product cost</th>

        <th>amount</th>

        <th>paid</th>
        <th>remain</th>

        <th>paid_cost</th>
        <th>remain_cost</th>
        <th>who</th>
        <th>action</th>
        <th> date </th>



    </thead>
    <tbody>
        @foreach( $sales as $sale )
        <tr>
            <td>{{ $sale->product->product_name }}</td>
            <td>{{ $sale->product->product_cost }}</td>
            <td>{{ $sale->total_amount }}</td>
            <td>{{ $sale->received_amount }}</td>
            <td>{{ $sale->remain_amount }}</td>
            <td>{{ $sale->paid_money }}</td>
            <td>{{ $sale->remain_money }}</td>
            <td>{{ $sale->who_buys }}</td>
            <td>
                <button class="btn btn-primary btn-sm">edit</button>
            </td>
            <td>{{ date('Y M d h:ia', strtotime($sale->created_at)) }}</td>

        </tr>
        @endforeach
    </tbody>
</table>
<div>
    {{  $sales->links() }}
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

