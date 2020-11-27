@extends('back.layouts.app')

@section('content')


    <div class="row">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <h4 class="titre">Gestion des utilisateurs</h4>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div id="msg_success" class="alert alert-success" style="display: none">
        </div>
    </div>

    <div class="row mt-1" id="list1">
        <div class="col-lg-12 ">
            <a class="btn btn-primary float-right m-2" href="{{route('user.create')}}">Ajouter un utilisateur</a>
        </div>
    </div>
    <div class="row card">
        <div class="card-header">
            <h3 class="card-title">Gestion des Utilisateurs</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="users_table" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                    <th >Nom complete</th>
                    <th >Email</th>
                    <th >Role</th>
                    <th >Date de création</th>
                    <th >Actions</th>
                </tr>
                </thead>
                <tbody >
                @foreach ($users as $user)
                    @if($user->status==1)
                    @if($user->role->name != 'admin')
                    <tr class="text-center">
                        <td>{{ $user->name }}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role->display_name}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <a href="{{route('user.edit',$user->id)}}" class="btn btn-info open-modal" ><i class="fas fa-edit" aria-hidden="true"></i>
                            </a>
                            <a href="{{route('user.delete',$user->id)}}" class="btn btn-danger open-modal" ><i class="fa fa-trash" aria-hidden="true"></i>
                            </a>

                        </td>
                    </tr>
                    @endif
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


        <div class="modal fade" id="userDeleteModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="userDeleteModalLabel">Supprimer l'utilisateur</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="modalFormData2" name="modalFormData2" class="form-horizontal" novalidate="">

                            <div class="form-group">
                                <div class="col-sm-12">
                                    Supprimer l'utilisateur <span id="user_name2"></span>?
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-basic" id="btn-cancel2" value="delete">Annuler
                        </button>
                        <button type="button" class="btn btn-danger" id="btn-delete" value="delete"><i class="fa fa-trash" aria-hidden="true"></i> Supprimer
                        </button>
                        <input type="hidden" id="user_id2" name="user_id2" value="0">
                    </div>
                </div>
            </div>
        </div>


    </div>


@endsection
@section('javascript')
    <script>
        $(function () {
            $("#users_table").DataTable({
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
                },
            });
        });
    </script>
@endsection

