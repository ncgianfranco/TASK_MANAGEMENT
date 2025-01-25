<?php declare(strict_types=1);

namespace App\tests\models;
use App\app\models\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase {
    /**
     * @test
     */
    private Task $taskModel;

    public function setUp(): void {
        // initialize the task model
        $this->taskModel = new Task();
    }

    public function testCreateTask(){
        $data = ['name'=> 'Test task', 'description' => 'This is a test task'];
        $result = $this->taskModel->createTask($data);
        $this->assertTrue($result, "task model can acces database");
    }
    
    public function testGetTaskById() {
        $task = $this->taskModel->getTaskById(1);
        $this->assertTrue($task);
    }

    public function testUpdateTask() {
        $data = ['name' => 'Updated Task'];
        $result = $this->taskModel->updateTask(1, $data);
        $this->assertTrue($result);
    }

    public function testDeleteTask() {
        $result = $this->taskModel->deleteTask(1);
        $this->assertTrue($result);
    }

    public function tearDown(): void{
        // clean up resources after each test
        unset($this->taskModel);
    }
}