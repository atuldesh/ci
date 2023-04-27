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
    public function updateStudRegStatus()
    {
      $json = file_get_contents('php://input');
      $data = json_decode($json,true);
  //    print_r($data);return;
      $model = new StudentModel();
      if(count($data['on'])>0){
        $model->whereIn('regno',$data['on'])->set(['registered'=>1])->update();
      }
      if(count($data['off'])>0){
        $model->whereIn('regno',$data['off'])->set(['registered'=>0])->update();
      }
      echo "Updated";
    }
    public function listStudents()
    {

      $pager = \Config\Services::pager();
      $model = new StudentModel();

      $json = file_get_contents('php://input');
      $idata = json_decode($json,true);

    //  print_r($idata);exit();   
      $data = [
        'perPage'=> PER_PAGE,
         'psname'  => $idata['psname'],
        'pcourse' => $idata['pcourse'],
        'padmDate' => $idata['padmDate'],
        'pregistered' => $idata['pregistered'],
        'curPage' => $idata['page']
      ];
      $result = $model->getResult($idata);
      $data['students'] = $result['rows'];
      $data['total'] =  $result['count'];
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
