<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        $philippineRegions = [
            ['name' => 'NCR'],
            ['name' => 'Region I'],
            ['name' => 'CAR'],
            ['name' => 'Region II'],
            ['name' => 'Region III'],
            ['name' => 'Region IV-A'],
            ['name' => 'Region IV-B'],
            ['name' => 'Region V'],
            ['name' => 'Region VI'],
            ['name' => 'Region VII'],
            ['name' => 'Region VIII'],
            ['name' => 'Region IX'],
            ['name' => 'Region X'],
            ['name' => 'Region XI'],
            ['name' => 'Region XII'],
            ['name' => 'Region XIII'],
            ['name' => 'BARMM'],
        ];

        foreach ($philippineRegions as $philippineRegion) {
           Region::create([
            'name' => $philippineRegion['name']
           ]);
        }

        User::create([
            'name' => 'Superadmin',
            'email' =>'superadmin@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 'superadmin',
        ]);
    }
}
