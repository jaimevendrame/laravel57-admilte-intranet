@extends('site.templates.home')
@section('content')

    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{url('assets/site/img/page-background.jpg')}})"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="index.html">Home</a></li>
                        <li>Cadastro</li>
                    </ul>
                    <h1 class="white-text">Cadastro de Aluno</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Contact -->
    <div id="contact" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- contact form -->
                <div class="col-md-6">
                    <div class="contact-form">
                        @if( Session::has('success'))
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible hide-msgd">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-warning"></i> {{Session::get('success')}}</h4>

                                </div>
                            </div>
                        @endif
                        <!-- Alert Errors start -->
                            @if( isset($errors) && count($errors) > 0 )
                                <div class="col-md-12">
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-warning"></i> Atenção!</h4>
                                        @foreach( $errors->all() as $error)
                                            <p>{{$error}}</p>
                                        @endforeach
                                    </div>
                                </div>

                        @endif
                        <!-- /.Alert Errors start -->
                        <h4>Faça seu Cadastro aqui!</h4>
                        <form role="form" method="post" action="{{route('site.create')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input class="input" type="text" name="name" placeholder="Nome">
                            <input class="input" type="email" name="email" placeholder="Email">
                            <input class="input" type="password" name="password" placeholder="Senha">
                            <input class="input" type="password" name="password_confirmation" placeholder="Confirmar a senha">
                            <input class="input" type="file" name="image">
                            <button class="main-button icon-button pull-right">Enviar Cadastro</button>
                        </form>
                    </div>
                </div>
                <!-- /contact form -->

                <!-- contact information -->
                <div class="col-md-5 col-md-offset-1">
                    <h4>Informações para contato</h4>
                    <ul class="contact-details">
                        <li><i class="fa fa-envelope"></i>contato@sparkcursos.com.br</li>
                        <li><i class="fa fa-phone"></i>122-547-223-45</li>
                        <li><i class="fa fa-map-marker"></i>4476 Clement Street</li>
                    </ul>

                    <!-- contact map -->
                    <div id="contact-map"></div>
                    <!-- /contact map -->

                </div>
                <!-- contact information -->

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact -->


@endsection
@push('js')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript" src="{{url('assets/site/js/google-map.js')}}"></script>

<script>

    $(document).ready(function() {
        $("#header").removeClass("transparent-nav");


        $('#logo').attr('src', '{{url('assets/site/img/logo-nova.png')}}');
    } );
</script>
@endpush