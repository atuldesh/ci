<?php
namespace App\Models;
use CodeIgniter\Model;

class StudentModel extends Model
{

    protected $table         = 'students';
    protected $allowedFields = [
         'sname','course', 'fees','admDate','bdate','address','phone','batch','password'
    ];
    protected $primaryKey = 'regno';
    protected $returnType  =  'array';
}
?>