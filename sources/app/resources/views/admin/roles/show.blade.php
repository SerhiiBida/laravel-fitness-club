@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        {{--Уведомления--}}
        @error('errorMessage')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror

        <div class="card">
            <div class="card-header">
                <h3>
                    Role: {{ $role->name }}
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
                        {{ $role->id }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Name:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $role->name }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Permissions:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        <select class="form-select" multiple disabled>
                            @foreach ($role->permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
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
                        {{ $role->created_at }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Updated At:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $role->updated_at }}
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-start gap-2">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                        Back
                    </a>
                    @if (in_array('delete roles', $permissions))
                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    @endif
                    @if (in_array('edit roles', $permissions))
                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary">
                            Update
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
