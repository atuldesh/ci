<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\Users;
use App\Models\CourseModel;
use App\Models\StudentModel;
class Instt extends BaseController
{
    protected $helpers = ['url', 'form'];                

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
    //    date_default_timezone_set('Asia/Kolkata');
    }

    public function index(int $id=0)
    {
     //   echo APPPATH;
        if($id==1){
            unset(
                $_SESSION['uname'],
                $_SESSION['role']
            );
        }
        return $this->showPage(0);
    }
    public function showPage(int $pflag=0)
    {
        $user['uname'] = "Guest";
        $user['role'] = "G";
        if(isset($_SESSION['uname'])){
            $user['uname'] = $_SESSION['uname'];
            $user['role'] = $_SESSION['role'];
        }
        $pages['header'] =  view('header',$user);
        if($pflag==0 || $user['role']=='G'){
            $pages['main'] =  view('sshow');
        }else if($pflag==1 && ($user['role'] == 'A' || $user['role']=='F')){
            $st = $this->getCourseList();
            $data['courseList'] = json_encode($st);
            $pages['main'] = view('studEntry',$data);
        }else if($pflag==2 && ($user['role'] == 'A' || $user['role']=='F')){
            $st = $this->getStudentsList();
            $data['studentsList'] = json_encode($st);
            $pages['main'] = view('feesEntry',$data);
        }else if($pflag==3 && ($user['role'] == 'A' || $user['role']=='F')){
            $st = $this->getStudentsList();
            $data['studentsList'] = json_encode($st);
            $data['repoNo'] = $pflag - 2;
            $pages['main'] = view('feesReports',$data);
        }else if($pflag>3 && ($user['role'] == 'A')){
            $data['repoNo'] = $pflag - 2;
            $pages['main'] = view('feesReports',$data);
        }
        

        $pages['loginForm'] = view('loginForm');
        
        if(isset($_SESSION['role'])){
            $pages['menu'] = view('menu',$user);
        } else {
            $pages['menu'] = "";
        }
         return view('homePage',$pages); 
    }
    public function chkLogin() 
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $model = new Users();
        $st = $model->find($data->lid);
        if(is_null($st)){
            $st['status'] = 1;
        } else if($st['password']===$data->pwd){
            $st['status'] = 0;
            $_SESSION['uname'] = $st['uname'];
            $_SESSION['role'] = $st['role'];
            $st['menu'] = view('menu',$_SESSION);
        } else {
            $st['status'] = 2;
        }
        echo json_encode($st);
    }
    public function getCourseList()
    {
        $model = new CourseModel();
        return json_encode($model->findAll());
       // print_r("A::".$t1);
     //   return t1;
    }
    public function getStudentsList()
    {
        $model = new studentModel();
        return json_encode($model->findAll());
    }

}
