<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $subjects=[
        'AGRIC SCIENCE',
        'BASIC SCIENCE AND TECHNOLOGY',
        'BASIC TECHNOLOGY',
        'ENGLISH LANGUAGE',
        'HOME ECONOMICS',
        'MATHMATICS',
        'SOCIAL STUDIES'
       ];

       foreach($subjects as $subject){
        Subject::create([
            'user_id' => '1',
            'name' => $subject,
            'status' => '1',
            'type' => 'Theory',
        ]);
       }
    }
}
