@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        <div class="card">
            <div class="card-header">
                <h3>
                    Create New Membership
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.memberships.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="price" class="form-label">
                                <strong>
                                    Price:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input
                                type="number"
                                id="price"
                                name="price"
                                class="form-control"
                                value="{{ old('price') }}"
                                step="0.01"
                                required
                            >
                            @error('price')
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
                            <label for="validity_days" class="form-label">
                                <strong>
                                    Validity Days:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input
                                type="number"
                                id="validity_days"
                                name="validity_days"
                                class="form-control"
                                value="{{ old('validity_days') }}"
                                required
                            >
                            @error('validity_days')
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
                                value="{{ old('bonuses') }}"
                                required
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
                            <label for="discount_id" class="form-label">
                                <strong>
                                    Discount:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <select id="discount_id" name="discount_id" class="form-select">
                                <option value="">No Discount</option>
                                @foreach ($discounts as $discount)
                                    <option
                                        value="{{ $discount->id }}" {{ old('discount_id') == $discount->id ? 'selected' : '' }}>
                                        {{ $discount->name }} ({{ $discount->percent }}%)
                                    </option>
                                @endforeach
                            </select>
                            @error('discount_id')
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
                        <a href="{{ route('admin.memberships.index') }}" class="btn btn-secondary ms-2">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
