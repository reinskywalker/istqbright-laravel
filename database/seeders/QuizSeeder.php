<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quiz::create([
            'question' => 'Sample Question 1',
            'explanation' => 'Explanation for Sample Question 1',
            'is_active' => '1',
            'section_id' => 1, // Replace with a valid section_id
            'user_id' => 1, // Replace with a valid user_id
        ]);

        Quiz::create([
            'question' => 'Sample Question 2',
            'explanation' => 'Explanation for Sample Question 2',
            'is_active' => '1',
            'section_id' => 2, // Replace with a valid section_id
            'user_id' => 1, // Replace with a valid user_id
        ]);
    }
}
