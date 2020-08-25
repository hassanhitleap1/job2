<?php
namespace app\modules\api\traits;


trait ApiResponser{

    private  function successResponce($data,$message=''){
        $result=(count($data))? "1":"2";
        return response()->json(['result'=>$result,'message'=>$message,'data'=>$data]);
    }
    public  function successResponceWithNorusult($message='',$data=[]){
        return response()->json(['result'=>"1",'message'=>$message,'data'=>$data]);
    }

    protected function errorResponce($message,$data=null){
        return response()->json(['result'=>"0",'message'=>$message,'data'=>$data]);
    }

    public function showAll(Collection $collection,$message=''){
        return $this->successResponce($collection ,$message);
    }


    public function showAllNotiParent(Collection $collection,$message=''){
        return $this->successResponceNotiParent($collection ,$message);
    }

    private  function successResponceNotiParent($data,$message=''){
        $result=(count($data))? "1":"2";
        $noti=[];
        foreach ($data as $datum){
            $noti[]=$datum;
        }
        return response()->json(['result'=>$result,'message'=>$message,'data'=>$noti]);
    }

    public function showItem($item ,$message=''){
        $result=(!empty($item) && $item !=null)?"1":"0";
        return response()->json(['result'=>$result,'message'=>$message,'data'=>$item]);
    }


    public function showRusult($data,$message=''){
        return $this->successResponce($data, $message);
    }



}