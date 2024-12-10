@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        {{-- Уведомления --}}
        @error('errorMessage')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror

        <div class="card">
            <div class="card-header">
                <h3>
                    Create New Discount
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.discounts.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="percent" class="form-label">
                                <strong>
                                    Percent, %:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input
                                type="number"
                                id="percent"
                                name="percent"
                                class="form-control"
                                value="{{ old('percent') }}"
                                step='0.01'
                                placeholder='0,00'
                                required
                            >
                            @error('percent')
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
                        <a href="{{ route('admin.discounts.index') }}" class="btn btn-secondary ms-2">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
