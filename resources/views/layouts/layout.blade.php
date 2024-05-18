<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/olive/olive-logo2.jpeg') }}"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="site-url" content="{{ url('/') }}">
    <title>
      Registro Entrada
    </title>
    @include('archivos_tercero.css_back')
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
   
    @yield('css')

   
</head>
<body class="hold-transition layout-top-nav">
        <div class="wrapper">
    @include('layouts.header')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
  @include('layouts.footer')
</div>
@include('archivos_tercero.js_back')
@yield('js')
</body>
</html>
