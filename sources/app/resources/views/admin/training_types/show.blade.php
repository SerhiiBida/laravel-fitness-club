@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        <div class="card">
            <div class="card-header">
                <h3>
                    Training Type: {{ $trainingType->name }}
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
                        {{ $trainingType->id }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Name:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $trainingType->name }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Created At:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $trainingType->created_at }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Updated At:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $trainingType->updated_at }}
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-start gap-2">
                    <a href="{{ route('admin.training_types.index') }}" class="btn btn-secondary">
                        Back
                    </a>
                    @if (in_array('delete training_types', $permissions))
                        <form action="{{ route('admin.training_types.destroy', $trainingType->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    @endif
                    @if (in_array('edit training_types', $permissions))
                        <a href="{{ route('admin.training_types.edit', $trainingType->id) }}" class="btn btn-primary">
                            Update
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
