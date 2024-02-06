<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Crime;
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

        $crimes = [
            ['name' => 'Abduction with Rape'],
            ['name' => 'Acts of Lasciviousness'],
            ['name' => 'Alarms and Scandal'],
            ['name' => 'Arson'],
            ['name' => 'Murder'],
            ['name' => 'Attempted Estafa'],
            ['name' => 'Attempted Homicide'],
            ['name' => 'Attempted Murder'],
            ['name' => 'Attempted Parricide'],
            ['name' => 'Attempted Rape'],
            ['name' => 'Attempted Trafficking'],
            ['name' => 'Carnapping'],
            ['name' => 'Direct Assault'],
            ['name' => 'Estafa'],
            ['name' => 'Evasion of Service of Sentence'],
            ['name' => 'Frustrated Homicide'],
            ['name' => 'Frustrated Murder'],
            ['name' => 'Grave Threats'],
            ['name' => 'Highway Robbery'],
            ['name' => 'Homicide'],
            ['name' => 'Illegal Possession of Explosives'],
            ['name' => 'lllegal Possession of Firearm & Ammo'],
            ['name' => 'Illegal Recruitment'],
            ['name' => 'Illegal Sale and Disposition of Firearms'],
            ['name' => 'Kidnapping and Serious Illegal Detention'],
            ['name' => 'Lascivious Conduct'],
            ['name' => 'Less Serious Physical Injury'],
            ['name' => 'Malicious Mischief'],
            ['name' => 'Multiple Attempted Murder'],
            ['name' => 'Multiple Frustrated Murder'],
            ['name' => 'Multiple Murder'],
            ['name' => 'Parricide'],
            ['name' => 'Rape'],
            ['name' => 'Qualified Theft'],
            ['name' => 'Qualified Trafficking'],
            ['name' => 'Reckless Imprudence'],
            ['name' => 'Robbery'],
            ['name' => 'RA 9165'],
            ['name' => 'RA 9262'],
            ['name' => 'Serious Illegal Detention'],
            ['name' => 'Sexual Assault'],
            ['name' => 'Simple Theft'],
            ['name' => 'Slight Physical Injury'],
            ['name' => 'Statutory Rape'],
            ['name' => 'Syndicated & Large Scale Illegal Recruitment'],
            ['name' => 'Syndicated Estafa'],
            ['name' => 'Syndicated Illegal Recruitment'],
            ['name' => 'Theft'],
            ['name' => 'Trespass to Dwelling'],
            ['name' => 'Violation of Batas Pambansa No.6'],
            ['name' => 'PD 133'],
            ['name' => 'RA 11479'],
            ['name' => 'PD 1602'],
            ['name' => 'RA 7610'],
            ['name' => 'RA 7832'],
            ['name' => 'BP 881'],
            ['name' => 'RA 10591'],
            ['name' => 'Illegal Gambling'],
            ['name' => 'RA 7166'],
            ['name' => 'Trafficking'],
            ['name' => 'Anti Cybercrime Law'],
            ['name' => 'RA 9995']
        ];

        foreach ($crimes as $crime) {
            Crime::create([
                'name' => $crime['name']
            ]);
        }
    }
}
