@extends('back.layouts.app')

@section('content')



    <div class="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <h4 class="titre">Gestion du Sous Tâche : {{$subtask->title}}</h4>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="container-fluid">

            <div class="row mt-1">
                <div class="col-lg-12 ">
                    <a class="btn btn-primary float-right m-2" href="{{route('task.show',$subtask->task->id)}}">Retour</a>
                    @if($subtask->date_start == null)
                        <a href="{{route('subtask.start',$subtask->id)}}"
                           class="btn btn-success float-right m-2 text-white" id="play"><i class="fas fa-play"></i>
                            Démarer</a>
                    @elseif($subtask->date_end == null)
                        <a data-toggle="modal" data-target="#modal-lg"
                           class="btn btn-danger float-right m-2 text-white" id="stop"><i class="fas fa-stop"></i>
                            Stop</a>

                        <a href="{{route("subtask.pause" ,$subtask->id)}}" class="btn btn-warning float-right m-2 text-white" id="pause"><i class="fas fa-pause"></i>
                            Fin étape</a>
                    @elseif($subtask->date_end && $subtask->date_start)
                        @if($user->role_id ==1 || $user->role_id ==3 ||$user->role_id ==5)
                            @if($subtask->status_id==1 || $subtask->status_id==3 || $subtask->status_id==4)
                                <a data-toggle="modal" data-target="#modal-fermer"
                                   class="btn btn-success float-right m-2 text-white"><i
                                        class="fas fa-check-square" aria-hidden="true"></i> Fermer
                                </a>
                            @elseif($subtask->status_id==2)
                                <a data-toggle="modal" data-target="#modal-reopen"
                                   class="btn btn-warning float-right m-2 text-white"><i
                                        class="fas fa-sync" aria-hidden="true"></i> Rouvrir
                                </a>
                            @endif
                        @endif
                    @endif
                </div>
            </div>

            @if($user->role_id ==1 || $user->role_id ==3 ||$user->role_id ==5 )

                <div class="row"><h2 class="ml-3">Service</h2></div>

                <div class="row">
                    <div class="col-sm-12 col-md-2 offset-md-1">
                        <div class="info-box bg-white">
                            <div class="info-box-content">
                                <span class="info-box-text text-center ">Estimation (DT)</span>
                                <span
                                    class="info-box-number text-center mb-0">{{$subtask->estimationS * $subtask->prix}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="info-box bg-white">
                            <div class="info-box-content">
                                <span class="info-box-text text-center ">Côut Réel (DT)</span>
                                <span class="info-box-number text-center  mb-0">{{$subtask->cout_real()}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="info-box bg-white">
                            <div class="info-box-content">
                                <span class="info-box-text text-center ">Ecarts (DT)</span>
                                <span
                                    class="info-box-number text-center  mb-0">{{$subtask->cout_real() - ($subtask->estimationS * $subtask->prix)}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="info-box bg-white">
                            <div class="info-box-content">
                                <span class="info-box-text text-center ">Offre (DT)</span>
                                <span class="info-box-number text-center  mb-0">{{$subtask->offreS}} </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="info-box bg-white">
                            <div class="info-box-content">
                                <span class="info-box-text text-center ">Marge (DT)</span>
                                <span
                                    class="info-box-number text-center  mb-0">{{$subtask->offreS - $subtask->cout_real()}} </span>
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
                                <span class="info-box-number text-center mb-0">{{$subtask->estimationP}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="info-box bg-white">
                            <div class="info-box-content">
                                <span class="info-box-text text-center ">Côut Réel (DT)</span>
                                <span class="info-box-number text-center  mb-0">{{$subtask->cout_realP}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="info-box bg-white">
                            <div class="info-box-content">
                                <span class="info-box-text text-center ">Ecarts (DT)</span>
                                <span class="info-box-number text-center  mb-0">{{$subtask->cout_realP - $subtask->estimationP}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="info-box bg-white">
                            <div class="info-box-content">
                                <span class="info-box-text text-center ">Offre (DT)</span>
                                <span class="info-box-number text-center  mb-0">{{$subtask->offreP}} </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="info-box bg-white">
                            <div class="info-box-content">
                                <span class="info-box-text text-center ">Marge (DT)</span>
                                <span class="info-box-number text-center  mb-0">{{$subtask->offreP - $subtask->cout_realP}} </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            <div class="row">
                <div class="col-md-8">
                    <div class="callout callout-info">
                        <h3><i class="fas fa-info"></i> {{$subtask->title}}</h3>

                        <hr>
                        <textarea class="form-control" rows="10" readonly>{{$subtask->description}}</textarea>
                    </div>

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
                <div class="col-md-4">


                        <div class="callout callout-warning">
                            <h3><i class="fas fa-info"></i> Affecter à</h3>

                            <hr>
                            {{$subtask->user->name}}
                        </div>

                    <div class="callout callout-warning">
                        <h3><i class="fas fa-info"></i> Prioriter</h3>

                        <hr>
                        @if($subtask->priority_id==2)
                            <span class="badge badge-primary">{{$subtask->priorities->name}}</span>
                        @elseif($subtask->priority_id==1)
                            <span class="badge badge-warning">{{$subtask->priorities->name}}</span>
                        @elseif($subtask->priority_id==3)
                            <span class="badge badge-danger">{{$subtask->priorities->name}}</span>
                        @endif
                    </div>

                    <div class="callout callout-warning">
                        <h3><i class="fas fa-info"></i> Statut</h3>

                        <hr>
                        @if($subtask->status_id==1)
                            <span class="badge badge-info">{{$subtask->status->name}}</span>
                        @elseif($subtask->status_id==2)
                            <span class="badge badge-success">{{$subtask->status->name}}</span>
                        @elseif($subtask->status_id==3)
                            <span class="badge badge-warning">{{$subtask->status->name}} </span>
                        @elseif($subtask->status_id==4)
                            <span class="badge badge-primary">{{$subtask->status->name}} </span>
                        @endif
                    </div>

                    <div class="callout callout-warning">
                        <h3><i class="fas fa-info"></i> Temps d'intervention</h3>

                        <hr>
                        {{$subtask->somme()}}
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @foreach($comments as $comment)
                        <div class="card">
                            <div class="card-body">

                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="{{asset('back/dist/img/avatar5.png')}}" alt="user image">
                                        <span class="username">
                          <a href="#">{{$comment->user->name}}</a>
                        </span>
                                        <span class="description">{{$comment->created_at}}</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        {{$comment->comment}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


        </div>
    </div>

    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Stopper l'intervention</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('subtask.stop',$subtask->id)}}" method="post" class="form-horizontal">
                    @csrf
                    <div class="modal-body">
                        <textarea class="form-control" name="comment" rows="3" required></textarea>
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default float-right" data-dismiss="modal">fermer</button>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-fermer">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Valider l'intervention</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('subtask.valider',$subtask->id)}}" method="post" class="form-horizontal">
                    @csrf
                    <div class="modal-body">
                        <textarea class="form-control" name="comment" rows="3" required></textarea>
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default float-right" data-dismiss="modal">fermer</button>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-reopen">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Rouvrir l'intervention</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('subtask.reopen',$subtask->id)}}" method="post" class="form-horizontal">
                    @csrf
                    <div class="modal-body">
                        <textarea class="form-control" name="comment" rows="3" required></textarea>
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default float-right" data-dismiss="modal">fermer</button>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>




@endsection
@section('javascript')
@endsection
