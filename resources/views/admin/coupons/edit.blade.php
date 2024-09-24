@extends('layouts.admin')

@section('content')
    <h1>Edit Coupon</h1>

    <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="code">Coupon Code</label>
            <input type="text" name="code" class="form-control" value="{{ $coupon->code }}" required>
        </div>

        <div class="form-group">
            <label for="discount">Discount (%)</label>
            <input type="number" name="discount" class="form-control" step="0.01" value="{{ $coupon->discount }}" required>
        </div>

        <div class="form-group">
            <label for="expiry_date">Expiry Date</label>
            <input type="date" name="expiry_date" class="form-control" value="{{ $coupon->expiry_date }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Coupon</button>
    </form>
@endsection
