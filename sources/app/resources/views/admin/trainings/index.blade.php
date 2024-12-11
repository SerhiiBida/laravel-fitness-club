@extends('admin.layouts.base')

@php
    $columns = [
        'ID', 'Name', 'Description', 'Image', 'Training Type', 'User', 'Is Published', 'Is Private', 'Created At', 'Updated At'
    ];
@endphp

@section('content')
    <section class="container-lg py-2 d-flex flex-column min-vh-100">
        <div class="options">
            @if (in_array('create trainings', $permissions))
                <a href="{{ route('admin.trainings.create') }}" class="btn btn-primary mt-2">
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
                @foreach ($trainings as $training)
                    <tr>
                        <th scope="row">
                            {{ $training->id }}
                        </th>
                        <td>
                            <a href="{{ route('admin.trainings.show', $training->id) }}">
                                {{ $training->name }}
                            </a>
                        </td>
                        <td>
                            {{ Str::limit($training->description, 50) }}
                        </td>
                        <td>
                            <img
                                class="img-fluid"
                                src="{{ Storage::url($training->image_path) }}"
                                alt="img-training"
                            />
                        </td>
                        <td>
                            {{ $training->trainingType->name }}
                        </td>
                        <td>
                            {{ $training->user->username }}
                        </td>
                        <td>
                            {{ $training->is_published ? 'Yes' : 'No' }}
                        </td>
                        <td>
                            {{ $training->is_private ? 'Yes' : 'No' }}
                        </td>
                        <td>
                            {{ $training->created_at }}
                        </td>
                        <td>
                            {{ $training->updated_at }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-2 d-flex justify-content-center mt-auto overflow-x-auto">
            {{ $trainings->links() }}
        </div>
    </section>
@endsection
