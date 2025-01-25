<?php

namespace App\app\controllers;
use App\app\core\Controller;
use App\app\models\Task;
use App\app\core\Request;
use App\app\core\Response;

class TaskController extends Controller {

    private Task $task;

    public function __construct(Request $request, Response $response){
        parent::__construct($request, $response);
        $this->task = new Task();
    }

    // fetch and display all tasks
    public function index(){
        $tasks = $this->task->getAllTasks();
        $this->show("Task List: " . print_r($tasks, true));
    }

    // display the task creation form
    public function create() {
        $this->show("Create Task: <form method='POST' action='/tasks'><input type='text' name='name' placeholder='Task Name' required><textarea name='description' placeholder='Task Description'></textarea><button type='submit'>Create Task</button></form>");
    }

    // handle task creation
    public function store(){
        if($this->request->method() === 'POST'){
            $name = $this->request->input('name');
            $description = $this->request->input('description');

            // validate input
            if(empty($name)){
                $this->show("Task name cannot be empty");
                return;
            }

            // create the task
            $this->task->createTask([
                'name' => $name,
                'description' => $description
            ]);

            $this->redirect('/tasks');
        }
        
    }

    // Display the task edit form
    public function edit($id) {
        $task = $this->task->getTaskById($id);
        $this->show("Edit Task: <form method='POST' action='/tasks/{$id}'><input type='text' name='name' value='{$task['name']}' required><textarea name='description'>{$task['description']}</textarea><button type='submit'>Update Task</button></form>");
    }

    // handle task update
    public function update(int $id){
        if($this->request->method() === 'POST'){
            $name = $this->request->input('name');
            $description = $this->request->input('description');

            // validate input
            if(empty($name)){
                $this->show("Task cannot be empty");
                return;
            }

            // update tasks
            $this->task->updateTask($id, [
                'name' => $name,
                'description' => $description
            ]);
            $this->redirect('/tasks');
        }
    }

    // handle task deletion
    public function delete(int $id){
        echo '<pre>';
        echo var_dump($id);
        echo '</pre>';
        $this->task->deleteTask($id);
        $this->redirect('/tasks');
    }

    // mark a task as completed
    public function complete(int $id){
        $this->task->markAsCompleted($id);
    }
}