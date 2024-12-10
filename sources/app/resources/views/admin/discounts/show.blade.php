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
                    Discount: {{ $discount->name }}
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
                        {{ $discount->id }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Name:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $discount->name }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Percent, %:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $discount->percent }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Created At:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $discount->created_at }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Updated At:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $discount->updated_at }}
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-start gap-2">
                    <a href="{{ route('admin.discounts.index') }}" class="btn btn-secondary">
                        Back
                    </a>
                    @if (in_array('delete discounts', $permissions))
                        <form action="{{ route('admin.discounts.destroy', $discount->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    @endif
                    @if (in_array('edit discounts', $permissions))
                        <a href="{{ route('admin.discounts.edit', $discount->id) }}" class="btn btn-primary">
                            Update
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
