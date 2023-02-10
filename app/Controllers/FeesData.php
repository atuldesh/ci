<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\FeesModel;
use App\Models\RepoModel;
use App\Models\ReceiptListModel;

class FeesData extends BaseController
{
    public function saveReceipt()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
      //  print_r($data);return;
        $receipt = new \App\Entities\Receipt($data);
        $model = new FeesModel();
        if(intval($data['recno'])==0)
            $st = $model->insert($receipt);
        else
            $st = $model->update($data['recno'],$data);
        echo $st;
    }
    public function getReceipt()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
 //       print_r($data);return;
        $model = new ReceiptListModel();
        $st = $model->find($data->recno);
        echo json_encode($st);

    }
    public function delReceipt()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
    //    print_r($data);return;
        $model = new FeesModel();
        if($model->delete($data->recno))
            echo "Deleted";

    }
    public function listReceipts()
    {

      $pager = \Config\Services::pager();
      $model = new ReceiptListModel();

      $json = file_get_contents('php://input');
      $idata = json_decode($json,true);
//      print_r($idata['perPage']);return;
      $data = [
        'perPage'=>$idata['perPage'],
        'total' => $model->countAll(),
        'receipts' => $model->paginate($idata['perPage'],"g1",$idata['page']),
    ];
    return view('receiptsList',$data);  
    }
    public function getBalance()
    {
        $json = file_get_contents('php://input');
        $idata = json_decode($json);
        $model = new RepoModel();
        echo json_encode($model->getBalance($idata->regno));
    }
    public function getFeesReport()
    {
        $json = file_get_contents('php://input');
        $idata = json_decode($json,true);
        $model = new ReceiptListModel();
        $cond=array();
        if($idata['repoNo']==1){
            $cond['regno'] = $idata['regNo'];
        } else if($idata['repoNo']==2){
            $cond['fdate >='] = $idata['sdate'];
            $cond['fdate <='] = $idata['edate'];
        }
    //    $data['sum'] = $result['sumQuantities'];
        $result = $model->where($cond)->select('sum(amount) as totAmt')->first();
        $data = [
            'repoNo'=>$idata['repoNo'],
            'perPage'=>$idata['perPage'],
            'totAmt' => $result['totAmt'],
            'total' => $model->where($cond)->countAllResults(),
            'receipts' => $model->where($cond)->paginate($idata['perPage'],"g1",$idata['page']),
        ];            
         return view('receiptsList',$data);  
    }
}
