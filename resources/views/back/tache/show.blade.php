@extends('back.layouts.app')

@section('content')



    <div class="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <h4 class="titre">Gestion du taches {{$tache->title}}</h4>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="container-fluid">

            <div class="row mt-1">
                <div class="col-lg-12 ">
                    <a class="btn btn-primary float-right m-2" href="{{route('tache.index')}}">Retour</a>
                </div>
            </div>


            <div class="row">
                <div class="col-md-8">
                    <div class="callout callout-info">
                        <h3><i class="fas fa-info"></i> {{$tache->title}}</h3>

                        <hr>
                        <textarea class="form-control" rows="16" readonly>{{$tache->content}}</textarea>
                    </div>
                </div>
                <div class="col-md-4">

                        <div class="callout callout-warning">
                            <h3><i class="fas fa-info"></i> Client</h3>

                            <hr>
                            {{@$tache->creation->name}}
                        </div>

                    <div class="callout callout-warning">
                        <h3><i class="fas fa-info"></i> Prioriter</h3>

                        <hr>
                        @if($tache->priority_id==2)
                            <span class="badge badge-primary">{{$tache->priorities->name}}</span>
                        @elseif($tache->priority_id==1)
                            <span class="badge badge-warning">{{$tache->priorities->name}}</span>
                        @elseif($tache->priority_id==3)
                            <span class="badge badge-danger">{{$tache->priorities->name}}</span>
                        @endif
                    </div>

                    <div class="callout callout-warning">
                        <h3><i class="fas fa-info"></i> Statut</h3>

                        <hr>
                        @if($tache->status_id==1)
                            <span class="badge badge-info">{{$tache->status->name}}</span>
                        @elseif($tache->status_id==2)
                            <span class="badge badge-success">{{$tache->status->name}}</span>
                        @elseif($tache->status_id==3)
                            <span class="badge badge-warning">{{$tache->status->name}} </span> <span class="badge badge-warning"> {{@$tache->reopen}}</span>
                        @endif
                    </div>

                </div>
            </div>


        </div>
    </div>




@endsection
@section('javascript')
@endsection
