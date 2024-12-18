@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        <div class="card">
            <div class="card-header">
                <h3>
                    Schedule Details
                </h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            ID:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $schedule->id }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Training:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        <a href="{{ route('admin.trainings.show', $schedule->training->id) }}">
                            {{ $schedule->training->name }}
                        </a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Start Time:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i (Y-m-d)') }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            End Time:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i (Y-m-d)') }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Visit:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        <select class="form-select" multiple disabled>
                            @foreach ($schedule->users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->username }} ({{ $user->email }})
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
                        {{ $schedule->created_at }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Updated At:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $schedule->updated_at }}
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-start gap-2">
                    <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">
                        Back
                    </a>
                    @if (in_array('delete schedules', $permissions))
                        <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    @endif
                    @if (in_array('edit schedules', $permissions))
                        <a href="{{ route('admin.schedules.edit', $schedule->id) }}" class="btn btn-primary">
                            Update
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
