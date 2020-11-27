<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Inetrvention_comment;
use App\Intervention;
use App\Progression;
use App\Project;
use App\Subtask;
use App\Task;
use App\TachePrioritie;
use App\Uploadfile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SubtaskController extends Controller
{

    public function create($id)
    {
        $from = 1;
        $users = User::where('role_id', 2)->get();
        $priorities = TachePrioritie::all();
        $task = Task::find($id);

        return view('back.subtask.create', [
            'users' => $users,
            'priorities' => $priorities,
            'task' => $task,
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

        $subtask = new Subtask();
        $subtask->title = $request->title;
        $subtask->priority_id = $request->priority_id;
        $subtask->user_id = $request->user_id;
        $subtask->description = $request->description;
        $subtask->task_id = $id;
        $subtask->status_id = 1;

        $subtask->offreS = $request->offreS;
        $subtask->offreP = $request->offreP;
        $subtask->estimationS = $request->estimationS;
        $subtask->prix = $request->prix;
        $subtask->estimationP = $request->estimationP;

        $subtask->save();

        $task = Task::find($subtask->task_id);
        $task->status_id = 4;
        $task->save();


        if ($request->hasFile('files')) {
            $file_array = $request->file('files');
            $array_len = count($file_array);
            foreach ($file_array as $file) {
                $name = $file->getClientOriginalName();
                $filename = time() . pathinfo($name, PATHINFO_FILENAME);
                $extension = pathinfo($name, PATHINFO_EXTENSION);

                $path = Storage::disk('public')->put('upload/project/task/subtask/' . $subtask->id, $file);

                $upload = new Uploadfile();
                $upload->url = $path;
                $upload->name = $filename . "." . $extension;
                $upload->subtask_id = $subtask->id;
                $upload->save();

            }
        }

        return redirect()->route('task.show', $id);
    }

    public function edit($id)
    {
        $from = 2;
        $users = User::where('role_id', 2)->get();
        $priorities = TachePrioritie::all();
        $subtask = Subtask::find($id);

        return view('back.subtask.create', [
            'users' => $users,
            'priorities' => $priorities,
            'subtask' => $subtask,
            'from' => $from,
        ]);
    }

    public function update(Request $request, $id)
    {
        //dd($request);
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

        $subtask = Subtask::find($id);
        $subtask->title = $request->title;
        $subtask->priority_id = $request->priority_id;
        $subtask->user_id = $request->user_id;
        $subtask->description = $request->description;

        $subtask->offreS = $request->offreS;
        $subtask->offreP = $request->offreP;
        $subtask->estimationS = $request->estimationS;
        $subtask->prix = $request->prix;
        $subtask->estimationP = $request->estimationP;
        $subtask->cout_realP = $request->cout_realP;

        $subtask->save();

        if ($request->hasFile('files')) {
            $file_array = $request->file('files');
            $array_len = count($file_array);
            foreach ($file_array as $file) {
                $name = $file->getClientOriginalName();
                $filename = time() . pathinfo($name, PATHINFO_FILENAME);
                $extension = pathinfo($name, PATHINFO_EXTENSION);

                $path = Storage::disk('public')->put('upload/project/task/subtask/' . $subtask->id, $file);

                $upload = new Uploadfile();
                $upload->url = $path;
                $upload->name = $filename . "." . $extension;
                $upload->subtask_id = $subtask->id;
                $upload->save();

            }
        }

        return redirect()->route('task.show', $subtask->task_id);
    }

    public function show($id)
    {
        $subtask = Subtask::find($id);
        $user = Auth::user();
        $uploads = Uploadfile::where('subtask_id', $subtask->id)->get();
        $comments = Inetrvention_comment::where('subtask_id', $id)->get();

        return view('back.subtask.show', [
            'subtask' => $subtask,
            'user' => $user,
            'comments' => $comments,
            'uploads' => $uploads,

        ]);
    }

    public function start($id)
    {
        $subtask = Subtask::find($id);
        $subtask->date_start = date('Y-m-d H:i:s');
        $subtask->status_id = 4;
        $subtask->save();


        return redirect()->route('subtask.show', ['id' => $id]);
    }

    public function stop(Request $request, $id)
    {
        $subtask = Subtask::find($id);
        $subtask->date_end = date('Y-m-d H:i:s');

        $begin = strtotime($subtask->date_start);
        $end = strtotime($subtask->date_end);

        if ($subtask->somme == null) {
            $subtask->somme = $end - $begin;
        } else {
            $subtask->somme = ($subtask->somme) + ($end - $begin);
        }

        $subtask->save();

        $comment = new Inetrvention_comment();
        $comment->subtask_id = $subtask->id;
        $comment->user_id = $request->user_id;
        $comment->comment = $request->comment;
        $comment->save();


        return redirect()->route('subtask.show', ['id' => $id]);
    }

    public function pause($id)
    {
        $subtask = Subtask::find($id);
        $subtask->date_end = date('Y-m-d H:i:s');

        $subtask->save();

        $subtask = Subtask::find($id);
        $begin = strtotime($subtask->date_start);
        $end = strtotime($subtask->date_end);

        if ($subtask->somme == null) {
            $subtask->somme = $end - $begin;
        } else {
            $subtask->somme = ($subtask->somme) + ($end - $begin);
        }
        $subtask->date_start = null;
        $subtask->date_end = null;
        $subtask->save();


        return redirect()->route('subtask.show', ['id' => $id]);
    }

    public function valider(Request $request, $id)
    {
        $subtask = Subtask::find($id);
        $subtask->status_id = 2;

        $subtask->save();

        $task = Task::find($subtask->task_id);
        if ($task->isallsubtaskclosed()) {
            $task->status_id = 2;
            $task->save();
        }

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
                        $message->to($emails)->subject('Terminer lu projet');
                    });
                }
            }
        }

        $comment = new Inetrvention_comment();
        $comment->subtask_id = $subtask->id;
        $comment->user_id = $request->user_id;
        $comment->comment = $request->comment;
        $comment->save();


        return redirect()->route('subtask.show', ['id' => $id]);
    }

    public function reopen(Request $request, $id)
    {
        $subtask = Subtask::find($id);
        $subtask->status_id = 3;
        $subtask->date_start = null;
        $subtask->date_end = null;
        $subtask->save();

        $task = Task::find($subtask->task_id);

        $task->status_id = 4;
        $task->save();


        $comment = new Inetrvention_comment();
        $comment->subtask_id = $subtask->id;
        $comment->user_id = $request->user_id;
        $comment->comment = $request->comment;
        $comment->save();


        return redirect()->route('subtask.show', ['id' => $id]);
    }
}
