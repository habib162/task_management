<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TaskController extends Controller
{

    public function index(){
        // query builder with one to one join
        $data =DB::table('tasks')->leftjoin('types','tasks.type_id','types.id')
            ->select('tasks.*','types.type_name','types.icon')->get();

           // return $data;
         $type=DB::table('types')->get();

         //return $type;
        return view('task_manager.index',compact('data','type'));

    }
 

    public function create(Request $request){
        
        $validated = $request->validate([
            'title' => 'required',
            'due_date' => 'required',
             'duration' => 'required',
             'time' => 'required',
        ]);

        $data = array();
        $data['title']=$request->title;
        $data['due_date']=$request->due_date;
        $data['duration']=$request->duration;
        $data['start_time']=$request->time;
        $data['type_id']=$request->type;

        DB::table('tasks')->insert($data);
        $notification = array('messege'=>"Task Inserted Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);
        

    }
       // delete method
    public function Destroy($id){
        $task=Task::find($id);
        $task->delete();

        $notification = array('messege'=>"  Deleted Successfully!",'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }


    public function edit($id){  
            $task = Task::find($id);
            $type=DB::table('types')->get();
            return view('task_manager.edit',compact('task','type'));
      
    }
    public function update(Request $request){
    
       
      // query builder
      $data = array();
      $data['title']=$request->title;
      $data['due_date']=$request->due_date;
      $data['duration']=$request->duration;
      $data['start_time']=$request->time;
      $data['type_id']=$request->type;
      
      

      DB::table('tasks')->where('id',$request->id)->update($data);
    
      $notification = array('messege'=>" Task Updated Successfully!",'alert-type'=>'success');
      return redirect()->back()->with($notification);
  }


  public function filter(Request $request){



    $date=$request->fiterdate;


    $data =DB::table('tasks')->leftjoin('types','tasks.type_id','types.id')
    ->select('tasks.*','types.type_name','types.icon')
    ->where('due_date',$date)
    ->get();

//return $data;
    $type=DB::table('types')->get();
    return view('task_manager.index',compact('data','type'));
       
  
}

}
