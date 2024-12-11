@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        <div class="card">
            <div class="card-header">
                <h3>
                    Create New Training
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.trainings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="name" class="form-label">
                                <strong>
                                    Name:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                required
                            >
                            @error('name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="description" class="form-label">
                                <strong>
                                    Description:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <textarea
                                id="description"
                                name="description"
                                class="form-control"
                                rows="5"
                                required>{{ old('description') }}</textarea>
                            @error('description')
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
                                    Image:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input
                                type="file"
                                id="image"
                                name="image"
                                class="form-control"
                            >
                            @error('image')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="training_type_id" class="form-label">
                                <strong>
                                    Training Type:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <select id="training_type_id" name="training_type_id" class="form-select" required>
                                <option value="">Select Type</option>
                                @foreach ($trainingTypes as $type)
                                    <option
                                        value="{{ $type->id }}" {{ old('training_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('training_type_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

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
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option
                                        value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
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
                            <label for="is_published" class="form-label">
                                <strong>
                                    Is Published:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <select id="is_published" name="is_published" class="form-select">
                                <option value="1" {{ old('is_published') == 1 ? 'selected' : '' }}>
                                    Yes
                                </option>
                                <option value="0" {{ old('is_published') == 0 ? 'selected' : '' }}>
                                    No
                                </option>
                            </select>
                            @error('is_published')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="is_private" class="form-label">
                                <strong>
                                    Is Private:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <select id="is_private" name="is_private" class="form-select">
                                <option value="1" {{ old('is_private') == 1 ? 'selected' : '' }}>
                                    Yes
                                </option>
                                <option value="0" {{ old('is_private') == 0 ? 'selected' : '' }}>
                                    No
                                </option>
                            </select>
                            @error('is_private')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="memberships" class="form-label">
                                <strong>
                                    Memberships that give access:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <select id="memberships" name="memberships[]" class="form-select" multiple>
                                @foreach($memberships as $membership)
                                    <option
                                        value="{{ $membership->id }}"
                                        @if(in_array($membership->id, old('memberships', [])))
                                            selected
                                        @endif
                                    >
                                        {{ $membership->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('memberships')
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
                        <a href="{{ route('admin.trainings.index') }}" class="btn btn-secondary ms-2">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
