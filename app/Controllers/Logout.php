<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\Users;
class Logout extends BaseController
{
    public $user;

        public function initController(
            RequestInterface $request,
            ResponseInterface $response,
            LoggerInterface $logger
        ) {
            parent::initController($request, $response, $logger);
                
        }
    public function index()
    {
        unset(
            $_SESSION['uname'],
            $_SESSION['role']
        );
        $user['uname'] = "Guest";
        $user['role'] = "G";
        if(isset($_SESSION['uname'])){
            $user['uname'] = $_SESSION['uname'];
            $user['role'] = $_SESSION['role'];
        }
        $data['header'] =  view('header',$user);
        $data['sshow'] =  view('sshow');
        $data['loginForm'] = view('loginForm');
        if(isset($_SESSION['role'])){
            $data['menu'] = view('menu',$thisuser);
        } else {
            $data['menu'] = "";
        }
        return view('homePage',$data);        
    }

}