@extends('admin.layouts.base')

@php
    $columns = [
        'ID', 'Username', 'Email', 'Password', 'Bonuses', 'Avatar', 'IsStaff', 'Role', 'Created At', 'Updated At'
    ];
@endphp

@section('content')
    <section class="container-lg">
        @if (in_array('create users', $permissions))
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary mt-2">
                Create
            </a>
        @endif

        <div class="table-responsive ">
            <table class="table table-hover">
                <thead>
                <tr>
                    @foreach ($columns as $column)
                        <th scope="col">
                            {{ $column }}
                        </th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">
                            {{ $user->id }}
                        </th>
                        <td>
                            <a href="{{ route('admin.users.show', $user->id) }}">
                                {{ $user->username }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.users.show', $user->id) }}">
                                {{ $user->email }}
                            </a>
                        </td>
                        <td>
                            {{ $user->password }}
                        </td>
                        <td>
                            {{ $user->bonuses }}
                        </td>
                        <td>
                            <img
                                class="img-fluid"
                                src="{{ Storage::url($user->image_path) }}"
                                alt="user-avatar"
                            />
                        </td>
                        <td>
                            {{ $user->is_staff ? 'Yes' : 'No' }}
                        </td>
                        @foreach ($roles as $role)
                            @if ($role->id === $user->role_id)
                                <td>
                                    {{ $role->name }}
                                </td>
                            @endif
                        @endforeach
                        <td>
                            {{ $user->created_at }}
                        </td>
                        <td>
                            {{ $user->updated_at }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-2 d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </section>
@endsection
