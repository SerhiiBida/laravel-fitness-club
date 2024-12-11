@extends('admin.layouts.base')

@php
    $columns = [
        'ID', 'Membership', 'User', 'Status', 'Expired At', 'Created At', 'Updated At'
    ];
@endphp

@section('content')
    <section class="container-lg py-2 d-flex flex-column min-vh-100">
        <div class="options">
            @if (in_array('create membership_purchases', $permissions))
                <a href="{{ route('admin.membership_purchases.create') }}" class="btn btn-primary mt-2">
                    Create
                </a>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    @foreach ($columns as $column)
                        <th scope="col">
                            {{ $column }}
                        </th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach ($membershipPurchases as $purchase)
                    <tr>
                        <th scope="row">
                            {{ $purchase->id }}
                        </th>
                        <td>
                            <a href="{{ route('admin.membership_purchases.show', $purchase->id) }}">
                                {{ $purchase->membership->name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.membership_purchases.show', $purchase->id) }}">
                                {{ $purchase->user->username }}
                            </a>
                        </td>
                        <td>
                            {{ $purchase->status }}
                        </td>
                        <td>
                            {{ $purchase->expired_at ?? '-' }}
                        </td>
                        <td>
                            {{ $purchase->created_at }}
                        </td>
                        <td>
                            {{ $purchase->updated_at }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-2 d-flex justify-content-center mt-auto overflow-x-auto">
            {{ $membershipPurchases->links() }}
        </div>
    </section>
@endsection
