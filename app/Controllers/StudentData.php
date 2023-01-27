<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\StudentModel;

class StudentData extends BaseController
{
    public function saveStudent()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
      //  print_r($data);return;
        $student = new \App\Entities\Student($data);
        $model = new StudentModel();
        $st = $model->save($student);
        echo $st;
    }
}