<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'auth_profile_edit',
            ],
            [
                'id'    => 2,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 3,
                'title' => 'permission_create',
            ],
            [
                'id'    => 4,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 5,
                'title' => 'permission_show',
            ],
            [
                'id'    => 6,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 7,
                'title' => 'permission_access',
            ],
            [
                'id'    => 8,
                'title' => 'role_create',
            ],
            [
                'id'    => 9,
                'title' => 'role_edit',
            ],
            [
                'id'    => 10,
                'title' => 'role_show',
            ],
            [
                'id'    => 11,
                'title' => 'role_delete',
            ],
            [
                'id'    => 12,
                'title' => 'role_access',
            ],
            [
                'id'    => 13,
                'title' => 'user_create',
            ],
            [
                'id'    => 14,
                'title' => 'user_edit',
            ],
            [
                'id'    => 15,
                'title' => 'user_show',
            ],
            [
                'id'    => 16,
                'title' => 'user_delete',
            ],
            [
                'id'    => 17,
                'title' => 'user_access',
            ],
            [
                'id'    => 18,
                'title' => 'draft_create',
            ],
            [
                'id'    => 19,
                'title' => 'draft_edit',
            ],
            [
                'id'    => 20,
                'title' => 'draft_show',
            ],
            [
                'id'    => 21,
                'title' => 'draft_delete',
            ],
            [
                'id'    => 22,
                'title' => 'draft_access',
            ],
            [
                'id'    => 23,
                'title' => 'setting_create',
            ],
            [
                'id'    => 24,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 25,
                'title' => 'setting_show',
            ],
            [
                'id'    => 26,
                'title' => 'setting_delete',
            ],
            [
                'id'    => 27,
                'title' => 'setting_access',
            ],
            [
                'id'    => 28,
                'title' => 'sent_create',
            ],
            [
                'id'    => 29,
                'title' => 'sent_edit',
            ],
            [
                'id'    => 30,
                'title' => 'sent_show',
            ],
            [
                'id'    => 31,
                'title' => 'sent_delete',
            ],
            [
                'id'    => 32,
                'title' => 'sent_access',
            ],
            [
                'id'    => 33,
                'title' => 'trash_create',
            ],
            [
                'id'    => 34,
                'title' => 'trash_edit',
            ],
            [
                'id'    => 35,
                'title' => 'trash_show',
            ],
            [
                'id'    => 36,
                'title' => 'trash_delete',
            ],
            [
                'id'    => 37,
                'title' => 'trash_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
