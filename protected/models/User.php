<?php

namespace app\models;
use Dee;
class User
{
     
   public function __construct(){
	    $this->niw    = Dee::$app->niw; 
	   }
    
    
    public function getAll()
    {
        $sql = 'select * from users where niw ='. $this->niw;
        return \Dee::$app->db->queryAll($sql);
    }

    public function addNew($user)
    {
        $sql = 'insert into users(username,fullname) values (:username,:fullname)';
        return \Dee::$app->db->execute($sql,[
            ':username' => $user['username'], 
            ':fullname' => $user['fullname'],
        ]);
    }
    public function insert($user)
    {
        return \Dee::$app->db->insert('users', [
            'username' => 'mdmunir',
            'password' => md5($password),
            'company_id' => 1001,    
        ]);
    }
    public function update($id)
    {
        return \Dee::$app->db->update('users', ['password' => md5($password),], ['id' => 1]);
    }
    public function delete($id)
    {
        return \Dee::$app->db->delete('users', ['id' => 1]);
    }
}