<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['role-list',1],
            ['role-create',1],
            ['role-edit',1],
            ['role-delete',1],
            ['user-list',1],
            ['user-create',1],
            ['user-edit',1],
            ['user-delete',1],
            ['playlist-list',1],
            ['playlist-create',1],
            ['playlist-edit',1],
            ['playlist-delete',1],
            ['homepage-list',1],
            ['homepage-edit',1],
            ['contact-list',1],
            ['contact-show',1],
            ['contact-delete',1],
            ['post-list',2],
            ['post-create',2],
            ['post-edit',2],
            ['post-delete',2],
            ['show-list',2],
            ['show-create',2],
            ['show-edit',2],
            ['show-delete',2],
            ['show-details-list',2],
            ['show-details-create',2],
            ['show-details-edit',2],
            ['show-details-delete',2],
            ['program-list',2],
            ['program-create',2],
            ['program-edit',2],
            ['program-delete',2],
            ['program-details-list',2],
            ['program-details-create',2],
            ['program-details-edit',2],
            ['program-details-delete',2],
            ['category-list',2],
            ['category-create',2],
            ['category-edit',2],
            ['category-delete',2],
            ['tag-list',2],
            ['tag-create',2],
            ['tag-edit',2],
            ['tag-delete',2],
            ['keyword-list',3],
            ['keyword-create',3],
            ['keyword-edit',3],
            ['keyword-delete',3]
        ];
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission[0],
                'group_id' => $permission[1]
            ]);
        }
    }
}
