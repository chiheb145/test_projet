@extends('back.layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <h4 class="titre">Gestion des Projets</h4>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    @if($user->role_id ==1 || $user->role_id ==3 || $user->role_id ==5 )
        <div class="row mt-1" id="list1">
            <div class="col-lg-12 ">
                <a class="btn btn-primary float-right m-2" href="{{route('project.create')}}">Ajouter un Projet</a>
            </div>
        </div>
    @endif

    <div class="row card">

        <!-- /.card-header -->
        <div class="card-body">
            <table id="project_table" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                    <th>Titre</th>
                    <th>Client</th>
                    <th>L'avancement du projet</th>
                    <th>Statut</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($projects as $project)
                    <tr class="text-center">
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->client->name }}</td>
                        <td>
                            <div class="progress progress-sm">
                                @if($project->progression() < 30)
                                <div class="progress-bar bg-red" role="progressbar" aria-volumenow="{{$project->progression()}}" aria-volumemin="0" aria-volumemax="100" style="width: {{$project->progression()}}%">
                                </div>
                                    @elseif($project->progression() >= 30 && $project->progression() < 70)
                                    <div class="progress-bar bg-orange" role="progressbar" aria-volumenow="{{$project->progression()}}" aria-volumemin="0" aria-volumemax="100" style="width: {{$project->progression()}}%">
                                    </div>
                                    @elseif($project->progression() >= 70)
                                    <div class="progress-bar bg-green" role="progressbar" aria-volumenow="{{$project->progression()}}" aria-volumemin="0" aria-volumemax="100" style="width: {{$project->progression()}}%">
                                    </div>
                                    @endif
                            </div>
                            <small>
                                {{$project->progression()}} % Complete
                            </small>

                            </td>
                        <td>
                            @if($project->status()=='Nouveau')
                                <span class="badge badge-info">{{$project->status()}}</span>
                            @elseif($project->status()=='Terminer')
                                <span class="badge badge-success">{{$project->status()}}</span>
                            @elseif($project->status()=='En cours')
                                <span class="badge badge-primary">{{$project->status()}}</span>
                            @endif
                        </td>
                        <td>{{str_limit($project->description,30)}}</td>
                        <td>
                            <a href="{{route('project.show',$project->id)}}" class="btn btn-info"><i
                                    class="fas fa-eye" aria-hidden="true"></i>
                            </a>
                            @if($user->role_id == 1 || $user->role_id == 3 || $user->role_id == 5)
                                <a href="{{route('project.edit',$project->id)}}" class="btn btn-info"><i
                                        class="fas fa-edit" aria-hidden="true"></i>
                                </a>
                            @endif
                            {{--<button class="btn btn-danger delete-projet" value="{{$projet->id}}"><i class="fa fa-trash" aria-hidden="true"></i>
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
    $("#project_table").DataTable({
        language:{
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
        },}
    );
    });
    </script>
@endsection

