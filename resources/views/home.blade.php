@extends('layouts.my')

@section('page-content')
           <!-- Page Heading -->
                    <h3><b>Dashboard</b></h3>

                    <!-- cards of dashboard -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="mb-4 col-xl-3 col-md-6">
                            <div class="py-2 shadow card border-left-primary h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="mr-2 col">
                                            <div class="mb-1 text-xs font-weight-bold text-primary text-uppercase">
                                                Yeasterday Total</div>
                                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $yesterday_total_sales }}/= Tsh</div>
                                            <p><small><b>{{  $yesterday_total_products }}</b> units</small></p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="text-gray-300 fas fa-calendar fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Annual) Card Example -->
                        <div class="mb-4 col-xl-3 col-md-6">
                            <div class="py-2 shadow card border-left-success h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="mr-2 col">
                                            <div class="mb-1 text-xs font-weight-bold text-success text-uppercase">
                                                Yesterday Paid</div>
                                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $yesterday_paid_sales }}/= Tsh</div>
                                             <p><small><b>{{  $yesterday_paid_products }}</b> units</small></p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="text-gray-300 fas fa-dollar-sign fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="mb-4 col-xl-3 col-md-6">
                            <div class="py-2 shadow card border-left-warning h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="mr-2 col">
                                            <div class="mb-1 text-xs font-weight-bold text-warning text-uppercase">
                                                Yesterday Debts</div>
                                            <div class="mb-0 text-gray-800 h5 font-weight-bold">
                                            {{ $yesterday_remain_sales }}/= Tsh</div>
                                             <p><small><b>{{  $yesterday_remain_products }}</b> units</small></p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="text-gray-300 fas fa-comments fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="mb-4 col-xl-3 col-md-6">
                            <div class="py-2 shadow card border-left-warning h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="mr-2 col">
        <div class="mb-1 text-xs font-weight-bold text-warning text-uppercase">Product  ( Paid/Total )</div>
                                            <div class="mb-0 text-gray-800 h5 font-weight-bold">
                                             <div class="progress md-progress" style="height: 20px">
  {{--<div class="progress-bar" role="progressbar" style="width: {{ round( ($yesterday_paid_products/ $yesterday_total_products ) * 100) }}%; height: 20px" aria-valuenow="{{ round( ($yesterday_paid_products/ $yesterday_total_products+1 ) * 100) }}" aria-valuemin="0" aria-valuemax="100">{{--}}
        {{--round( ($yesterday_paid_products/ $yesterday_total_products+1 ) * 100) }}%</div>--}}
{{--</div>--}}
                                        </div>
                
                                    </div>
                                </div>
                            </div>
                        </div>





                    </div>
                <!-- /.container-fluid -->
@endsection