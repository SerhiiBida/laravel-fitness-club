@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        <div class="card">
            <div class="card-header">
                <h3>
                    Membership: {{ $membership->name }}
                </h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Image:
                        </strong>
                    </div>
                    <div class="col-md-9 w-25">
                        <img
                            class="img-fluid"
                            src="{{ Storage::url($membership->image_path) }}"
                            alt="membership-image"
                        />
                        @if ($membership->image_path)
                            <div class="mt-2">
                                <a
                                    href="{{ Storage::url($membership->image_path) }}"
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
                        {{ $membership->id }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Name:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $membership->name }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Description:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $membership->description }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Price:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $membership->price }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Validity Days:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $membership->validity_days }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Bonuses:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $membership->bonuses }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Is Published:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $membership->is_published ? 'Yes' : 'No' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Discount, %:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        @if ($membership->discount)
                            <a href="{{ route('admin.discounts.show', $membership->discount->id) }}">
                                {{ $membership->discount->name . ' (' . $membership->discount->percent . '%)' }}
                            </a>
                        @else
                            -
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Created At:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $membership->created_at }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Updated At:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $membership->updated_at }}
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-start gap-2">
                    <a href="{{ route('admin.memberships.index') }}" class="btn btn-secondary">
                        Back
                    </a>
                    @if (in_array('delete memberships', $permissions))
                        <form action="{{ route('admin.memberships.destroy', $membership->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    @endif
                    @if (in_array('edit memberships', $permissions))
                        <a href="{{ route('admin.memberships.edit', $membership->id) }}" class="btn btn-primary">
                            Update
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
