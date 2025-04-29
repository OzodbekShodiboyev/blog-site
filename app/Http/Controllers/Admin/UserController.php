<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        $roles = Role::select('id', 'name')->get();
        $permissions = Permission::select('id', 'name')->get();

        return view('admin.users.create', compact('roles', 'permissions'));
    }
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole($request->roles);

            if ($request->has('permissions')) {
                $user->givePermissionTo($request->permissions);
            }

            DB::commit();

            return redirect()->route('admin.users')->with('success', 'Foydalanuvchi muvaffaqiyatli yaratildi.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Foydalanuvchi yaratishda xatolik: ' . $e->getMessage());

            return back()->with('error', 'Foydalanuvchi yaratishda xatolik yuz berdi.');
        }
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        if ($user->trashed()) {
            return redirect()->route('admin.users')->with('error', 'Bu foydalanuvchi mavjud emas.');
        }

        $roles = Role::select('id', 'name')->get();
        $permissions = Permission::select('id', 'name')->get();

        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array',
            'permissions' => 'nullable|array',
        ]);

        DB::beginTransaction();

        try {
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $request->filled('password') ? Hash::make($validated['password']) : $user->password,
            ]);

            $user->syncRoles($validated['roles']);

            if ($request->filled('permissions')) {
                $user->syncPermissions($validated['permissions']);
            } else {
                $user->syncPermissions([]);
            }

            DB::commit();

            return redirect()->route('admin.users')->with('success', 'Foydalanuvchi muvaffaqiyatli yangilandi.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Foydalanuvchini yangilashda xatolik: ' . $e->getMessage());

            return back()->with('error', 'Foydalanuvchini yangilashda xatolik yuz berdi.');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        DB::beginTransaction();

        try {

            $user->delete();

            DB::commit();

            return redirect()->route('admin.users')->with('success', 'Foydalanuvchi muvaffaqiyatli o‘chirildi.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error("Foydalanuvchini o‘chirishda xatolik: " . $e->getMessage());

            return back()->with('error', 'Foydalanuvchini o‘chirishda xatolik yuz berdi.');
        }
    }
}
