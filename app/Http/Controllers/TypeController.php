<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
class TypeController extends Controller
{
    public function index(){

        $type=DB::table('types')->get();        
        return view('type.index',compact('type'));
    }

    public function create(Request $request){
        $validated = $request->validate([
            'type_name' => 'required|max:25',
            'icon' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        // Sql query
        $slug=Str::slug($request->type_name, '-');
        $data =array();
        $data['type_name']=$request->type_name;

        $icon = $request->icon;
        $icon_name = $slug.'.'.$icon->getClientOriginalExtension();
        $destinationfile = 'Files/icon/';
        Image::make($icon)->resize(128,128)->save($destinationfile.$icon_name); // image intervention
        $data['icon']=$destinationfile.$icon_name;

        DB::table('types')->insert($data);

        $notification = array('messege'=>" Type Inserted Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function Destroy($id){
        $data = DB::table('types')->where('id',$id)->first();
        $icon = $data->icon;
        if(File::exists($icon)){
            unlink($icon);
        }
        DB::table('types')->where('id',$id)->delete();

        $notification = array('messege'=>" Type Deleted Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
    public function edit($id){
        $type=DB::table('types')->where('id',$id)->first();
        return view('type.edit',compact('type'));
       
    }
    // update method
    public function update(Request $request){
     
        $slug=Str::slug($request->type_name, '-');
        $data=array();
        $data['type_name']=$request->type_name;
        
        if($request->icon){
            if(File::exists($request->old_icon)){
                unlink($request->old_icon);
            }
            $icon = $request->icon;
            $photoname = $slug.'.'.$icon->getClientOriginalExtension();
            $destinationfile = 'Files/icon/';
            Image::make($icon)->resize(128,128)->save($destinationfile.$photoname); // image intervention
            $data['icon']=$destinationfile.$photoname;
            DB::table('types')->where('id',$request->id)->update($data);
            
            $notification = array('messege'=>" Type updated Successfully!",'alert-type'=>'success');
            return redirect()->back()->with($notification);

        }else{
            $data['icon']=$request->old_icon;
            DB::table('types')->where('id',$request->id)->update($data);

            $notification = array('messege'=>" Type updated Successfully!",'alert-type'=>'success');
            return redirect()->back()->with($notification);
        }
        
    }

}
