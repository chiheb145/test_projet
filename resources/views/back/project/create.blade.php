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
                            <h4 class="titre">Ajouter un Projet</h4>
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

                            <form action="{{route('project.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="row form-group">
                                        <label for="inputUser" class="col-sm-2 control-label text-right">Titre</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control"  name="title"
                                                   placeholder="Saisir le titre du tache" required>
                                        </div>
                                        <label for="inputUser" class="col-sm-2 control-label text-right">Client</label>
                                        <div class="col-sm-3">
                                            <select class="form-control" name="client_id">
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row form-group">
                                        <label for="inputUser" class="col-sm-2 control-label text-right">Offre Service</label>
                                        <div class="col-sm-3">
                                            <input type="number" step="1" class="form-control" name="offreS" required>
                                        </div>

                                        <label for="inputUser" class="col-sm-2 control-label text-right">Estimation du Temps</label>
                                        <div class="col-sm-3">
                                            <input type="number" step="1" class="form-control" name="estimationS" required>
                                        </div>

                                    </div>

                                    <div class="row form-group">
                                        <label for="inputUser" class="col-sm-2 control-label text-right">Offre Produit</label>
                                        <div class="col-sm-3">
                                            <input type="number" step="1" class="form-control" name="offreP" required>
                                        </div>

                                        <label for="inputUser" class="col-sm-2 control-label text-right">Estimation Produit</label>
                                        <div class="col-sm-3">
                                            <input type="number" step="1" class="form-control" name="estimationP" required>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <label class="col-sm-12 control-label">Description</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" rows="5" placeholder="Entrer ..." name="description" required></textarea>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <label class="col-sm-12 control-label">Ajouter des fichiers (peut en joindre plusieurs):</label>
                                        <div class="col-sm-4">
                                            <input multiple="multiple" name="files[]" type="file" class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <div class="border-top">
                                    <div class="card-body">

                                        <a href="{{route('project.index')}}" class="btn btn-primary float-right m-1">Annuler</a>
                                        <button type="submit" class="btn btn-primary float-right m-1">Sauvegarder
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @elseif($from==2)

                            <form action="{{route('project.update',$project->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h4 class="card-title">Modifier le projet</h4>
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="inputUser" class="col-sm-12 control-label">Titre</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control"  name="title"
                                                   placeholder="Saisir le titre du tache" value="{{$project->name}}" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputUser" class="col-sm-12 control-label">Client</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" name="client_id">
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}" @if($user->id == $project->client_id) selected @endif>{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <label for="inputUser" class="col-sm-2 control-label text-right">Offre Service</label>
                                        <div class="col-sm-3">
                                            <input type="number" step="1" class="form-control" name="offreS" value="{{$project->offreS}}" required>
                                        </div>

                                        <label for="inputUser" class="col-sm-2 control-label text-right">Estimation du Temps</label>
                                        <div class="col-sm-3">
                                            <input type="text"  class="form-control" name="estimationS" value="{{$project->estimationS}}" required>
                                        </div>

                                    </div>

                                    <div class="row form-group">
                                        <label for="inputUser" class="col-sm-2 control-label text-right">Offre Produit</label>
                                        <div class="col-sm-3">
                                            <input type="number" step="1" class="form-control" name="offreP" value="{{$project->offreP}}" required>
                                        </div>

                                        <label for="inputUser" class="col-sm-2 control-label text-right">Estimation Produit</label>
                                        <div class="col-sm-3">
                                            <input type="number" step="1" class="form-control" name="estimationP" value="{{$project->estimationP}}" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-12 control-label">Description</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" rows="5"  name="description" required>{{$project->description}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <label class="col-sm-12 control-label">Ajouter des fichiers (peut en joindre plusieurs):</label>
                                        <div class="col-sm-4">
                                            <input multiple="multiple" name="files[]" type="file" class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary float-right m-1">Sauvegarder
                                        </button>
                                        <a href="{{route('project.index')}}" class="btn btn-primary float-right m-1">Annuler</a>
                                    </div>
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

