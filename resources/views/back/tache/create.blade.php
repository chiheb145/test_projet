@extends('back.layouts.app')

@section('content')
    <div class="page-wrapper">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row mt-2">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <h4 class="titre">Ajouter une tache</h4>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        @if($from==1)

                            <form action="{{route('tache.store')}}" method="post" class="form-horizontal">
                                @csrf
                                <div class="card-body">

                                    <div class="row form-group">
                                        <label for="inputUser" class="col-sm-0 control-label text-right">Titre</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="title"
                                                   placeholder="Saisir le titre du tache" required>
                                        </div>

                                        <label for="inputUser" class="col-sm-2 control-label text-right">Priorité</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="priority_id">
                                                @foreach($priorities as $priorit)
                                                    <option value="{{$priorit->id}}">{{$priorit->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    @if(Auth::user()->role_id==1 || Auth::user()->role_id==3 || Auth::user()->role_id==5)


                                        <div class="row form-group">
                                            <label for="inputUser" class="col-sm-0 control-label text-right">Client</label>
                                            <div class="col-sm-4">
                                                <select class="form-control" id="" name="created_by">
                                                    @foreach($clients as $client)
                                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                        </div>

                                    @else
                                    <input type="hidden" name="created_by" value="{{Auth::user()->id}}">

                                    @endif

                                    <div class="form-group">
                                        <label class="col-sm-12 control-label">Description</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" rows="3" placeholder="Entrer ..."
                                                      name="contenu" required></textarea>
                                        </div>
                                    </div>


                                </div>

                                    <div class="card-body">
                                        <a href="{{route('tache.index')}}" class="btn btn-primary float-right m-1">Annuler</a>
                                        <button type="submit" class="btn btn-primary float-right m-1">Sauvegarder
                                        </button>

                                    </div>

                            </form>
                        @elseif($from==2)

                            <form action="{{route('tache.update',$tache->id)}}" method="post" class="form-horizontal">
                                @csrf

                                <div class="card-header">
                                    <h4 class="card-title">Modifier tache</h4>
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="inputUser" class="col-sm-12 control-label">Titre</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="title"
                                                   placeholder="Saisir le titre du tache" value="{{$tache->title}}"
                                                   required>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="inputUser" class="col-sm-12 control-label">Prioriter</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" name="priority_id">
                                                @foreach($priorities as $priorit)
                                                    <option value="{{$priorit->id}}"
                                                            @if($priorit->id == $tache->priority_id) selected @endif>{{$priorit->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputUser" class="col-sm-12 control-label">Client</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" id="" name="created_by">
                                                @foreach($clients as $client)
                                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-12 control-label">Description</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" rows="7" placeholder="Entrer ..."
                                                      name="contenu" required>{{$tache->content}}</textarea>
                                        </div>
                                    </div>

                                </div>

                                    <div class="card-body">
                                        <a href="{{route('tache.index')}}" class="btn btn-primary float-right m-1">Annuler</a>
                                        <button type="submit" class="btn btn-primary float-right m-1">Sauvegarder
                                        </button>

                                    </div>

                            </form>
                        @endif


                    </div>
                </div>
            </div>
        </div>


    </div>



@endsection
@section('javascript')
@endsection

