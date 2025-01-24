<?php

namespace App\app\controllers;

use App\app\core\Controller;

class TaskController extends Controller {

    public function index(){
        $this->show("Task List: Here are all your Task");
    }

    public function create(){
        $this->show("Create Task: Add new Task");
    }

    public function store(){
        $this->show("Task created!");
        // Aqui implementaria el modelo
        $this->redirect('/tasks');
    }

    public function edit(int $id){
        $this->show("Edit Task: Editing task with ID $id");
    }

    public function update(int $id){
        $this->show("Task updated! Task with ID $id has been updated");
        // Aqui implementaria el modelo
        $this->redirect('/tasks');
    }

    public function delete(int $id){
        // Aqui implementaria el modelo para borrar
        $this->show("Task Deleted: Task with ID $id has been deleted");
        $this->redirect('/tasks');
    }
}