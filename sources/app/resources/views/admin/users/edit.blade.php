@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        <div class="card">
            <div class="card-header">
                <h3>
                    Edit User
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="username" class="form-label">
                                <strong>
                                    Username:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="username" name="username" class="form-control"
                                   value="{{ old('username', $user->username) }}" required>
                            @error('username')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="email" class="form-label">
                                <strong>
                                    Email:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="email" id="email" name="email" class="form-control"
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="password" class="form-label">
                                <strong>
                                    Password:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="password" id="password" name="password" class="form-control">
                            <small class="form-text text-muted">
                                Leave this field blank if you don't want to change the password.
                            </small>
                            @error('password')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="bonuses" class="form-label">
                                <strong>
                                    Bonuses:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input
                                type="number"
                                id="bonuses"
                                name="bonuses"
                                class="form-control"
                                value="{{ old('bonuses', $user->bonuses) }}"
                            >
                            @error('bonuses')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="image" class="form-label">
                                <strong>
                                    Avatar:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            @if ($user->image_path)
                                <div class="mb-2">
                                    <img
                                        class="img-fluid"
                                        src="{{ Storage::url($user->image_path) }}"
                                        alt="user-avatar"
                                        style="max-width: 150px;"
                                    />
                                </div>
                            @endif
                            <input type="file" id="image" name="image" class="form-control">
                            <small class="form-text text-muted">
                                Upload a new avatar to replace the existing one.
                            </small>
                            @error('image')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="is_staff" class="form-label">
                                <strong>
                                    Is Staff:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <select id="is_staff" name="is_staff" class="form-select">
                                <option value="1" {{ old('is_staff', $user->is_staff) == 1 ? 'selected' : '' }}>
                                    Yes
                                </option>
                                <option value="0" {{ old('is_staff', $user->is_staff) == 0 ? 'selected' : '' }}>
                                    No
                                </option>
                            </select>
                            @error('is_staff')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="role_id" class="form-label">
                                <strong>
                                    Role:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <select id="role_id" name="role_id" class="form-select" required>
                                @foreach ($roles as $role)
                                    <option
                                        value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
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
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-secondary ms-2">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

