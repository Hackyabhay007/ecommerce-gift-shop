@extends('layouts.admin')

@section('content')
    <h1>Create Coupon</h1>

    <form action="{{ route('admin.coupons.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="code">Coupon Code</label>
            <input type="text" name="code" class="form-control" placeholder="Enter coupon code" required>
        </div>

        <div class="form-group">
            <label for="discount">Discount (%)</label>
            <input type="number" name="discount" class="form-control" step="0.01" placeholder="Enter discount percentage" required>
        </div>

        <div class="form-group">
            <label for="expiry_date">Expiry Date</label>
            <input type="date" name="expiry_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Create Coupon</button>
    </form>
@endsection
