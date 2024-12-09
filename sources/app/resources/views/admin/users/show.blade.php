@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        <div class="card">
            <div class="card-header">
                <h3>
                    Profile: {{ $user->username }}
                </h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Avatar:
                        </strong>
                    </div>
                    <div class="col-md-9 w-25">
                        <img
                            class="img-fluid"
                            src="{{ Storage::url($user->image_path) }}"
                            alt="user-avatar"
                        />
                        <!--Ссылка на скачивание-->
                        @if ($user->image_path)
                            <div class="mt-2">
                                <a
                                    href="{{ Storage::url($user->image_path) }}"
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
                        {{ $user->id }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Username:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $user->username }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Email:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $user->email }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Password:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $user->password }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Bonuses:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $user->bonuses }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Is Staff:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $user->is_staff ? 'Yes' : 'No' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Role:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        @foreach ($roles as $role)
                            @if ($role->id === $user->role_id)
                                {{ $role->name }}
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Created At:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $user->created_at }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Updated At:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $user->updated_at }}
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-start gap-2">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        Back
                    </a>
                    @if (in_array('delete users', $permissions))
                        <a href="{{ route('admin.users.destroy', $user->id) }}" class="btn btn-danger">
                            Delete
                        </a>
                    @endif
                    @if (in_array('edit users', $permissions))
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">
                            Update
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
