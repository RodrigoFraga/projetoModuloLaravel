<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    @if(Config::get('app.debug'))
        <link rel="stylesheet" href="{{asset('build/css/app.css')}}">
        <link rel="stylesheet" href="{{asset('build/css/components.css')}}">
        <link rel="stylesheet" href="{{asset('build/css/flaticon.css')}}">
        <link rel="stylesheet" href="{{asset('build/css/font-awesome.css')}}">
        <link rel="stylesheet" href="{{asset('build/css/vendor/ng-table.min.css')}}">
        <link rel="stylesheet" href="{{asset('build/css/vendor/select.min.css')}}">
    @else
        <link rel="stylesheet" href="{{elixir('css/all.css')}}">
@endif



<!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<load-template url="build/views/templates/menu.html"></load-template>


<div ng-view></div>

@if(Config::get('app.debug'))
    <script src="{{asset('build/js/vendor/jquery.min.js')}}"></script>
    <script src="{{asset('build/js/vendor/angular.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.4.1/angular-sanitize.js"></script>

    <script src="{{asset('build/js/vendor/angular-route.min.js')}}"></script>
    <script src="{{asset('build/js/vendor/angular-resource.min.js')}}"></script>
    <script src="{{asset('build/js/vendor/angular-animate.min.js')}}"></script>
    <script src="{{asset('build/js/vendor/angular-messages.min.js')}}"></script>
    <script src="{{asset('build/js/vendor/ui-bootstrap-tpls.min.js')}}"></script>
    <script src="{{asset('build/js/vendor/navbar.min.js')}}"></script>
    <script src="{{asset('build/js/vendor/query-string.js')}}"></script>
    <script src="{{asset('build/js/vendor/angular-cookies.min.js')}}"></script>
    <script src="{{asset('build/js/vendor/angular-oauth2.min.js')}}"></script>
    <script src="{{asset('build/js/vendor/http-auth-interceptor.js')}}"></script>

    {{--Add foara do curso--}}
    <script src="{{asset('build/js/vendor/ng-table.min.js')}}"></script>
    <script src="{{asset('build/js/vendor/select.min.js')}}"></script>

    <script src="{{asset('build/js/app.js')}}"></script>

    <!-- CONTROLLER -->
    <script src="{{asset('build/js/controllers/menu.js')}}"></script>
    <script src="{{asset('build/js/controllers/login.js')}}"></script>
    <script src="{{asset('build/js/controllers/loginModal.js')}}"></script>
    <script src="{{asset('build/js/controllers/home.js')}}"></script>

    <script src="{{asset('build/js/controllers/cliente/clienteLista.js')}}"></script>
    <script src="{{asset('build/js/controllers/cliente/clienteNovo.js')}}"></script>
    <script src="{{asset('build/js/controllers/cliente/clienteEdita.js')}}"></script>
    <script src="{{asset('build/js/controllers/cliente/clienteRemove.js')}}"></script>

    <script src="{{asset('build/js/controllers/projeto/projetoLista.js')}}"></script>
    <script src="{{asset('build/js/controllers/projeto/projetoNovo.js')}}"></script>
    <script src="{{asset('build/js/controllers/projeto/projetoEdita.js')}}"></script>
    <script src="{{asset('build/js/controllers/projeto/projetoRemove.js')}}"></script>

    <script src="{{asset('build/js/controllers/projeto-nota/projetoNotaLista.js')}}"></script>
    <script src="{{asset('build/js/controllers/projeto-nota/projetoNotaShow.js')}}"></script>
    <script src="{{asset('build/js/controllers/projeto-nota/projetoNotaNovo.js')}}"></script>
    <script src="{{asset('build/js/controllers/projeto-nota/projetoNotaEdita.js')}}"></script>
    <script src="{{asset('build/js/controllers/projeto-nota/projetoNotaRemove.js')}}"></script>

    <!-- DIRECTIVES -->
    <script src="{{asset('build/js/directives/loginForm.js')}}"></script>
    <script src="{{asset('build/js/directives/loadTemplate.js')}}"></script>
    <script src="{{asset('build/js/directives/menuActivated.js')}}"></script>

    <!-- FILTERS -->
    <script src="{{asset('build/js/filters/date-br.js')}}"></script>

    <!-- SERVICES -->
    <script src="{{asset('build/js/services/oauthFixInterceptor.js')}}"></script>
    <script src="{{asset('build/js/services/cliente.js')}}"></script>
    <script src="{{asset('build/js/services/projeto.js')}}"></script>
    <script src="{{asset('build/js/services/projetoNota.js')}}"></script>
    <script src="{{asset('build/js/services/user.js')}}"></script>
@else
    <script src="{{elixir('js/all.js')}}"></script>
@endif
</body>
</html>
