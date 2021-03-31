
@extends('layouts.my')

@section('links')

@endsection


@section('page-content')
 <div class="mb-4 shadow card border-left-primary">
<div class="col-md-9 col-sm-12 offset-md-0 offset-sm-0">
    <div class="card-body">
        <div class="card-body">
            <h3>Current Stock Status</h3>
            <table id="stock-table" class="display" style="width:100%">
                <thead>
                <tr>
                    <td>#</td>
                    <th>product</th>
                    <th>Amount</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                   @for( $b=0; $b < $stocks->count(); $b++ )
             <tr>
         
                <td>{{ $stocks[$b]->id }} </td>
                <td>{{ $stocks[$b]->product->product_name }}</td>
                <td>{{ $stocks[$b]->amount }}</td>
                   <td>
            <a class="btn btn-primary btn-sm">Edit</a>
            <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
            </tr>
                    @endfor
                </tbody>
                <tfoot>

                </tfoot>
            </table>

        </div>
    </div>


          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#stockTableList" aria-expanded="false" aria-controls="stockTableList">
   Stock entrence history
  </button>
</p>
<div class="collapse" id="stockTableList">
                    <div class="mt-4 ml-2">
         <h3>Stock Entrence History</h3>               
                      <table id="stock-hist-table" class="display" style="width:100%">
                <thead>
                <tr>
                    <td>#</td>
                    <th>product</th>
                    <th>Amount</th>
                    <th>User</th>
                    <th>created_at</th>
                    
                </tr>
                </thead>
                <tbody>
                   @for( $b=0; $b < $stockHist->count(); $b++ )
             <tr>
         
                <td>{{ $stockHist[$b]->id }} </td>
                <td>
                    @php 
                $product = App\product::find( $stockHist[$b]->product_id );
                        echo $product->product_name;
                         @endphp
                     </td>
                <td>{{ $stockHist[$b]->amount }}</td>
                                <td>
                    @php
  $user = App\user::find( $stockHist[$b]->user_id );
                        echo $user->name;
                  @endphp
                </td>
                <td>{{ $stockHist[$b]->created_at }}</td>
            </tr>
                    @endfor
                </tbody>
                <tfoot>

                </tfoot>
            </table>
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
        var allStock = function (){
            $('#stock-table').DataTable({
                responsive: true,
                autoWidth: true
            });

              $('#stock-hist-table').DataTable({
                responsive: true,
                autoWidth: true
            });
        }
        allStock();
});
         </script>

@endsection

