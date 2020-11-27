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
                            <h4 class="titre">Ajouter un Employé</h4>
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

                            <form action="{{route('user.store')}}" method="post" class="form-horizontal">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputUser" class="col-sm-12 control-label">Nom et Prénom</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="first_name" name="name"
                                                   placeholder="Saisir le Nom et le Prénom" value="">
                                        </div>
                                    </div>


                                    <div class="form-group required">
                                        <label for="inputUser" class="col-sm-12 control-label ">Email</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="email" name="email"
                                                   placeholder="Saisir Email" value="">
                                            <span class="text-danger">
                                         <strong id="email-error"></strong>
                                     </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputUser" class="col-sm-12 control-label">Role</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" id="role_id" name="role_id">
                                                @foreach($roles as $role)
                                                    @if($role->name != 'admin')
                                                        <option value="{{$role->id}}">{{$role->display_name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group required password_div">
                                        <label for="inputUser" class="col-sm-12 control-label">Mot de passe</label>
                                        <div class="col-sm-12 password_div">
                                            <i id="eye_icon" class="far fa-eye"></i>
                                            <input type="password" class="form-control" id="password" name="password"
                                                   placeholder="Saisir Mot de passe" value="">
                                            <span class="text-danger">
                                         <strong id="password-error"></strong>
                                     </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <a href="{{route('user.index')}}" class="btn btn-primary float-right m-1">Annuler</a>
                                        <button type="submit" class="btn btn-primary float-right m-1">Sauvegarder
                                        </button>

                                    </div>
                                </div>
                            </form>
                        @elseif($from==2)

                            <form action="{{route('user.update',$user->id)}}" method="post" class="form-horizontal">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Modifier l'utilisateur</h4>

                                    <div class="form-group">
                                        <label for="inputUser" class="col-sm-12 control-label">Nom et Prénom</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="first_name" name="name"
                                                   placeholder="Saisir le Nom et le Prénom" value="{{$user->name}}">
                                        </div>
                                    </div>


                                    <div class="form-group required">
                                        <label for="inputUser" class="col-sm-12 control-label">Email</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="email" name="email"
                                                   placeholder="Saisir Email" value="{{$user->email}}">
                                            <span class="text-danger">
                                         <strong id="email-error"></strong>
                                     </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputUser" class="col-sm-12 control-label">Role</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" id="role_id" name="role_id">
                                                @foreach($roles as $role)
                                                    @if($role->name != 'admin')
                                                        <option value="{{$role->id}}" @if($role->id == $user->role_id) selected @endif>{{$role->display_name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group required password_div">
                                        <label for="inputUser" class="col-sm-12 control-label">Mot de passe</label>
                                        <div class="col-sm-12 password_div">
                                            <i id="eye_icon" class="far fa-eye"></i>
                                            <input type="password" class="form-control" id="password" name="password"
                                                   placeholder="Saisir Mot de passe" value="">
                                            <span class="text-danger">
                                         <strong id="password-error"></strong>
                                     </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <a href="{{route('user.index')}}" class="btn btn-primary float-right m-1">Annuler</a>
                                        <button type="submit" class="btn btn-primary float-right m-1">Sauvegarder
                                        </button>

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
    <script>
        //show password
        $('#eye_icon').click(function () {
            var myClass = $(this).attr("class");
            if (myClass === "far fa-eye") {
                $("#eye_icon").attr('class', 'far fa-eye-slash');
                $("#password").prop('type', 'text');
            } else {
                $("#eye_icon").attr('class', 'far fa-eye');
                $("#password").prop('type', 'password');
            }
        });
    </script>
@endsection

