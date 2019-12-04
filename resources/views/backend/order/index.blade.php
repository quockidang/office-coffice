@extends('layouts.admin')
@section('content')
<?php

    $error = Session::get('error');
    if($error){
        echo '<input class="error" type="text" hidden value="'.$error.'"/>';
        Session::put('error', null);
    }

    $success = Session::get('success');
    if($success){
        echo '<input class="success" type="text" hidden value="'.$success.'"/>';
        Session::put('success', null);
    }
?>
<div class="row">
  <div class="col-lg-12">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
              <li class="breadcrumb-item active font-weight-bold" aria-current="page">Orders</li>
          </ol>
      </nav>
  </div>
</div>

<div class="row">
@foreach ($orders as $item)
<?php
    $customer = App\User::find($item->customer_id);
?>
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{'Bàn: ' . $item->table}}</div>
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{'Khách: ' . $customer->name}}</div>
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{'SĐT: ' . $customer->phone}}</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($item->total_price) . '  VNĐ'}} </div>

          </div>
          <div class="col-auto">
          <a href="{{route('order.details', ['id' => $item->id])}}"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endforeach
</div>

@endsection()
@section('script')

<script>
    $(function(){
        var success = $('.success').val();
        var error = $('.error').val();
        if(success){
            toastr.success(success, 'Hệ thống thông báo: ', {timeOut: 3000});
        }
        if(error){
            toastr.error(error, 'Hệ thống thông báo: ', {timeOut: 3000});
        }
    });
</script>
@endsection()
