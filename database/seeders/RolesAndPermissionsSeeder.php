<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $authorRole = Role::create(['name' => 'author']);
        $userRole = Role::create(['name' => 'user']);

        $createPostPermission = Permission::create(['name' => 'post.create']);
        $editPostPermission = Permission::create(['name' => 'post.edit']);
        $deletePostPermission = Permission::create(['name' => 'post.delete']);
        $viewPostPermission = Permission::create(['name' => 'post.view']);
        $publishPostPermission = Permission::create(['name' => 'post.publish']);
        $commentPostPermission = Permission::create(['name' => 'comment.create']);
        $likePostPermission = Permission::create(['name' => 'post.like']);
        $userViewPermission = Permission::create(['name' => 'user.view']);
        $userEditPermission = Permission::create(['name' => 'user.edit']);
        $assignRolePermission = Permission::create(['name' => 'role.assign']);

        // Assign permissions to roles
        $adminRole->givePermissionTo($createPostPermission);
        $adminRole->givePermissionTo($editPostPermission);
        $adminRole->givePermissionTo($deletePostPermission);
        $adminRole->givePermissionTo($viewPostPermission);
        $adminRole->givePermissionTo($publishPostPermission);
        $adminRole->givePermissionTo($commentPostPermission);
        $adminRole->givePermissionTo($likePostPermission);
        $adminRole->givePermissionTo($userViewPermission);
        $adminRole->givePermissionTo($userEditPermission);
        $adminRole->givePermissionTo($assignRolePermission);

        $authorRole->givePermissionTo($createPostPermission);
        $authorRole->givePermissionTo($editPostPermission);
        $authorRole->givePermissionTo($viewPostPermission);
        $authorRole->givePermissionTo($publishPostPermission);
        $authorRole->givePermissionTo($commentPostPermission);
        $authorRole->givePermissionTo($likePostPermission);

        $userRole->givePermissionTo($viewPostPermission);
        $userRole->givePermissionTo($commentPostPermission);
        $userRole->givePermissionTo($likePostPermission);
    }
    
}
