<?php

namespace App\Controllers;
use App\Models\progModel;
class Programs extends BaseController
{
    public function getPrograms()
    {
        $model = new ProgModel();      
        $prog = $model->findAll();
        echo json_encode($prog);   
    }
}