<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Inetrvention_comment;
use App\Progression;
use App\Project;
use App\Subtask;
use App\Task;
use App\TachePrioritie;
use App\Uploadfile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::all();
        $user = Auth::user();

        return view('back.task.index', compact('tasks', 'user'));
    }

    public function create($id)
    {
        $from = 1;
        $users = User::where('role_id', 2)->get();
        $priorities = TachePrioritie::all();
        $project = Project::find($id);

        return view('back.task.create', [
            'users' => $users,
            'priorities' => $priorities,
            'project' => $project,
            'from' => $from,
        ]);
    }

    public function store(Request $request, $id)
    {
        $input_data = $request->all();

        $validator = Validator::make(
            $input_data, [
            'files.*' => 'mimes:jpg,jpeg,png,bmp,pdf|max:20000'
        ], [
                'files.*.mimes' => 'Juste jpeg,png ,bmp et pdf est autorisé',
                'files.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
            ]
        );

        if ($validator->fails()) {
            //dd('rttt');
            return redirect()->back()
                ->withErrors($validator);
        }

        //dd($request);
        $task = new Task();
        $task->title = $request->title;
        $task->priority_id = $request->priority_id;
        $task->user_id = $request->user_id;
        $task->description = $request->description;
        $task->project_id = $request->project_id;
        $task->status_id = 1;
        $task->save();

        if ($request->hasFile('files')) {
            $file_array = $request->file('files');

            foreach ($file_array as $file) {
                $name = $file->getClientOriginalName();
                $filename = time() . pathinfo($name, PATHINFO_FILENAME);
                $extension = pathinfo($name, PATHINFO_EXTENSION);

                //$filename=time().$file->getClientOriginalName();
                //$extension=$file->getClientOriginalExtension();

                $path = Storage::disk('public')->put('upload/project/task/' . $task->id, $file);

                $upload = new Uploadfile();
                $upload->url = $path;
                $upload->name = $filename . "." . $extension;
                $upload->task_id = $task->id;
                $upload->save();

            }
        }

        return redirect()->route('project.show', $id);
    }

    public function edit($id)
    {
        $from = 2;
        $users = User::where('role_id', 2)->get();
        $priorities = TachePrioritie::all();
        $task = Task::find($id);

        return view('back.task.create', [
            'users' => $users,
            'priorities' => $priorities,
            'task' => $task,
            'from' => $from,
        ]);
    }

    public function update(Request $request, $id)
    {

        $input_data = $request->all();

        $validator = Validator::make(
            $input_data, [
            'files.*' => 'mimes:jpg,jpeg,png,bmp,pdf|max:20000'
        ], [
                'files.*.mimes' => 'Juste jpeg,png ,bmp et pdf est autorisé',
                'files.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
            ]
        );

        if ($validator->fails()) {
            //dd('rttt');
            return redirect()->back()
                ->withErrors($validator);
        }
        //dd($request);
        $task = Task::find($id);
        $task->title = $request->title;
        $task->priority_id = $request->priority_id;
        $task->user_id = $request->user_id;
        $task->description = $request->description;
        $task->save();

        if ($request->hasFile('files')) {
            $file_array = $request->file('files');

            foreach ($file_array as $file) {
                $name = $file->getClientOriginalName();
                $filename = time() . pathinfo($name, PATHINFO_FILENAME);
                $extension = pathinfo($name, PATHINFO_EXTENSION);

                //$filename=time().$file->getClientOriginalName();
                //$extension=$file->getClientOriginalExtension();

                $path = Storage::disk('public')->put('upload/project/task/' . $task->id, $file);

                $upload = new Uploadfile();
                $upload->url = $path;
                $upload->name = $filename . "." . $extension;
                $upload->task_id = $task->id;
                $upload->save();

            }
        }

        return redirect()->route('project.show', $task->project_id);
    }

    public function show($id)
    {

        $task = Task::find($id);
        $subtasks = Subtask::where('task_id', $task->id)->get();
        $uploads = Uploadfile::where('task_id', $task->id)->get();
        $user = Auth::user();
        $comments = Inetrvention_comment::where('task_id', $id)->get();

        return view('back.task.show', [
            'task' => $task,
            'subtasks' => $subtasks,
            'user' => $user,
            'uploads' => $uploads,
            'comments' => $comments,

        ]);
    }

    public function start($id)
    {
        $task = Task::find($id);
        $task->date_start = date('Y-m-d H:i:s');
        $task->status_id = 4;
        $task->save();


        return redirect()->route('task.show', ['id' => $id]);
    }

    public function stop(Request $request, $id)
    {
        $task = Task::find($id);
        $task->date_end = date('Y-m-d H:i:s');

        $begin = strtotime($task->date_start);
        $end = strtotime($task->date_end);

        if ($task->somme == null) {
            $task->somme = $end - $begin;
        } else {
            $task->somme = ($task->somme) + ($end - $begin);
        }

        $task->save();

        $comment = new Inetrvention_comment();
        $comment->task_id = $task->id;
        $comment->user_id = $request->user_id;
        $comment->comment = $request->comment;
        $comment->save();


        return redirect()->route('task.show', ['id' => $id]);
    }

    public function pause($id)
    {
        $task = Task::find($id);
        $task->date_end = date('Y-m-d H:i:s');

        $task->save();

        $task = Task::find($id);
        $begin = strtotime($task->date_start);
        $end = strtotime($task->date_end);

        if ($task->somme == null) {
            $task->somme = $end - $begin;
        } else {
            $task->somme = ($task->somme) + ($end - $begin);
        }
        $task->date_start = null;
        $task->date_end = null;
        $task->save();


        return redirect()->route('task.show', ['id' => $id]);
    }

    public function valider(Request $request, $id)
    {
        $task = Task::find($id);
        $task->status_id = 2;

        $task->save();

        $project = Project::find($task->project_id);

        if ($project->progression() >= 30 && $project->progression() < 70) {

            $progress = Progression::where('project_id', $project->id)->where('pourcentage_id', 1)->first();
            if (!$progress) {
                $newprogress = new Progression();
                $newprogress->project_id = $project->id;
                $newprogress->pourcentage_id = 1;
                $newprogress->save();

                $user = User::where('role_id', 6)->first();
                $emails = $user->email;
                if ($emails) {
                    Mail::send('back.mails.email1', ['user' => $user, 'project' => $project], function ($message) use ($emails) {
                        $message->to($emails)->subject('En ATTEINT 30% du projet');
                    });
                }
            }
        }

        if ($project->progression() >= 70 && $project->progression() < 100) {
            $progress = Progression::where('project_id', $project->id)->where('pourcentage_id', 2)->first();
            if (!$progress) {
                $newprogress = new Progression();
                $newprogress->project_id = $project->id;
                $newprogress->pourcentage_id = 2;
                $newprogress->save();

                $user = User::where('role_id', 6)->first();
                $emails = $user->email;
                if ($emails) {
                    Mail::send('back.mails.email2', ['user' => $user, 'project' => $project], function ($message) use ($emails) {
                        $message->to($emails)->subject('En ATTEINT 70% du projet');
                    });
                }
            }
        }

        if ($project->progression() == 100) {
            $progress = Progression::where('project_id', $project->id)->where('pourcentage_id', 3)->first();
            if (!$progress) {
                $newprogress = new Progression();
                $newprogress->project_id = $project->id;
                $newprogress->pourcentage_id = 3;
                $newprogress->save();

                $user = User::where('role_id', 6)->first();
                $emails = $user->email;
                if ($emails) {
                    Mail::send('back.mails.email3', ['user' => $user, 'project' => $project], function ($message) use ($emails) {
                        $message->to($emails)->subject('Le Projet est Terminé');
                    });

                }
            }
        }

        $comment = new Inetrvention_comment();
        $comment->task_id = $task->id;
        $comment->user_id = $request->user_id;
        $comment->comment = $request->comment;
        $comment->save();


        return redirect()->route('task.show', ['id' => $id]);
    }


    public function reopen(Request $request, $id)
    {
        $task = Task::find($id);
        $task->status_id = 3;
        $task->date_start = null;
        $task->date_end = null;
        $task->save();

        $comment = new Inetrvention_comment();
        $comment->task_id = $task->id;
        $comment->user_id = $request->user_id;
        $comment->comment = $request->comment;
        $comment->save();


        return redirect()->route('task.show', ['id' => $id]);
    }
}
