@extends('layouts.admin')

@section('content')
    <h1>Coupons List</h1>

    <a href="{{ route('admin.coupons.create') }}" class="btn btn-success mb-3">Create New Coupon</a>

    <table class="table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Discount</th>
                <th>Expiry Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->discount }}%</td>
                    <td>{{ $coupon->expiry_date }}</td>
                    <td>
                        <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
