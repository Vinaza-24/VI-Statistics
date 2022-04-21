<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Creación de Roles */
      $rolCoach =  Role::create(['name' =>'Coach']);
      $rolCoachTeam =  Role::create(['name' =>'CoachTeam']);
      $rolPlayer = Role::create(['name' =>'Player']);

      $GeneratedPassword =  Role::create(['name' =>'Generated Password']);



       /* Creación de Permisos y asignación de rol */
      Permission::create(['name' =>'create player'])->assignRole($rolCoachTeam);
      Permission::create(['name' =>'players list'])->assignRole($rolCoachTeam);
      Permission::create(['name' =>'see team'])->assignRole([$rolCoach,$rolPlayer]);

      Permission::create(['name' =>'generated password'])->assignRole($GeneratedPassword);
    }
}
