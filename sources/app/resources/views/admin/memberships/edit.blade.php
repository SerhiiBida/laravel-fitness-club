@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        <div class="card">
            <div class="card-header">
                <h3>
                    Edit Membership
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.memberships.update', $membership->id) }}" method="POST"
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
                                   value="{{ old('name', $membership->name) }}" required>
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
                                      required>{{ old('description', $membership->description) }}</textarea>
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
                            <input type="number" id="price" name="price" class="form-control" step="0.01"
                                   value="{{ old('price', $membership->price) }}" required>
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
                            @if ($membership->image_path)
                                <div class="mb-2">
                                    <img class="img-fluid" src="{{ Storage::url($membership->image_path) }}"
                                         alt="membership-image" style="max-width: 150px;">
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
                            <label for="validity_days" class="form-label">
                                <strong>
                                    Validity Days:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" id="validity_days" name="validity_days" class="form-control"
                                   value="{{ old('validity_days', $membership->validity_days) }}" required>
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
                            <input type="number" id="bonuses" name="bonuses" class="form-control"
                                   value="{{ old('bonuses', $membership->bonuses) }}">
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
                                <option
                                    value="1" {{ old('is_published', $membership->is_published) == 1 ? 'selected' : '' }}>
                                    Yes
                                </option>
                                <option
                                    value="0" {{ old('is_published', $membership->is_published) == 0 ? 'selected' : '' }}>
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
                                <option
                                    value="" {{ old('discount_id', $membership->discount_id) == null ? 'selected' : '' }}>
                                    None
                                </option>
                                @foreach ($discounts as $discount)
                                    <option
                                        value="{{ $discount->id }}" {{ old('discount_id', $membership->discount_id) == $discount->id ? 'selected' : '' }}
                                    >
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
                            Update
                        </button>
                        <a href="{{ route('admin.memberships.show', $membership->id) }}" class="btn btn-secondary ms-2">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
