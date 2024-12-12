@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        <div class="card">
            <div class="card-header">
                <h3>
                    Create New Training Registration
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.training_registrations.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="user_id" class="form-label">
                                <strong>
                                    User:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <select id="user_id" name="user_id" class="form-select" required>
                                <option value="">
                                    Select User
                                </option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->username }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

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
                                <option value="">
                                    Select Training
                                </option>
                                @foreach ($trainings as $training)
                                    <option
                                        value="{{ $training->id }}" {{ old('training_id') == $training->id ? 'selected' : '' }}
                                    >
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
                            <label for="status" class="form-label">
                                <strong>
                                    Status:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <select id="status" name="status" class="form-select" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                            @error('status')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary">
                            Create
                        </button>
                        <a href="{{ route('admin.training_registrations.index') }}" class="btn btn-secondary ms-2">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
