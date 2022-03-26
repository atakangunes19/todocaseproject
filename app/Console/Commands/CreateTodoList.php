<?php

namespace App\Console\Commands;

use App\Models\Tasks;
use App\Models\TaskLists;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CreateTodoList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:createTodoList';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->taskListOne();
        $this->taskListTwo();

        return Command::SUCCESS;
    }

    public function taskListOne()
    {
        $taskList = TaskLists::where('list_name', 'TodoList1')
            ->firstOrFail();

        $getList = http::get($taskList->list_url)
            ->json();

        foreach ($getList as $data) {
            $user = Tasks::firstOrCreate(array(
                    'list_id'       => $taskList->id ?? null,
                    'difficulty'    => $data['zorluk'] ?? null,
                    'duration'      => $data['sure'] ?? null,
                    'task_name'     => $data['id'] ?? null
                )
            );
        }

    }

    public function taskListTwo()
    {
        $taskList = TaskLists::where('list_name', 'TodoList2')
            ->firstOrFail();

        $getList = http::get($taskList->list_url)
            ->json();

        foreach ($getList as $data) {
            $task = key($data);

            $user = Tasks::firstOrCreate(array(
                    'list_id'       => $taskList->id ?? null,
                    'difficulty'    => $data[$task]['level'] ?? null,
                    'duration'      => $data[$task]['estimated_duration'] ?? null,
                    'task_name'     => $task
                )
            );
        }

    }
}
