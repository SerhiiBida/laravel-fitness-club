@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        <div class="card">
            <div class="card-header">
                <h3>
                    Training Registration Details
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
                        {{ $trainingRegistration->id }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            User:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        <a href="{{ route('admin.users.show', $trainingRegistration->user->id) }}">
                            {{ $trainingRegistration->user->username }}
                        </a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Training:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        <a href="{{ route('admin.trainings.show', $trainingRegistration->training->id) }}">
                            {{ $trainingRegistration->training->name }}
                        </a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Status:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $trainingRegistration->status }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Created At:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $trainingRegistration->created_at }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Updated At:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $trainingRegistration->updated_at }}
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-start gap-2">
                    <a href="{{ route('admin.training_registrations.index') }}" class="btn btn-secondary">
                        Back
                    </a>
                    @if (in_array('delete training_registrations', $permissions))
                        <form action="{{ route('admin.training_registrations.destroy', $trainingRegistration->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    @endif
                    @if (in_array('edit training_registrations', $permissions))
                        <a href="{{ route('admin.training_registrations.edit', $trainingRegistration->id) }}"
                           class="btn btn-primary">
                            Update
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
