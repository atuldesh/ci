<?php
namespace App\Models;
use CodeIgniter\Model;

class ReceiptListModel extends Model
{

    protected $table         = 'feeslist';
    protected $allowedFields = [
         'regno','sname','fdate', 'amount','remark','course'
    ];
    protected $primaryKey = 'recno';
    protected $returnType  =  'array';

 }
?>