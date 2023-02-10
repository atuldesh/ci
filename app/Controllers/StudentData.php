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
        echo $model->getInsertId();
    }
    public function getStudent()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
    //    print_r($data);return;
        $model = new StudentModel();
        $st = $model->find($data->regno);
        echo json_encode($st);

    }
    public function delStudent()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
    //    print_r($data);return;
        $model = new StudentModel();
        if($model->delete($data->regno))
            echo "Deleted";

    }
    public function listStudents()
    {

      $pager = \Config\Services::pager();
      $model = new StudentModel();

      $json = file_get_contents('php://input');
      $idata = json_decode($json,true);
//      print_r($idata['perPage']);return;
      $data = [
        'perPage'=>$idata['perPage'],
        'total' => $model->countAll(),
        'students' => $model->paginate($idata['perPage'],"g1",$idata['page']),
        'pager' => $model->pager,
    ];
    return view('studentsList',$data);  
    }
}