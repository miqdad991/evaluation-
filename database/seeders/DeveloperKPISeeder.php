<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeveloperKPISeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Insert Developer Position
        $positionId = DB::table('positions')->insertGetId([
            'title' => 'Developer',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // KPIs for Developer
        $kpis = [
            ['Code Quality', 'Assess code clarity, structure, and maintainability (1–10 scale)', '>= 8', 20],
            ['Task Completion Time', 'Compare actual vs estimated time (1–10 scale)', '>= 8', 15],
            ['Bug-Free Delivery', 'Count post-delivery bugs; fewer = higher score (1–10 scale)', '10 = no bugs', 20],
            ['Communication', 'Evaluate clarity and consistency of communication (1–10 scale)', '>= 8', 10],
            ['Reopened Bug Rate', 'Lower % of reopened bugs = higher score (1–10 scale)', '10 = 0% reopened', 10],
            ['Mean Time to Resolve (MTTR)', 'Speed of resolving issues (1–10 scale)', '<= 1 day = 10', 10],
            ['Task Onboarding Speed', 'Time taken to start the task after assignment and clarify requirements (1–10 scale)', '≤ 1 day', 7],
            ['Task Understanding Accuracy', 'How well the task was understood and implemented correctly from the start (1–10 scale)', '>= 8', 8],
        ];

        foreach ($kpis as [$name, $howToMeasure, $target, $weight]) {
            DB::table('position_kpis')->insert([
                'position_id'    => $positionId,
                'name'           => $name,
                'how_to_measure' => $howToMeasure,
                'target'         => $target,
                'weight'         => $weight,
                'created_at'     => $now,
                'updated_at'     => $now,
            ]);
        }
    }
}
