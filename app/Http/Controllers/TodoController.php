<?php

namespace App\Http\Controllers;

use App\Models\Developers;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class TodoController extends Controller
{
    public function index()
    {
        $task = array();

        // Task listesi
        $getTasks = Tasks::orderBy('difficulty', 'desc')
            ->orderBy('duration', 'desc')
            ->get();

        // Developer listesi
        $getDevelopers = Developers::orderByDesc('difficulty')
            ->get();


        $weekCount = 1;
        //Atanmamış iş olduğu sürece dön
        while ( count($getTasks) > 0 ) {

            $dev = array();

            foreach ($getDevelopers as $developer) {
                $dev = array_merge($dev, $this->assign($getTasks, $developer->difficulty, $developer->name,$weekCount));
            }

            $task[] = [
                'week' => $weekCount . ". Week",
                'developers' => $dev,
            ];

            $weekCount++;

            if (count($getTasks) == 0) {
                break;
            }

        }

        return view('v_todo', ['tasks' => $task]);

    }

    private function assign(&$list, $difficulty, $dev,$weekCount): array
    {
        // Atanan iş listesi
        $taskList = [];

        // Atanan süre
        $assignedDuration = 0;

        // Atanan iş adeti
        $assignedTastCount = 0;

        if ( count($list) == 0 ) {
            $taskList[$dev]['detail']['totalTasks'] = 0;
            $taskList[$dev]['detail']['totalHours'] = 0;
            $taskList[$dev]['planning'] = [];

        } else {
            foreach ($list as $key => $task) {

                // Dev in yapabileceği zorlukta olan tasklar için
                if ($task->difficulty <= $difficulty) {

                    $total = $assignedDuration + (int)$task['duration'];

                    // Atanan iş haftalık max çalışma süresinden fazla ise daha fazla iş atama
                    if ($total > 45) {
                        continue;
                    }

                    $assignedDuration += $task['duration'];

                    if ($assignedDuration <= 45) {
                        $assignedTastCount += 1;

                        $taskList[$dev]['detail']['totalHours'] = $assignedDuration;
                        $taskList[$dev]['detail']['totalTasks'] = $assignedTastCount;

                        $taskList[$dev]['planning'][] = array(
                            'name' => $task['task_name'],
                            'difficulty' => $task['difficulty'],
                            'duration' => $task['duration'],
                        );

                        unset($list[$key]);

                        // Atanan işin süresi max süreye eşit ise döngüden çık
                        if ($total == 45) {
                            break;
                        }

                    }
                }
            }
        }

        return $taskList;
    }
}
