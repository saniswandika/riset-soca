<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'pengaduan-list',
            'pengaduan-create',
            'pengaduan-edit',
            'pengaduan-delete',
            'rekomendasi-list',
            'rekomendasi-create',
            'rekomendasi-edit',
            'rekomendasi-delete',
            'inventaris-list',
            'inventaris-create',
            'inventaris-edit',
            'inventaris-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete'
        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
