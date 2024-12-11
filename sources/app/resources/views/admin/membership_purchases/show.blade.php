@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        {{-- Notifications --}}
        @error('errorMessage')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror

        <div class="card">
            <div class="card-header">
                <h3>
                    Membership Purchase Details
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
                        {{ $membershipPurchase->id }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Membership:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        <a href="{{ route('admin.memberships.show', $membershipPurchase->membership->id) }}">
                            {{ $membershipPurchase->membership->name }}
                        </a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            User:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        <a href="{{ route('admin.users.show', $membershipPurchase->user->id) }}">
                            {{ $membershipPurchase->user->username }}
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
                        {{ $membershipPurchase->status }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Expired At:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $membershipPurchase->expired_at ?? '-' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Created At:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $membershipPurchase->created_at }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>
                            Updated At:
                        </strong>
                    </div>
                    <div class="col-md-9">
                        {{ $membershipPurchase->updated_at }}
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-start gap-2">
                    <a href="{{ route('admin.membership_purchases.index') }}" class="btn btn-secondary">
                        Back
                    </a>
                    @if (in_array('delete membership_purchases', $permissions))
                        <form action="{{ route('admin.membership_purchases.destroy', $membershipPurchase->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    @endif
                    @if (in_array('edit membership_purchases', $permissions))
                        <a href="{{ route('admin.membership_purchases.edit', $membershipPurchase->id) }}"
                           class="btn btn-primary">
                            Update
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
