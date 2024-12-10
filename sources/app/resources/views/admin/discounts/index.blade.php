@extends('admin.layouts.base')

@php
    $columns = [
        'ID', 'Name', 'Percent, %', 'Created At', 'Updated At'
    ];
@endphp

@section('content')
    <section class="container-lg py-2 d-flex flex-column min-vh-100">
        <div class="options">
            @if (in_array('create discounts', $permissions))
                <a href="{{ route('admin.discounts.create') }}" class="btn btn-primary mt-2">
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
                @foreach ($discounts as $discount)
                    <tr>
                        <th scope="row">
                            {{ $discount->id }}
                        </th>
                        <td>
                            <a href="{{ route('admin.discounts.show', $discount->id) }}">
                                {{ $discount->name }}
                            </a>
                        </td>
                        <td>
                            {{ $discount->percent }}
                        </td>
                        <td>
                            {{ $discount->created_at}}
                        </td>
                        <td>
                            {{ $discount->updated_at }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-2 d-flex justify-content-center mt-auto overflow-x-auto">
            {{ $discounts->links() }}
        </div>
    </section>
@endsection
