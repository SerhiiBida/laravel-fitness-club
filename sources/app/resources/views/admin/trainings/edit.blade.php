@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        <div class="card">
            <div class="card-header">
                <h3>
                    Edit Training
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.trainings.update', $training->id) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="name" class="form-label">
                                <strong>
                                    Name:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="name" name="name" class="form-control"
                                   value="{{ old('name', $training->name) }}" required>
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
                            <textarea id="description" name="description" class="form-control" rows="4"
                                      required>{{ old('description', $training->description) }}</textarea>
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
                            @if ($training->image_path)
                                <div class="mb-2">
                                    <img class="img-fluid" src="{{ Storage::url($training->image_path) }}"
                                         alt="training-image" style="max-width: 150px;">
                                </div>
                            @endif
                            <input type="file" id="image" name="image" class="form-control">
                            <small class="form-text text-muted">Upload a new image to replace the existing one.</small>
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
                            <select id="training_type_id" name="training_type_id" class="form-select">
                                @foreach ($trainingTypes as $trainingType)
                                    <option value="{{ $trainingType->id }}"
                                        {{ old('training_type_id', $training->training_type_id) == $trainingType->id ? 'selected' : '' }}>
                                        {{ $trainingType->name }}
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
                            <select id="user_id" name="user_id" class="form-select">
                                @foreach ($users as $user)
                                    <option
                                        value="{{ $user->id }}"
                                        {{ old('user_id', $training->user_id) == $user->id ? 'selected' : '' }}
                                    >
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
                                <option
                                    value="1" {{ old('is_published', $training->is_published) == 1 ? 'selected' : '' }}>
                                    Yes
                                </option>
                                <option
                                    value="0" {{ old('is_published', $training->is_published) == 0 ? 'selected' : '' }}>
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
                                <option value="1" {{ old('is_private', $training->is_private) == 1 ? 'selected' : '' }}>
                                    Yes
                                </option>
                                <option value="0" {{ old('is_private', $training->is_private) == 0 ? 'selected' : '' }}>
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
                                @foreach ($memberships as $membership)
                                    <option
                                        value="{{ $membership->id }}"
                                        @if(in_array($membership->id, old('memberships', $training->memberships->pluck('id')->toArray())))
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
                            Update
                        </button>
                        <a href="{{ route('admin.trainings.show', $training->id) }}" class="btn btn-secondary ms-2">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
