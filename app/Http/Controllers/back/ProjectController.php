<?php
namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Project;
use App\Task;
use App\Uploadfile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{

    public function index()
    {
        $user=Auth::user();
        $projects = Project::all() ;
        return view('back.project.index',compact('projects','user'));
    }

    public function create()
    {
        $from = 1;
        $users=User::where('role_id',4)->get();

        return view('back.project.create', [
            'users' => $users,
            'from' => $from,
        ]);
    }

    public function store(Request $request)
    {
        $input_data = $request->all();

        $validator = Validator::make(
            $input_data, [
            'files.*' => 'mimes:jpg,jpeg,png,bmp,pdf|max:20000'
        ],[
                'files.*.mimes' => 'Juste jpeg,png ,bmp et pdf est autorisé',
                'files.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
            ]
        );

        if ($validator->fails()) {
            //dd('rttt');
            return redirect()->back()
                ->withErrors($validator);
        }

        $project = new Project();
        $project->name = $request->title;
        $project->client_id = $request->client_id;
        $project->description = $request->description;

        $project->offreS = $request->offreS;
        $project->offreP = $request->offreP;
        $project->estimationS = $request->estimationS;
        $project->estimationP = $request->estimationP;

        $project->save();

        if ($request->hasFile('files')) {
            $file_array=$request->file('files');
            $array_len=count($file_array);
            foreach ($file_array as $file) {

                $name=$file->getClientOriginalName();
                $filename = time().pathinfo($name, PATHINFO_FILENAME);
                $extension = pathinfo($name, PATHINFO_EXTENSION);

                $path=Storage::disk('public')->put('upload/project/'.$project->id, $file);

                $upload = new Uploadfile();
                $upload->url = $path;
                $upload->name = $filename.".".$extension;
                $upload->project_id = $project->id;
                $upload->save();

            }
        }

        return redirect()->route('project.index');
    }

    public function edit($id)
    {
        $from = 2;
        $project = Project::find($id);
        $users=User::where('role_id',4)->get();
        return view('back.project.create', compact('from', 'project','users'));
    }

    public function update(Request $request ,$id)
    {

        $input_data = $request->all();

        $validator = Validator::make(
            $input_data, [
            'files.*' => 'mimes:jpg,jpeg,png,bmp,pdf|max:20000'
        ],[
                'files.*.mimes' => 'Juste jpeg,png ,bmp et pdf est autorisé',
                'files.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
            ]
        );

        if ($validator->fails()) {
            //dd('rttt');
            return redirect()->back()
                ->withErrors($validator);
        }

        $project = Project::find($id);
        $project->name = $request->title;
        $project->client_id = $request->client_id;
        $project->description = $request->description;

        $project->offreS = $request->offreS;
        $project->offreP = $request->offreP;
        $project->estimationS = $request->estimationS;
        $project->estimationP = $request->estimationP;

        $project->save();

        if ($request->hasFile('files')) {
            $file_array=$request->file('files');
            $array_len=count($file_array);
            foreach ($file_array as $file) {
                $name=$file->getClientOriginalName();
                $filename = time().pathinfo($name, PATHINFO_FILENAME);
                $extension = pathinfo($name, PATHINFO_EXTENSION);

                //$filename=time().$file->getClientOriginalName();
                //$extension=$file->getClientOriginalExtension();

                $path=Storage::disk('public')->put('upload/project/'.$project->id, $file);

                $upload = new Uploadfile();
                $upload->url = $path;
                $upload->name = $filename.".".$extension;
                $upload->project_id = $project->id;
                $upload->save();

            }
        }

        return redirect()->route('project.index');
    }

    public function show($id)
    {
        $uploads=Uploadfile::where('project_id',$id)->get();
        $project = Project::find($id);
        $user=Auth::user();
        $tasks=Task::where('project_id',$project->id)->get();

        return view('back.project.show', compact( 'project','user','tasks','uploads'));
    }
}
