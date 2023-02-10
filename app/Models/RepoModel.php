<?php
namespace App\Models;
use CodeIgniter\Model;

class RepoModel extends Model
{
    public function getBalance($pregno)
    {
        $db = db_connect();
        $sql = 'SELECT `fees`,`fees collected`,`balance` FROM `balrepo` WHERE `regno` = ?';
        $query = $db->query($sql, [$pregno]); 
        $row = $query->getRow(); 
        if (isset($row)) {
            return $row; 
        } else {
            return 0;
        }     
    }

}