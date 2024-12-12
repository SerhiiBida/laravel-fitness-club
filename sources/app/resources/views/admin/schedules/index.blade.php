@extends('admin.layouts.base')

@php
    $columns = [
        'ID', 'Training', 'Start Time', 'End Time', 'Created At', 'Updated At'
    ];
@endphp

@section('content')
    <section class="container-lg py-2 d-flex flex-column min-vh-100">
        <div class="options">
            @if (in_array('create schedules', $permissions))
                <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary mt-2">
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
                @foreach ($schedules as $schedule)
                    <tr>
                        <th scope="row">
                            {{ $schedule->id }}
                        </th>
                        <td>
                            <a href="{{ route('admin.schedules.show', $schedule->id) }}">
                                {{ $schedule->training->name }}
                            </a>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i (Y-m-d)') }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i (Y-m-d)') }}
                        </td>
                        <td>
                            {{ $schedule->created_at }}
                        </td>
                        <td>
                            {{ $schedule->updated_at }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-2 d-flex justify-content-center mt-auto overflow-x-auto">
            {{ $schedules->links() }}
        </div>
    </section>
@endsection
