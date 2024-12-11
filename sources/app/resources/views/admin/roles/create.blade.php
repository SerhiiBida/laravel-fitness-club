@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        <div class="card">
            <div class="card-header">
                <h3>
                    Create New Role
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.roles.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="permissions" class="form-label">
                                <strong>
                                    Permissions:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <select id="permissions" name="permissions[]" class="form-select" multiple>
                                @foreach($allPermissions as $permission)
                                    <option
                                        value="{{ $permission->id }}"
                                        @if(in_array($permission->id, old('permissions', [])))
                                            selected
                                        @endif
                                    >
                                        {{ $permission->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('permissions')
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
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary ms-2">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
