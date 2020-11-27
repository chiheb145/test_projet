@extends('back.layouts.app')

@section('content')


    <div class="row">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <h4 class="titre">Gestion des taches</h4>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div id="msg_success" class="alert alert-success" style="display: none">
        </div>
    </div>

    @if($user->role_id ==1 || $user->role_id ==3 || $user->role_id ==4 ||$user->role_id ==5 )
    <div class="row mt-1" id="list1">
        <div class="col-lg-12 ">
            <a class="btn btn-primary float-right m-2" href="{{route('tache.create')}}">Ajouter une tache</a>
        </div>
    </div>
    @endif

    <div class="row card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="taches_table" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                    <th>Titre</th>
                    <th>Contenue</th>
                    <th>Client</th>
                    <th>Statut</th>
                    <th>Prioriter</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($taches as $tache)
                    <tr class="text-center">
                        <td>{{ $tache->title }}</td>
                        <td>{{str_limit($tache->content,50)}}</td>
                        <td>{{$tache->creation->name}}</td>
                        <td>@if($tache->status_id==1)
                            <span class="badge badge-info">{{$tache->status->name}}</span>
                            @elseif($tache->status_id==2)
                            <span class="badge badge-success">{{$tache->status->name}}</span>
                            @elseif($tache->status_id==3)
                                <span class="badge badge-warning">{{$tache->status->name}} </span> <span class="badge badge-warning"> {{@$tache->reopen}}</span>
                        @endif
                        </td>
                        <td>@if($tache->priority_id==2)
                                <span class="badge badge-primary">{{$tache->priorities->name}}</span>
                                @elseif($tache->priority_id==1)
                                <span class="badge badge-warning">{{$tache->priorities->name}}</span>
                                @elseif($tache->priority_id==3)
                                <span class="badge badge-danger">{{$tache->priorities->name}}</span>
                                @endif
                        </td>
                        <td>{{$tache->created_at}}</td>
                        <td>
                            <a href="{{route('tache.show',$tache->id)}}" class="btn btn-info"><i
                                    class="fas fa-eye" aria-hidden="true"></i>
                            </a>
                            @if($user->role_id == 1 || $user->role_id == 3 || $user->role_id == 5)
                                <a href="{{route('tache.edit',$tache->id)}}" class="btn btn-info"><i
                                        class="fas fa-edit" aria-hidden="true"></i>
                                </a>
                               @if($tache->status_id==1 || $tache->status_id==3)
                                <a href="{{route('tache.valider',$tache->id)}}" class="btn btn-success"><i
                                        class="fas fa-check-square" aria-hidden="true"></i>
                                </a>
                                @elseif($tache->status_id==2)
                                <a href="{{route('tache.reopen',$tache->id)}}" class="btn btn-warning"><i
                                        class="fas fa-sync" aria-hidden="true"></i>
                                </a>
                                   @endif
                            @endif
                            {{--<button class="btn btn-danger delete-tache" value="{{$tache->id}}"><i class="fa fa-trash" aria-hidden="true"></i>
                            </button>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


    </div>


@endsection
@section('javascript')
    <script>
    $(function () {
    $("#taches_table").DataTable({
        "order": [6, "desc"],language:{
            "sEmptyTable":     "Aucune donnée disponible dans le tableau",
            "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
            "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
            "sInfoFiltered":   "(filtré à partir de _MAX_ éléments au total)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     "Afficher _MENU_ éléments",
            "sLoadingRecords": "Chargement...",
            "sProcessing":     "Traitement...",
            "sSearch":         "Rechercher :",
            "sZeroRecords":    "Aucun élément correspondant trouvé",
            "oPaginate": {
                "sFirst":    "Premier",
                "sLast":     "Dernier",
                "sNext":     "Suivant",
                "sPrevious": "Précédent"
            },
            "oAria": {
                "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
            },
            "select": {
                "rows": {
                    "_": "%d lignes sélectionnées",
                    "0": "Aucune ligne sélectionnée",
                    "1": "1 ligne sélectionnée"
                }
            }
        },
    });
    });
    </script>
@endsection


