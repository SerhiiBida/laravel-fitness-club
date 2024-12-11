@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2">
        <div class="card">
            <div class="card-header">
                <h3>
                    Edit Membership Purchase
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.membership_purchases.update', $membershipPurchase->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="membership_id" class="form-label">
                                <strong>
                                    Membership:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <select id="membership_id" name="membership_id" class="form-select" required>
                                @foreach ($memberships as $membership)
                                    <option value="{{ $membership->id }}"
                                        {{ old('membership_id', $membershipPurchase->membership_id) == $membership->id ? 'selected' : '' }}>
                                        {{ $membership->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('membership_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="user_id" class="form-label">
                                <strong>
                                    User:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <select id="user_id" name="user_id" class="form-select" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id', $membershipPurchase->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->username }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="status" class="form-label">
                                <strong>
                                    Status:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <select id="status" name="status" class="form-select" required>
                                <option
                                    value="paid" {{ old('status', $membershipPurchase->status) == 'paid' ? 'selected' : '' }}>
                                    Paid
                                </option>
                                <option
                                    value="pending" {{ old('status', $membershipPurchase->status) == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option
                                    value="cancelled" {{ old('status', $membershipPurchase->status) == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled
                                </option>
                            </select>
                            @error('status')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="expired_at" class="form-label">
                                <strong>
                                    Expiration Date:
                                </strong>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="datetime-local" id="expired_at" name="expired_at" class="form-control"
                                   value="{{ old('expired_at', $membershipPurchase->expired_at ? \Carbon\Carbon::parse($membershipPurchase->expired_at)->format('Y-m-d\TH:i') : '') }}">
                            @error('expired_at')
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
                        <a href="{{ route('admin.membership_purchases.show', $membershipPurchase->id) }}"
                           class="btn btn-secondary ms-2">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
