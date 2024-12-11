@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        <div class="card">
            <div class="card-header">
                <h3>
                    Edit Training Type
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.training_types.update', $trainingType->id) }}" method="POST"
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
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $trainingType->name) }}"
                                required
                            >
                            @error('name')
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
                        <a
                            href="{{ route('admin.training_types.show', $trainingType->id) }}"
                            class="btn btn-secondary ms-2"
                        >
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
