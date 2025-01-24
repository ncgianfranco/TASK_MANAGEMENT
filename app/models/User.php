<?php 

namespace App\app\models;

use App\app\core\Model;

class User extends Model {
    protected string $table = 'users';

    // Create a new user
    public function createUser(array $data){
        // hash the password before saving
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->create($this->table, $data);
    }
    // Find a user by email
    public function findByEmail(string $email){
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }
    // Verify user  credentials
    public function verifyCredentials(string $email, string $password){
        $user = $this->findByEmail($email);
        if($user && password_verify($password, $user['password'])){
            return $user;
        }
        return false;
    }

}