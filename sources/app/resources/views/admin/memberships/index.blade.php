@extends('admin.layouts.base')

@php
    $columns = [
        'ID', 'Name', 'Description', 'Price,$', 'Image', 'Validity Days', 'Bonuses', 'Is Published', 'Discount,%', 'Created At', 'Updated At'
    ];
@endphp

@section('content')
    <section class="container-lg py-2 d-flex flex-column min-vh-100">
        <div class="options">
            @if (in_array('create memberships', $permissions))
                <a href="{{ route('admin.memberships.create') }}" class="btn btn-primary mt-2">
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
                @foreach ($memberships as $membership)
                    <tr>
                        <th scope="row">
                            {{ $membership->id }}
                        </th>
                        <td>
                            <a href="{{ route('admin.memberships.show', $membership->id) }}">
                                {{ $membership->name }}
                            </a>
                        </td>
                        <td>
                            {{ Str::limit($membership->description, 50) }}
                        </td>
                        <td>
                            {{ $membership->price }}
                        </td>
                        <td>
                            <img
                                class="img-fluid"
                                src="{{ Storage::url($membership->image_path) }}"
                                alt="img-membership"
                            />
                        </td>
                        <td>
                            {{ $membership->validity_days }}
                        </td>
                        <td>
                            {{ $membership->bonuses }}
                        </td>
                        <td>
                            {{ $membership->is_published ? 'Yes' : 'No' }}
                        </td>
                        <td>
                            {{ $membership->discount->percent ?? '-' }}
                        </td>
                        <td>
                            {{ $membership->created_at }}
                        </td>
                        <td>
                            {{ $membership->updated_at }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-2 d-flex justify-content-center mt-auto overflow-x-auto">
            {{ $memberships->links() }}
        </div>
    </section>
@endsection
