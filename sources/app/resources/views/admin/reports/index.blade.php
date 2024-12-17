@extends('admin.layouts.base')

@php
    $columns = [
        'ID', 'User', 'Name', 'File', 'Created At', 'Action'
    ];
@endphp

@section('content')
    <section class="container-lg py-2 pt-4 d-flex flex-column min-vh-100">
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
                @foreach ($reports as $report)
                    <tr>
                        <th scope="row">
                            {{ $report->id }}
                        </th>
                        <td>
                            <a href="{{ route('admin.users.show', $report->user->id) }}">
                                {{ $report->user->username }}
                            </a>
                        </td>
                        <td>
                            {{ $role->name }}
                        </td>
                        <td>
                            <a
                                class="btn btn-primary"
                                href="{{ Storage::url($report->file_path) }}"
                                download
                            >
                                Download
                            </a>
                        </td>
                        <td>
                            {{ $role->created_at }}
                        </td>
                        @if (in_array('delete reports', $permissions) || in_array('delete your reports', $permissions))
                            <td>
                                <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-2 d-flex justify-content-center mt-auto overflow-x-auto">
            {{ $reports->links() }}
        </div>
    </section>
@endsection
