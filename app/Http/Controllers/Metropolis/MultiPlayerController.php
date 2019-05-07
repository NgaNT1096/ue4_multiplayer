<?php

namespace App\Http\Controllers\Metropolis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Metropolis\model3d;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class MultiPlayerController extends Controller
{

    public function getLinkModel(){
        return view('admin/metropolis/addNewModel3d');
    }
    public function addNewModel(Request $request){

              $validator = Validator::make($request->all(), [
               'name' => 'required|string|max:255|unique:model3ds',
               'image' => 'required|image',
               'type' => 'required',
               'link_model' =>'required'
               
             ]);
    
    
             if ($validator->fails()) {
                   return redirect('admin/metropolis/them')->withErrors($validator);   
             }else {
    
                // neu chon loai product
              
                  //neu file duoc upload
               if ($request->file('link_model')->isValid() && $request->file('image')->isValid()) {
                  //file  co thuc bat dau doi ten va move
                  $fileExtension = $request->file('link_model')->getClientOriginalExtension(); // Lấy . của file
                  $fileName = $request->file('link_model')->getClientOriginalName('link_model');
                  $fileSize = $request->file('link_model')->getSize();
                  $mine = $request->file('link_model')->getMimeType();

                //image 
                  $img_fileExtension = $request->file('image')->getClientOriginalExtension(); 
                  $img_fileName = $request->file('image')->getClientOriginalName('image');

                  $uploadPath = public_path('/upload/model3d'); // Thư mục upload model 3d
                  $img_uploadPath = public_path('/upload/image'); // Thư mục upload image preview

                // Bắt đầu chuyển file vào thư mục
                  $request->file('link_model')->move($uploadPath, $fileName);
                  $request->file('image')->move($img_uploadPath, $img_fileName);

                  $model = new model3d;
                  $model->name = $request->input('name');
                  $model->type = $request->input('type');
                  $model->image = '/upload/image/' .$img_fileName ;
                  $model->link_model = '/upload/model3d/' .$fileName ;
    
                  $model->save();
                  return redirect('admin/metropolis/them')->with('thongbao','them thanh cong');
              }
             }
    
    }
    public function list(){
        $models = model3d::all();
        return view('admin/metropolis/getAllModel3d',compact('models'));
    }
    public function api_listModel(){
        $models = model3d::all();  
        foreach($models as $model){
            $model->download_model = 'api/admin/metropolis/model3d/download/' .$model->id ;
            $model->download_image = 'api/admin/metropolis/img/download/' .$model->id ;
        }
        $response = [
            'message' => 'List of all model 3d',
            'content' => $models
        ];

        return response()->json($models, 200);
    }
    public function urldownload($id){
        $model = model3d::find($id);
        $file = public_path() ."/" .$model->link_model ;

        return response()->download($file);
    }
    public function getdownload()
    {
        $models = DB::table('model3ds')->select('id','name')->get();
        foreach ($models as $model) {
            $model->link = [
                'href' => 'api/admin/metropolis/model3d/download/' .$model->id
            ];
        }
        
        $response = [
            'message' => 'List of all models',
            'content' => $models
        ];

        return response()->json($response, 200);
    }
    // image
    public function urlImagePre($id)
    {
        $model = model3d::find($id);
        $fileImg = public_path() ."/" . $model->image ;

        return response()->download($fileImg);
    }
    public function query(){
        $data = DB::table('model3ds')->count();
        echo $data;
    }
    public function downloadtemp()
    {
        $model = model3d::find(1);
        $fileName = public_path() . $model->link_model ;
        return response()->download($fileName);
    }
}
