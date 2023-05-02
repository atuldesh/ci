<?php

namespace App\Models;

use CodeIgniter\Model;

class progModel extends Model
{
    protected $table         = 'program';
    protected $allowedFields = [
         'problem','language', 'category','level','solution','explaination'
    ];
    protected $primaryKey = 'id';
    protected $returnType  =  'array';
}