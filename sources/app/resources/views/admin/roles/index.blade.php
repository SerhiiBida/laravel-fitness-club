@extends('admin.layouts.base')

@php
    $columns = [
        'ID', 'Name', 'Created At', 'Updated At'
    ];
@endphp

@section('content')
    <section class="container-lg">
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary mt-2">
            Create
        </a>
        <div class="table-responsive ">
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
                @foreach ($roles as $role)
                    <tr>
                        <th scope="row">
                            {{ $role->id }}
                        </th>
                        <td>
                            <a href="{{ route('admin.roles.show', $role->id) }}">
                                {{ $role->name }}
                            </a>
                        </td>
                        <td>
                            {{ $role->created_at }}
                        </td>
                        <td>
                            {{ $role->updated_at }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-2 d-flex justify-content-center">
            {{ $roles->links() }}
        </div>
    </section>
@endsection