<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table         = 'courses';
    protected $allowedFields = [
         'details', 'fees','duration'
    ];
    protected $primaryKey = 'course';
    protected $returnType  =  'array';
}