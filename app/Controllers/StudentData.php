<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\StudentModel;
use App\Models\StudentFeesModel;

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
      $array = array();
     if(strlen($idata['psname'])>0){
        $array['sname'] = $idata['psname'];
      }
      if(strlen($idata['pcourse'])>0){
        $array['course'] = $idata['pcourse'];
      }   
    //  print_r($idata);exit();   
      $data = [
        'perPage'=> PER_PAGE,
         'psname'  => $idata['psname'],
        'pcourse' => $idata['pcourse'],
        'curPage' => $idata['page']
      ];
    if(count($array)>0){
            $data['students'] = $model->like($array)->paginate($idata['perPage'],"g1",$idata['page']);
            $data['total'] =  $model->like($array)->countAllResults();

    } else {
            $data['students'] = $model->paginate($idata['perPage'],"g1",$idata['page']);
            $data['total'] =  $model->countAll();

    }
 //   print_r($data);
    return view('studentsList',$data);  
    
    }
    public function getStudFees()
    {
        $json = file_get_contents('php://input');
        $idata = json_decode($json,true);
        $model = new StudentFeesModel();
        $cond=array();
        $offset = ($idata['page']-1) * PER_PAGE;

        $cond['admDate >='] = $idata['adate'];
        $cond['paidFees >='] = $idata['lamt'];
        if( intval($idata['uamt'])>0){
          $cond['paidFees <='] = $idata['uamt'];
        }
        $data = [
            'perPage'=> PER_PAGE,    
            'curPage' => $idata['page'],
            'total' => $model->where($cond)->countAllResults(),
            'recs' => $model->where($cond)->paginate(PER_PAGE,"g1",$idata['page'],$offset)
        ];
        return view('studentWiseFeesList',$data);

        }
    }    
