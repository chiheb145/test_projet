@extends('back.layouts.app')

@section('content')



    <div class="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <h4 class="titre">Gestion du Projet : {{$project->name}}</h4>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <br>
        <br>

        <div class="row mt-1">
            <div class="col-lg-12 ">
                <a class="btn btn-primary float-right m-2" href="{{route('project.index')}}">Retour</a>
                @if($user->role_id ==1 || $user->role_id ==3 ||$user->role_id ==5)
                    <a class="btn btn-primary float-right m-2" href="{{route('task.create',$project->id)}}">Ajouter une
                        Tâche</a>
                @endif
            </div>
        </div>

        @if($user->role_id ==1 || $user->role_id ==3 ||$user->role_id ==5 )

            <div class="row"><h2 class="ml-3">Service</h2></div>

            <div class="row">
                <div class="col-sm-12 col-md-2 offset-md-1">
                    <div class="info-box bg-white">
                        <div class="info-box-content">
                            <span class="info-box-text text-center ">Estimation du Temps</span>
                            <span
                                class="info-box-number text-center mb-0">{{$project->estimationS}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="info-box bg-white">
                        <div class="info-box-content">
                            <span class="info-box-text text-center ">Côut Réel (DT)</span>
                            <span class="info-box-number text-center  mb-0">0</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="info-box bg-white">
                        <div class="info-box-content">
                            <span class="info-box-text text-center ">Ecarts (DT)</span>
                            <span
                                class="info-box-number text-center  mb-0">0</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="info-box bg-white">
                        <div class="info-box-content">
                            <span class="info-box-text text-center ">Offre (DT)</span>
                            <span class="info-box-number text-center  mb-0">{{$project->offreS}} </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="info-box bg-white">
                        <div class="info-box-content">
                            <span class="info-box-text text-center ">Marge (DT)</span>
                            <span
                                class="info-box-number text-center  mb-0">{{$project->offreS }} </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row"><h2 class="ml-3">Produit</h2></div>

            <div class="row">
                <div class="col-sm-12 col-md-2 offset-md-1">
                    <div class="info-box bg-white">
                        <div class="info-box-content">
                            <span class="info-box-text text-center ">Estimation (DT)</span>
                            <span class="info-box-number text-center mb-0">{{$project->estimationP}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="info-box bg-white">
                        <div class="info-box-content">
                            <span class="info-box-text text-center ">Côut Réel (DT)</span>
                            <span class="info-box-number text-center  mb-0">0</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="info-box bg-white">
                        <div class="info-box-content">
                            <span class="info-box-text text-center ">Ecarts (DT)</span>
                            <span class="info-box-number text-center  mb-0">0</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="info-box bg-white">
                        <div class="info-box-content">
                            <span class="info-box-text text-center ">Offre (DT)</span>
                            <span class="info-box-number text-center  mb-0">{{$project->offreP}} </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="info-box bg-white">
                        <div class="info-box-content">
                            <span class="info-box-text text-center ">Marge (DT)</span>
                            <span class="info-box-number text-center  mb-0">{{$project->offreP}} </span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="callout callout-info">
                    <h3><i class="fas fa-info"></i> {{$project->name}}</h3>
                    <hr>
                    <textarea class="form-control" rows="5" readonly>{{$project->description}}</textarea>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="callout callout-danger">
                    <h3><i class="fas fa-info"></i> Fichiers téléchargés</h3>
                    <hr>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Nom du fichier</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($uploads as $upload)
                            <tr>
                                <td>{{$upload->name}}</td>
                                <td><a href="{{route('readPDF',$upload->id)}}" class="btn btn-info" target="_blank"><i
                                            class="fas fa-eye" aria-hidden="true"></i>
                                    </a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Liste des Tâches
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <ul class="todo-list" data-widget="todo-list">
                            @foreach($tasks as $task)
                                <li>
                                    <!-- drag handle -->
                                    <span class="handle"><i class="fas fa-ellipsis-v"></i><i class="fas fa-ellipsis-v"></i></span>
                                    <!-- todo text -->
                                    (Tâche)<span class="text">{{$task->title}}</span>
                                    @if($task->status_id==1)
                                        <span class="badge badge-info">{{$task->status->name}}</span>
                                    @elseif($task->status_id==2)
                                        <span class="badge badge-success">{{$task->status->name}}</span>
                                    @elseif($task->status_id==3)
                                        <span class="badge badge-warning">{{$task->status->name}}</span>
                                    @elseif($task->status_id==4)
                                        <span class="badge badge-primary">{{$task->status->name}}</span>
                                    @endif

                                    @if($task->priority_id==2)
                                        <span class="badge badge-primary">{{$task->priorities->name}}</span>
                                    @elseif($task->priority_id==1)
                                        <span class="badge badge-warning">{{$task->priorities->name}}</span>
                                    @elseif($task->priority_id==3)
                                        <span class="badge badge-danger">{{$task->priorities->name}}</span>
                                    @endif

                                    <div class="tools">
                                        <a href="{{route('task.show',$task->id)}}"><i class="fas fa-eye"></i></a>
                                        @if($user->role_id ==1 || $user->role_id ==3 ||$user->role_id ==5)
                                        <a href="{{route('task.edit',$task->id)}}"><i class="fas fa-edit"></i></a>
                                            @endif
                                    </div>
                                    <hr>
                                    <ul>
                                        @foreach($task->soustaches() as $subtask)
                                        <li>

                                            <!-- todo text -->
                                            (Sous-Tâche)<span>{{$subtask->title}}</span>
                                            @if($subtask->status_id==1)
                                                <span class="badge badge-info">{{$subtask->status->name}}</span>
                                            @elseif($subtask->status_id==2)
                                                <span class="badge badge-success">{{$subtask->status->name}}</span>
                                            @elseif($subtask->status_id==3)
                                                <span class="badge badge-warning">{{$subtask->status->name}}</span>
                                            @elseif($subtask->status_id==4)
                                                <span class="badge badge-primary">{{$subtask->status->name}}</span>
                                            @endif

                                            @if($subtask->priority_id==2)
                                                <span class="badge badge-primary">{{$subtask->priorities->name}}</span>
                                            @elseif($subtask->priority_id==1)
                                                <span class="badge badge-warning">{{$subtask->priorities->name}}</span>
                                            @elseif($subtask->priority_id==3)
                                                <span class="badge badge-danger">{{$subtask->priorities->name}}</span>
                                            @endif
                                            <div class="tools">
                                                <a href="{{route('subtask.show',$subtask->id)}}"><i class="fas fa-eye"></i></a>
                                                @if($user->role_id ==1 || $user->role_id ==3 ||$user->role_id ==5)
                                                <a href="{{route('subtask.edit',$subtask->id)}}"><i
                                                        class="fas fa-edit"></i></a>
                                                    @endif
                                            </div>
                                        </li>
                                            @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>


    </div>




@endsection
@section('javascript')
@endsection
