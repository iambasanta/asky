<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Question;
use App\Models\Answer;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->delete();
        DB::table('questions')->delete();
        DB::table('users')->delete();

        User::factory(3)
            ->has(Question::factory()->count(5)
                ->has(Answer::factory()->count(3)))
            ->create();
    }
}
