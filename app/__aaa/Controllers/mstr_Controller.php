<?php
namespace App\__aaa\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\db;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Datatables;

// include str_replace("\\","/",base_path('app/__aaa/fungsi.php'));

class mstr_Controller extends Controller
{
    public $model; 
    public $tbl_view;   //pola file view
    public $tbl_Name; 
    public $tbl_File; 
    public $tbl_sql; 
    public $dir_view;   // pola director
    public $head;   
    public $file_db;  
    public $fillable; 
    public $primaryKey = '';
    public $scrollX = true;
    
    function __construct($tbl_sql='',$tbl_view='',$head='',$DirView='PATERN::',$tbl_url='',$tbl_File='')     
    {  
//      if (!empty(APP_TOKEN'])) $request->merge(['token' => APP_TOKEN']]);
      if (!empty($_GET['key'])) $_SESSION['key']=$_GET['key'];
      if (empty($tbl_url)) $tbl_url = strtolower(Str::afterLast(url()->current(), '/')); 
      if (empty($tbl_sql)) $tbl_sql=strtolower($tbl_url);
      if (empty($this->file_db)) {
         if (strpos($tbl_sql,'.')>0) 
            $this->file_db=$tbl_sql;
         else
            $this->file_db=$_SESSION['APP_PATERN'].'.'.$tbl_sql;
      }   
      if (empty($this->model)) $this->model=DB::table($this->file_db);
      if ($this->model instanceof \Illuminate\Database\Eloquent\Model) {
         if (empty($this->primaryKey)) $this->primaryKey=$this->model->getKeyName();
         if (empty($this->fillable)) $this->fillable=$this->getWritable();}
      else {
         if (empty($this->primaryKey)) $this->primaryKey=getKeys($this->file_db);
         if (empty($this->fillable)) $this->fillable=getFields($this->file_db);
      }
      if (empty($tbl_view)) $tbl_view=$tbl_url;
      if (strpos($tbl_view,'!:')>0) {
         $this->tbl_view = $tbl_view;
         $DirView=substr($tbl_view,0,strpos($tbl_view,':')+2);}
      else {
         $this->tbl_view = $DirView.$tbl_view;
      } 
      $this->head = empty($head)?$tbl_url:$head;
      $this->tbl_Name = $tbl_url;
      if (empty($tbl_File)) 
         $this->tbl_File = $DirView.$tbl_url; 
      else
         $this->tbl_File = $tbl_File;

    }

    protected function GetSelect() {
      if ($this->model instanceof \Illuminate\Database\Eloquent\Model) 
         return $this->model::select('*');
      else {
         if (get_class($this->model)=="Illuminate\Database\Query\Builder")
         return $this->model->get();
      } 
    }

    public function GetDataTable()
    {
      return datatables()
      ->of($this->GetSelect())
      ->make(true);
    }


    
    public function index() 
    {
      if (request()->ajax()) {
         return $this->GetDataTable();
      }
      if (substr_count($this->primaryKey,',')==0) {
         $ArrKey='"'.$this->primaryKey.'"';
         $Field=$this->primaryKey.':'.$this->primaryKey;
         $ArrField=$this->tbl_sql.'_data["'.$this->primaryKey.'"]';}
      else {
         $aa=explode(',',$this->primaryKey);
         $Field='';
         $ArrField='';
         $ArrKey='';
         foreach ($aa as $value) {
            $ArrKey.=(empty($ArrKey)?'':',').'"'.$value.'"';
            $Field.=(empty($Field)?'':',').$value.':'.$value;
            $ArrField.=(empty($ArrField)?'':',').$this->tbl_sql.'_data["'.$value.'"]';
         }
      }   
      return view($this->tbl_view.'_view',['head' => $this->head,
      'dir_view'=>$this->dir_view,'fillable'=>$this->fillable,'tbl_view'=>$this->tbl_view,
	   'IdKey'=>$this->primaryKey,'ArrKey'=>$ArrKey,'ViewName'=>$this->tbl_Name,
      'tbl_File'=>$this->tbl_File,'scrollX'=>$this->scrollX]); 
   }       

   public function GetRecords(Request $request,$field='',$fieldOut='',$json=false,$mdl=null)
   {
      if (empty($field) || $field=='~') {
         $ss=$field;
         $field='';
         if (!empty($this->primaryKey)) 
            $field = $this->primaryKey;
         else {
            if ($this->model instanceof \Illuminate\Database\Eloquent\Model) {
               $field=$this->model->getKeyName();           
               if (empty($field)) if (in_array('id', $this->model->fillable)) $field = 'id';}
            else {
               $field==getKeys($this->file_db);
               if (empty($field)) if (in_array('id', $this->fillable)) $field = 'id';
            }
         }
         if (empty($field)) return (!$json)?null:endResponse(412,'Kriteria Data yang akan dicari belum ditentukan, OK');
         if ($ss=='~') {
            if (substr_count($field,',')==0) 
               $field = '~'.$field;
            else {     
               $array=explode(",",$field);
               $field='';
               foreach ($array as $el) $field.=((empty($field))?'':',').'~'.$el;
            }         
         }
      }
      $Recs=GetRecs($request,(empty($mdl))?$this->model:$mdl,$field); 
      if (!$Recs) return (!$json)?null:sendResponse(404,'Kriteria Data yang dicari tidak ditemukan, OK');
      if (!$json && !empty($fieldOut)) $json=true;
      if ($json && empty($fieldOut)) $fieldOut=$this->fillable;
      return (!$json)?$Recs:sendResponse(200,'Data yang dicari telah ditemukan, OK',$Recs,$Recs->count(),$fieldOut);
   }


   public function destroy(Request $request)
   {
       try{
         $ss=$this->GetRecords($request);
         if (IsEmptyObj($ss)) return sendResponse(404,'Kriteria Data yang akan dihapus tidak ada, OK');
         DB::beginTransaction();
         $result = $ss->delete();
         DB::commit();
         return sendResponse(200,'Data telah dihapus, OK !!!',$ss,$result,implode(",",$this->fillable));}
      catch(\Exception $e){
          DB::rollback();
          return sendResponse(422,'Terjadi Error saat delete data, OK !!!','',$e);
      }
   }

   public function getWritable() {
      if (!isset($this->model)) return 0;
      switch (gettype($this->model)) {
      case "array":
         return (isset($this->fillable))?$this->fillable:0;
         break;
      case "object":
         if ($this->model instanceof \Illuminate\Database\Eloquent\Model) {
            if (!empty($this->model->fillable)) {
               return $this->model->fillable;}
            else {
               return collect(Schema::getColumnListing($this->model->getTable()))
               ->flip()->except($this->model->guarded)->keys()->toArray();
            }   
            break;
         }
      default:
         return 0;
      }
   }    

   public function is_exist(Request $request) {
      $field = $request->input('is_exist');
      $is_exist = false;
      if (!empty($field)) {
         $mess = 'Data Master Sudah ada !!!';
         if (substr_count($field,':')>0) {
            $mess = Str::afterLast($field, ':'); 
            $field = Str::beforeLast($field,':');
         }
         $is_exist = $this->GetRecords($request,$field,'',false,$this->file_db);
         if (IsEmptyObj($is_exist)) return '';
         if ($request->has('~DateAdd')) $is_exist->where('DateAdd','!=',$request->input('~DateAdd'));
         if (IsEmptyObj($is_exist)) return '';
         if ($request->has('~UserAdd')) $is_exist->where('UserAdd','!=',$request->input('~UserAdd'));
      }
      return (!IsEmptyObj($is_exist)?$mess:'');
   }

   public function store(Request $request,$fieldContent='') {
      try {
         foreach($this->fillable as $item) {
            $filled=$request->filled($item); 
            if ($filled) break;
         }
         if (!$filled) return sendResponse(422,'Anda belum mengisikan data, OK !!!');
         if ($request->has('is_exist') && $request->has('CekExist') && $request->input('CekExist')=='1') {
            $mess = $this->is_exist($request);
            if (!empty($mess)) return sendResponse(409,$mess);
         }
         if (! empty($fieldContent))
            $arr=Arr2Lower(explode(',',$fieldContent));
         else {
            if ($this->model instanceof \Illuminate\Database\Eloquent\Model) {
               if (!empty($this->fillable))
                  $arr = delArrValues($this->fillable, ['UserEdit', 'DateEdit'],false);
               else 
                  $ArrData = $request->only($this->getWritable());}
            else {
               if (!empty($this->fillable))
                  $arr = delArrValues($this->fillable, ['UserEdit', 'DateEdit'],false);
               else 
                  $arr = delArrValues(getFields($this->file_db), ['UserEdit', 'DateEdit'],false);
            } 
         }  
         IF (!isset($ArrData)) {
            $ArrData=array();
            date_default_timezone_set('Asia/Jakarta');
            $ArrData['DateAdd']=date("Y-m-d H:i:s");
            foreach ($arr as $value) {
               $aa=$request->input($value);
               if (!is_null($aa)) 
                  $ArrData[$value] = $aa;
               else {
                  if (isset($_SESSION[$value])) 
                  $ArrData[$value] = $_SESSION[$value];
               }
            }
         }
         DB::beginTransaction(); //start transaction
         if ($this->model instanceof \Illuminate\Database\Eloquent\Model) {
            if (in_array('id', $this->model->fillable)) $ArrData['id'] = $this->model->max('id')+1;
            $result = !$this->model->Create($ArrData)?0:1;} 
         else {
            if (in_array("id", $this->fillable)) $ArrData['id'] = DB::table($this->file_db)->max('id')+1;
            $result = DB::table($this->file_db)->insert([$ArrData]);
         }
         DB::commit();
         if (!$result) 
            return sendResponse(403,'Terjadi kesalahan saat tambah data, OK !!!',$ArrData,$result);   // Forbidden. The user is authenticated, but does not have the permissions to perform an action
         else {
            $ss='';
            $s='<a href="javascript:void(0)" data-toggle="tooltip" ';
            $ss.=$s.'class="btn btn-dark '.$this->tbl_sql.'_table_edit fa fa-pencil-square-o"></a> ';
            $ss.=$s.'class="btn btn-danger '.$this->tbl_sql.'_table_delete fa fa-trash"></a>';
            $ArrData+= ['action'=>$ss];
            return sendResponse(201,'Data sudah berhasil disimpan, OK',$ArrData,$result);   //201: Object created. Useful for the store actions.
         };}
      catch(Exception|Error $exception) { 
         DB::rollBack();
         return sendResponse(422,'Terjadi Error saat tambah data, OK !!!',$ArrData,$exception);
      } 
   }

   public function update(Request $request,$fieldContent='')
   {
      try {
         foreach($this->fillable as $item) {
            $filled=$request->filled($item); 
            if ($filled) break;
         }
         if (!$filled) return sendResponse(422,'Anda belum mengisikan data, OK !!!');
         /******** ISI DATA YG AKAN DIUPDATE */
         if (! empty($fieldContent))
            $arr=Arr2Lower(explode(',',$fieldContent));
         else {
            if ($this->model instanceof \Illuminate\Database\Eloquent\Model) 
               $ArrData = $request->only($this->getWritable());
            else {
               $arr = $this->fillable;
               if (empty($arr)) $arr =  getFields($this->file_db);
            } 
         }  
         if (!empty($arr)) {
            $arr = delArrValues($arr, ['UserAdd','DateAdd'],false);
     //       $arr = delArrValues($arr, explode(',',$this->primaryKey),false);   
         }
         IF (!isset($ArrData)) {
            $ArrData=array();
            $ArrData['UserEdit']=$_SESSION['UserAdd'];
            date_default_timezone_set('Asia/Jakarta');
            $ArrData['DateEdit']=date("Y-m-d H:i:s");
            foreach ($arr as $value) {
               $aa=$request->input($value);
               if (!is_null($aa)) 
                  $ArrData[$value] = $aa;
               else {
                  if (isset($_SESSION[$value])) 
                    $ArrData[$value] = $_SESSION[$value];
               }
            }
         }
         if ($request->has('is_exist') && $request->has('CekExist') && $request->input('CekExist')=='1') {
            $mess = $this->is_exist($request);
            if (!empty($mess)) return sendResponse(422,$mess);
         }
         DB::beginTransaction(); 
         if (IsEmptyObj($ss=$this->GetRecords($request,'~'))) return $ss;
         $result=$ss->update($ArrData);
         DB::commit();
         if (!$result) 
           return sendResponse(403,'Terjadi kesalahan saat update data, OK !!!');
         else {
           return sendResponse(202,'Proses simpan telah selesai/berhasil, OK',$ArrData,$result);}}
      catch(Exception|Error $exception) { 
         DB::rollBack();
         return sendResponse($exception,422,'Terjadi Error saat update data, OK !!!');
       } 
   }

}      
       
