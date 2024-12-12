@extends('admin.layouts.base')

@php
    $currentTime = \Carbon\Carbon::now();
@endphp

@section('content')
    <section class="container-lg py-2">
        <div class="card">
            <div class="card-header">
                <h3>
                    Training: {{ $training->name }}
                </h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Image:
                        </strong>
                    </div>
                    <div class="col-md-9 w-25">
                        <img
                            class="img-fluid"
                            src="{{ Storage::url($training->image_path) }}"
                            alt="training-image"
                        />
                        @if ($training->image_path)
                            <div class="mt-2">
                                <a
                                    href="{{ Storage::url($training->image_path) }}"
                                    class="btn btn-success"
                                    download
                                >
                                    Download
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            ID:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $training->id }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Name:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $training->name }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Description:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $training->description }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Training Type:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        @if ($training->trainingType)
                            <a href="{{ route('admin.training_types.show', $training->trainingType->id) }}">
                                {{ $training->trainingType->name }}
                            </a>
                        @else
                            -
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            User:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        @if ($training->user)
                            <a href="{{ route('admin.users.show', $training->user->id) }}">
                                {{ $training->user->username }}
                            </a>
                        @else
                            Unknown
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Is Published:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $training->is_published ? 'Yes' : 'No' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Is Private:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $training->is_private ? 'Yes' : 'No' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Memberships that give access:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        <select class="form-select" multiple disabled>
                            @foreach ($training->memberships as $membership)
                                <option value="{{ $membership->id }}">
                                    {{ $membership->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Created At:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $training->created_at }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Updated At:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $training->updated_at }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Registered Users:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        @if (!$trainingRegistrations->isEmpty())
                            <div class="list-group overflow-auto" style="max-height: 300px;">
                                @foreach ($trainingRegistrations as $record)
                                    <a
                                        href="{{ route('admin.training_registrations.show', $record->id) }}"
                                        class="list-group-item list-group-item-action"
                                    >
                                        {{ $record->user->username }} ({{ $record->user->email }})
                                    </a>
                                @endforeach
                            </div>
                        @else
                            -
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Training schedule:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        @if (!$training->schedules->isEmpty())
                            <div class="list-group overflow-auto" style="max-height: 300px;">
                                @foreach ($training->schedules as $schedule)
                                    @if (\Carbon\Carbon::parse($schedule->start_time)->isAfter($currentTime))
                                        <a
                                            href="{{ route('admin.schedules.show', $schedule->id) }}"
                                            class="list-group-item list-group-item-action"
                                        >
                                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i d-m-Y') }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        <a
                            href="{{ route('admin.schedules.create', ['trainingId' => $training->id]) }}"
                            class="mt-2 d-block"
                        >
                            <button class="btn btn-primary">
                                Add
                            </button>
                        </a>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-start gap-2">
                    <a href="{{ route('admin.trainings.index') }}" class="btn btn-secondary">
                        Back
                    </a>
                    @if (in_array('delete trainings', $permissions))
                        <form action="{{ route('admin.trainings.destroy', $training->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    @endif
                    @if (in_array('edit trainings', $permissions))
                        <a href="{{ route('admin.trainings.edit', $training->id) }}" class="btn btn-primary">
                            Update
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
