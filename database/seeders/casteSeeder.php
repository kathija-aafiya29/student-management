<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Caste;

class casteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['caste_name' => 'Caste 1' ],
            ['caste_name' => 'Caste 2'],
            ['caste_name' => 'Caste 3'],
            ['caste_name' => 'Caste 4' ],
            ['caste_name' => 'Caste 6' ],
            ['caste_name' => 'Caste 7' ],
            ['caste_name' => 'Caste 8' ],
            ['caste_name' => 'Caste 9' ],
            ['caste_name' => 'Caste 10' ],
            ['caste_name' => 'Caste 11' ],
            ['caste_name' => 'Caste 12' ],

        ];

        foreach ($roles as $roleData) {
            Caste::create($roleData);
        }
    }
}
