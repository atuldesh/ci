<?php
namespace App\Models;
use CodeIgniter\Model;

class StudentFeesModel extends Model
{

    protected $table         = 'studentfees';
    protected $allowedFields = [
         'sname','admDate', 'paidFees'
    ];
    protected $primaryKey = 'regno';
    protected $returnType  =  'array';

 }
?>