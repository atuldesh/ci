<?php
namespace App\Models;
use CodeIgniter\Model;

class FeesModel extends Model
{

    protected $table         = 'fees';
    protected $allowedFields = [
         'regno','fdate', 'amount','remark'
    ];
    protected $primaryKey = 'recno';
    protected $returnType  =  'array';
}
?>