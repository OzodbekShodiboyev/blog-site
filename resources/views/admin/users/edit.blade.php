@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('content')


    <main class="main-content">


        <div class="content">
            <h2>User tahrirlash</h2>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- PUT metodidan foydalanish -->

                <div class="form-group">
                    <label for="name">Ism</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="password">Parol (yangi parol kiritish shart emas)</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Parolni tasdiqlang</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                </div>

                <div class="form-group">
                    <label for="roles">Rollar</label>
                    <select name="roles[]" id="roles" class="form-control" multiple required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" @if ($user->hasRole($role->name)) selected @endif>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="permissions">Permissions</label>
                    <select name="permissions[]" id="permissions" class="form-control" multiple>
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->name }}" @if ($user->hasPermissionTo($permission->name)) selected @endif>
                                {{ $permission->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Yangilash</button>
            </form>



        </div>
    </main>
    </div>
@endsection
