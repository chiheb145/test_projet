@extends('back.layouts.app')

@section('content')

    <!--   /views/task/task/tasks.blade.php   -->
    <div class="row">
        <div class="col-md-9">
            <h1>TOUTES LES TÂCHES</h1>
        </div>

        @if($user->role_id ==1 || $user->role_id ==3 || $user->role_id ==5 )
                <div class="col-md-3 ">
                    <a class="btn btn-primary float-right m-2" href="{{route('task.create')}}">Ajouter une tâche</a>
                </div>
        @endif

    </div>

    <div class="row card">
        <div class="card-header">
            <h3 class="card-title">Gestion des Tâches</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="task_table" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                    <th>Nom du Projet</th>
                    <th>Nom du Tâche</th>
                    <th>Client</th>
                    <th>Statut</th>
                    <th>Prioriter</th>
                    <th>Affecter à</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tasks as $task)
                    <tr class="text-center">
                        <td>{{$task->project->name}}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{$task->project->client()->name}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            {{--<a href="{{route('task.show',$task->id)}}" class="btn btn-info"><i
                                    class="fas fa-eye" aria-hidden="true"></i>
                            </a>--}}
                            @if($user->role_id == 1 || $user->role_id == 3 || $user->role_id == 5)
                                <a href="{{route('task.edit',$task->id)}}" class="btn btn-info"><i
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
            $("#task_table").DataTable();
        });
    </script>
@endsection
