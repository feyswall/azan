
@extends('layouts.my')

@section('links')

@endsection


@section('page-content')

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
        <th>who</th>
        <th>action</th>
        <th> date </th>

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
            <td>{{ $sale->who_buys }}</td>
            <td>

                <form id="delSale-{{$b}}"  method="POST" action="sales/custome/del/{{ $sale->id }}" >
                  <input type="hidden" name="sale" class="form-control" value="{{ $sale->id }}" >
                <button type="submit" class="btn btn-danger btn-sm"><i class=" fas fa-trash-alt"></i></button>
                    <a data-toggle="modal" data-target="#editSellModel-{{ $b }}" num="{{ $sale->id }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                </form>
            </td>
            <td>{{ date('y M d h:ia', strtotime($sale->created_at)) }}</td>
            @php
                $b++;
            @endphp
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
<!-- edit sells -->
@for( $b=0; $b < $sales->count(); $b++ )
            <div class="modal fade" id="editSellModel-{{$b}}" tabindex="-1" role="dialog"
                 aria-labelledby="editSellModalLabel-{{$b}}"
                 aria-hidden="true">
                <div id="model-dialogue" class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addSelltModalLabel">Ready to Leave?</h5>
                            <button id="model-btn-{{$b}}" class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <div id="edit-sell-model-{{$b}}" class="w-100" >
                              <!-- component -->
                              <div class="p-0 w-100">
                                  <form id="editSellForm-{{ $b }}" class="w-100">

                                          <input type="hidden" value="{{ $sales[$b]->id }}" name="sellId">
                                          <input type="hidden" value="{{ $b }}" name="formId">


                                      <div class="form-group">
                                        <label for="product"></label>
                                          <select name="product" class="form-control" required>
                                                 <option selected='selected'> choose product...</option>
                                              @foreach ( \App\Product::where('id', '>', '-2')->get() as $product )
                                              <option  @if ( $sales[$b]->product->id == $product->id )
                                selected
                            @endif value="{{ $product->id }}">{{ $product->product_name }}</option>
                                @endforeach
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <input value="{{ $sales[$b]->total_amount }}" name="total_amount" type="number" class="form-control form-control-user" id="total_amount"
                                              placeholder="total product" required>
                                      </div>
                                      <div class="form-group">
                                          <input value="{{ $sales[$b]->received_amount }}" name="received_amount" type="number" class="form-control form-control-user" id="receive_amount"
                                              placeholder="paid product" required>
                                      </div>

                                      <div class="form-group">
                                          <input value="{{ $sales[$b]->who_buys }}" name="who_buys" type="text" class="form-control form-control-user" id="who_buys"
                                              placeholder="who buys" >
                                      </div>

                                      <button type="submit" class="btn btn-primary btn-user btn-block">
                                          sold
                                      </button>
                                      <hr>
                                  </form>

                                  <form method="POST"  action="{{ route('sales.custome', $sales[$b]->id ) }}" class="w-100">
@csrf
                                    <input type="hidden" value="{{ $sales[$b]->id }}" name="sellId">
                                    <input type="hidden" value="{{ $b }}" name="formId">


                                <div class="form-group">
                                  <label for="product"></label>
                                    <select name="product" class="form-control" required>
                                           <option selected='selected'> choose product...</option>
                                        @foreach ( \App\Product::where('id', '>', '-2')->get() as $product )
                                        <option  @if ( $sales[$b]->product->id == $product->id )
                          selected
                      @endif value="{{ $product->id }}">{{ $product->product_name }}</option>
                          @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input value="{{ $sales[$b]->total_amount }}" name="total_amount" type="number" class="form-control form-control-user" id="total_amount"
                                        placeholder="total product" required>
                                </div>
                                <div class="form-group">
                                    <input value="{{ $sales[$b]->received_amount }}" name="received_amount" type="number" class="form-control form-control-user" id="receive_amount"
                                        placeholder="paid product" required>
                                </div>

                                <div class="form-group">
                                    <input value="{{ $sales[$b]->who_buys }}" name="who_buys" type="text" class="form-control form-control-user" id="who_buys"
                                        placeholder="who buys" >
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    sold
                                </button>
                                <hr>
                            </form>
                              </div>
                          </div>
                              <div class="row justify-content-center">
                                  <div class="col-md-12 col-sm-12">
                                      <div id="edit-sell-loader-{{ $b }}" style="display: none " class="text-center modal-body">
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
 <input type="hidden" value="{{ $sales->count() }}" id="allData">



@endsection

@section('customejs')
<script src="{{ asset('customejs/user/delete-user.js') }}"></script>
<script src="{{ asset('customejs/user/edit-user.js') }}"></script>
<script src="{{ asset('customejs/product/edit-sell.js') }}"></script>
<script src="{{ asset('customejs/product/delete-sell.js') }}"></script>

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

