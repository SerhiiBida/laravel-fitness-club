@php
    $userDropdown = ['view users', 'view roles'];
    $trainingDropdown = ['view trainings', 'schedules view', 'view training_registrations', 'view training_types'];
    $membershipDropdown = ['view memberships', 'view membership_purchases', 'view discounts'];
@endphp

<ul class="navbar-nav me-auto mb-2 mb-lg-0">
    @auth
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('admin.dashboard') }}">
                Dashboard
            </a>
        </li>
        {{--User--}}
        @if (array_intersect($userDropdown, $permissions))
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    User
                </a>
                <ul class="dropdown-menu">
                    @if (in_array('view users', $permissions))
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                Users
                            </a>
                        </li>
                    @endif
                    @if (in_array('view roles', $permissions))
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                                Roles
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        {{--Training--}}
        @if (array_intersect($trainingDropdown, $permissions))
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    Training
                </a>
                <ul class="dropdown-menu">
                    @if (in_array('view training_types', $permissions))
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.training_types.index') }}">
                                Training Types
                            </a>
                        </li>
                    @endif
                    @if (in_array('view trainings', $permissions))
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.trainings.index') }}">
                                Trainings
                            </a>
                        </li>
                    @endif
                    @if (in_array('view training_registrations', $permissions))
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.training_registrations.index') }}">
                                Training Registrations
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        {{--Membership--}}
        @if (array_intersect($membershipDropdown, $permissions))
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    Membership
                </a>
                <ul class="dropdown-menu">
                    @if (in_array('view memberships', $permissions))
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.memberships.index') }}">
                                Memberships
                            </a>
                        </li>
                    @endif
                    @if (in_array('view membership_purchases', $permissions))
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.membership_purchases.index') }}">
                                Membership Purchases
                            </a>
                        </li>
                    @endif
                    @if (in_array('view discounts', $permissions))
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.discounts.index') }}">
                                Discounts
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
    @endauth
</ul>
