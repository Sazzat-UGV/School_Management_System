<?php

namespace Database\Seeders;

use App\Models\Schoolclass;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            'PART TIME',
            'SS1',
            'SS2',
            'SS2 (ARTS & SCIENCE)',
        ];
        foreach ($classes as $class) {
            Schoolclass::create([
                'user_id' => '1',
                'name' => $class,
                'status'=>'1',
            ]);
        }
    }
}
