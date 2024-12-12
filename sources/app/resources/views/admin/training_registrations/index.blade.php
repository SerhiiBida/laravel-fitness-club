@extends('admin.layouts.base')

@php
    $columns = [
        'ID', 'User', 'Training', 'Status', 'Created At', 'Updated At'
    ];
@endphp

@section('content')
    <section class="container-lg py-2 d-flex flex-column min-vh-100">
        <div class="options">
            @if (in_array('create training_registrations', $permissions))
                <a href="{{ route('admin.training_registrations.create') }}" class="btn btn-primary mt-2">
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
                @foreach ($trainingRegistrations as $registration)
                    <tr>
                        <th scope="row">
                            {{ $registration->id }}
                        </th>
                        <td>
                            <a href="{{ route('admin.training_registrations.show', $registration->id) }}">
                                {{ $registration->user->username }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.training_registrations.show', $registration->id) }}">
                                {{ $registration->training->name }}
                            </a>
                        </td>
                        <td>
                            {{ $registration->status }}
                        </td>
                        <td>
                            {{ $registration->created_at }}
                        </td>
                        <td>
                            {{ $registration->updated_at }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-2 d-flex justify-content-center mt-auto overflow-x-auto">
            {{ $trainingRegistrations->links() }}
        </div>
    </section>
@endsection
