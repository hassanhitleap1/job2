<?php
namespace app\modules\traits;


trait ApiResponser{

    protected  function errors_responce($data,$message=''){
        return ['code'=>501,'message'=>$message,'data'=>$data];
    }

    protected  function success_responce($data,$message=''){
        return ['code'=>201,'message'=>$message,'data'=>$data];
    }


}