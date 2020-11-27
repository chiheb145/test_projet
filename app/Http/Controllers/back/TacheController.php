<?php

namespace App\Http\Controllers\back;


use App\Http\Controllers\Controller;
use App\Role;
use App\Tache;
use App\TachePrioritie;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Validator;
use Image;

class TacheController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if ($user->role_id == 1 || $user->role_id == 3 || $user->role_id == 5 || $user->role_id == 6) {

            $taches = Tache::orderBy('id', 'desc')->get();
        }
        elseif($user->role_id == 4){
            $taches = $user->tacheClient()->get();
        }

        return view('back.tache.index', [
            'taches' => $taches,
            'user' => $user,
        ]);
    }


    public function create()
    {
        $priorities = TachePrioritie::orderBy('id', 'asc')->get();
        $from = 1;
        $clients = User::where('role_id', 4)->get();

        return view('back.tache.create', [
            'priorities' => $priorities,
            'from' => $from,
            'clients' => $clients,
        ]);

    }


    public function store(Request $request)
    {
        //dd($request);
        $tache = new Tache();
        $tache->title = $request->title;
        $tache->content = $request->contenu;
        $tache->created_by = $request->created_by;
        $tache->priority_id = $request->priority_id;
        $tache->status_id = 1;
        $tache->save();

        return redirect()->route('tache.index');
    }

    public function edit($id)
    {
        $from = 2;
        $tache = Tache::find($id);
        $priorities = TachePrioritie::orderBy('id', 'asc')->get();
        $clients = User::where('role_id', 4)->get();

        return view('back.tache.create', compact('from', 'tache', 'priorities','clients'));
    }


    public function update(Request $request, $id)
    {
        $tache = Tache::find($id);
        $tache->title = $request->title;
        $tache->content = $request->contenu;
        $tache->priority_id = $request->priority_id;
        $tache->created_by = $request->created_by;

        $tache->save();

        return redirect()->route('tache.index');
    }

    public function show($id)
    {
        $tache =Tache::find($id);

        return view('back.tache.show', compact('from', 'tache'));
    }

    public function valider($id)
    {
        $tache = Tache::find($id);
        $tache->status_id = 2;
        $tache->save();

        return redirect()->route('tache.index');
    }

    public function reopen($id)
    {
        $tache = Ticket::find($id);
        $reopen=$tache->reopen;
        $tache->status_id = 3;
        $tache->reopen = $reopen + 1;
        $tache->save();

        return redirect()->route('tache.index');
    }




}
