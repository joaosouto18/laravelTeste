<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">



    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Laravel</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
    <a class="navbar-brand" href="#">Rodrigo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/register">Register</a>
            </li>
        </ul>

    </div>
    </div>
</nav>

<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Cadastro de Fornecedor</div>
                        <div class="card-body">
                                <form class="form-horizontal" method="GET" action="{{ route('validate_cnpj') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}  
                 
                                <div class="form-group row">
                                    <label for="cnpj" class="col-md-4 col-form-label text-md-right">CNPJ</label>
                                    <div class="col-md-6">
                                        <input type="text" id="cnpj" class="form-control" name="cnpj">
                                    </div>
                                </div>
                              

                                <div class="col-md-6 offset-md-4">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                        Cadastrar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>

    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Lista de fornecedores cadastrados</div>
                        <div class="card-body">
                            <form name="my-form" onsubmit="return validform()" action="success.php" method="">

                                @foreach ($item as $value)
                                <div class="form-group row">
                                    <label class="col-md-12 col-form-label text-md-left">{{ $value->nome }}</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-12 col-form-label text-md-left"><b>CNPJ:</b> {{ $value->cnpj }}</label>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-12 col-form-label text-md-left"><b>Atividade principal:</b> {{ $value->atividade_principal }}</label>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-12 col-form-label text-md-left"><b>Cadastrado em:</b>  {{ $value->created_at }}</label>
                                </div>

                                <hr>

                                @endforeach
                 
                              
                              
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>