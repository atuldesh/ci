<?php
namespace App\Models;
use CodeIgniter\Model;

class StudentModel extends Model
{

    protected $table         = 'students';
    protected $allowedFields = [
         'sname','course', 'fees','admDate','bdate','address','phone','batch','registered','password'
    ];
    protected $primaryKey = 'regno';
    protected $returnType  =  'array';

    function getResult($idata)
    {
 //       print_r($idata);
       $larray = array();
       $warray = array();
       $offset = ($idata['page']-1) * PER_PAGE; 
      if(strlen($idata['psname'])>0){
         $larray['sname'] = $idata['psname'];
       }
       if(strlen($idata['pcourse'])>0){
         $larray['course'] = $idata['pcourse'];
       }
       if(strlen($idata['padmDate']>0)){
         $warray['admDate>='] = $idata['padmDate'];
       }
       if($idata['pregistered']<>2){
         $warray['registered'] = $idata['pregistered'];
       }
       $bld = $this->builder();
       if(count($warray)>0) $bld->where($warray);
       if(count($larray)>0) $bld->like($larray);
       $bld->limit(PER_PAGE,$offset); 
    //   echo $bld->getCompiledSelect();
       $result['rows'] = $bld->get()->getResult();
//       print_r(count($result['rows']));
       $bld1 = $this->builder();
       if(count($warray)>0) $bld1->where($warray);
       if(count($larray)>0) $bld1->like($larray);  
       $result['count'] = $bld1->countAllResults(); 
 //      echo "~".$result['count'];   
        return $result;
      
    }

}
?>