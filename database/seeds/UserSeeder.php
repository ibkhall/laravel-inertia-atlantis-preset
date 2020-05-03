<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Spatie\Permission\Models\Permission::create(['name' => 'VOIR DASHBOARD']);
        \Spatie\Permission\Models\Permission::create(['name' => 'VOIR LISTE UTLISATEURS']);
        \Spatie\Permission\Models\Permission::create(['name' => 'EDITER UN UTILISATEUR']);
        \Spatie\Permission\Models\Permission::create(['name' => 'CONFIGURER LE SYSTEME']);
        $role = \Spatie\Permission\Models\Role::create(['name' => 'Super Admin']);
        $role->givePermissionTo(['VOIR DASHBOARD', 'VOIR LISTE UTLISATEURS', 'EDITER UN UTILISATEUR', 'CONFIGURER LE SYSTEME']);
        $user = \App\User::create([
            'avatar' => new \Illuminate\Http\UploadedFile(public_path('img/profile.jpg'), 'profile'),
            'name' => 'admin',
            'email' => 'admin@site.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin')
        ]);

        $user->assignRole($role);

        for ($i=1; $i<=50; $i++) {
            \App\User::create([
                'avatar' => new \Illuminate\Http\UploadedFile(public_path('img/profile.jpg'), 'profile'),
                'name' => 'user'.$i,
                'email' => "user{$i}@site.com",
                'password' => \Illuminate\Support\Facades\Hash::make('user')
            ]);
        }
    }
}
