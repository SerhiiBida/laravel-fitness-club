@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        <div class="card">
            <div class="card-header">
                <h3>
                    Edit Schedule
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="training_id" class="form-label">
                                <strong>
                                    Training:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <select id="training_id" name="training_id" class="form-select" required>
                                @foreach ($trainings as $training)
                                    <option value="{{ $training->id }}"
                                        {{ old('training_id', $schedule->training_id) == $training->id ? 'selected' : '' }}>
                                        {{ $training->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('training_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="start_time" class="form-label">
                                <strong>
                                    Start Time:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input
                                type="datetime-local"
                                id="start_time"
                                name="start_time"
                                class="form-control"
                                value="{{ old('start_time', $schedule->start_time) }}"
                                required
                            >
                            @error('start_time')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="end_time" class="form-label">
                                <strong>
                                    End Time:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input
                                type="datetime-local"
                                id="end_time"
                                name="end_time"
                                class="form-control"
                                value="{{ old('end_time', $schedule->end_time) }}"
                                required
                            >
                            @error('end_time')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="users" class="form-label">
                                <strong>
                                    Visit:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <select id="users" name="users[]" class="form-select" multiple>
                                <option
                                    value=""
                                    {{ in_array("", old('users', [])) ? 'selected' : '' }}
                                >
                                    None
                                </option>
                                @foreach ($users as $user)
                                    <option
                                        value="{{ $user->id }}"
                                        @if(in_array($user->id, old('users', $schedule->users->pluck('id')->toArray())))
                                            selected
                                        @endif
                                    >
                                        {{ $user->username }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('users')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                        <a href="{{ route('admin.schedules.show', $schedule->id) }}" class="btn btn-secondary ms-2">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
