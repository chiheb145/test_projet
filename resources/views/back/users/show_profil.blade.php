@extends('layouts.app2')

@section('content')
    <style>
        .breadcrumb {
            background-color: #4a677d !important;
        }

        .titre {
            color: white;
            font-weight: bold;
            padding-top: 5px;

        }
    </style>

    <div class="row mt-2" id="list0">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <h4 class="titre">Gestion du compte</h4>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <br>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <img src="/storage/{{$user->avatar}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                <h2>{{$user->full_name()}}</h2>
                <form enctype="multipart/form-data" action="/update_avatar" method="POST">
                    @csrf
                    <label>Modifier Votre photo de profil</label>
                    <input type="file" name="avatar" required>
                    <br>
                    <div>
                        <input type="submit" class="btn btn-sm btn-success" value="changer photo de profil">
                    </div>
                </form>
            </div>
        </div>
        <div class="row" style="margin-top: 40px">
            <div class="col-md-offset-4 col-md-6 ">
                <form enctype="multipart/form-data" action="/update_password" method="POST">
                    @csrf
                    <label>Modifier Votre mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nouveau mot de passe" required>
                    <br>
                    <input type="password" class="form-control" id="password-repeat" name="password-repeat" placeholder="Répéter le Nouveau mot de passe" required>
                    <br>
                    <div>
                        <input type="submit" id="btn-change-password" class="btn btn-sm btn-success" value="changer mot de passe">
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
@section('javascript')
    <script>
        $(document).ready(function() {
            $('#btn-change-password').click(function(event){

                data = $('#password').val();
                var len = data.length;

                if(len < 1) {
                    alert("Il faut insérer une mot de passe");
                    // Prevent form submission
                    event.preventDefault();
                }else if(len < 6 && len>=1) {
                    alert("Le mot de passe doit comporter au moins 6 caractères.");
                    // Prevent form submission
                    event.preventDefault();
                }else if($('#password').val() != $('#password-repeat').val()) {
                    alert("Le mot de passe ne correspond pas à le mot de passe répéter");
                    // Prevent form submission
                    event.preventDefault();
                    $('#password').val('');
                    $('#password-repeat').val('');
                }

            });
        });
    </script>
@endsection
