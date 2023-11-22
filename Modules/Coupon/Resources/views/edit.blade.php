@extends('admin::layouts.master')

@section('title','E-SHOP || Coupon Edit')

@section('content')

    <div class="card">
        <h5 class="card-header">Edit Coupon</h5>
        <div class="card-body">
            @include('coupon::partials.form')
        </div>
    </div>

@endsection
