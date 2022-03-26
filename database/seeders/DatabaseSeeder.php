<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $developers = Array();
        $task_lists = Array();

        $developers = [
            [
                'name'                          => 'DEV1',
                'difficulty'                    => '1',
                'max_working_hours_per_week'    => '45'
            ],
            [
                'name'                          => 'DEV2',
                'difficulty'                    => '2',
                'max_working_hours_per_week'    => '45'
            ],
            [
                'name'                          => 'DEV3',
                'difficulty'                    => '3',
                'max_working_hours_per_week'    => '45'
            ],
            [
                'name'                          => 'DEV4',
                'difficulty'                    => '4',
                'max_working_hours_per_week'    => '45'
            ],
            [
                'name'                          => 'DEV5',
                'difficulty'                    => '5',
                'max_working_hours_per_week'    => '45'
            ],

        ];

        $task_lists = [
            [
                'list_name'     => 'TodoList1',
                'list_url' => 'http://www.mocky.io/v2/5d47f24c330000623fa3ebfa'
            ],
            [
                'list_name'     => 'TodoList2',
                'list_url' => 'http://www.mocky.io/v2/5d47f235330000623fa3ebf7'
            ],


        ];

        DB::table('developers')
            ->insert($developers);

        DB::table('task_lists')
            ->insert($task_lists);
    }
}
