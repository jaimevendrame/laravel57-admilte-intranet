@extends('site.templates.home')
@section('meta_facebook')

    <meta property="og:url"           content='{{url("/blog/posts/{$post->url}")}}' />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="SparkCursos" />
    <meta property="og:description"   content="Educação para todos" />
    <meta property="og:image"         content='{{url("assets/uploads/posts/{$post->image}")}}' />

@stop
@section('content')

    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{url("assets/uploads/posts/{$post->image}")}})"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li>{{$title}}</li>
                    </ul>
                    <h1 class="white-text">{{$title}}</h1>
                    <ul class="blog-post-meta">
                        <li class="blog-meta-author">Por : <a href="#">{{$post->user->name}}</a></li>
                        <li>{{\Carbon\Carbon::parse($post->date)->format('d/m/Y')}}</li>
                        <li class="blog-meta-comments"><a href="#"><i class="fa fa-comments"></i> 35</a></li>
                        <li class="blog-meta-comments"><a href="#"><i class="fa fa-eye"></i> {{$post->views()->count()}}</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Blog -->
    <div id="blog" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- main blog -->
                <div id="main" class="col-md-9">

                    <!-- blog post -->
                    <div class="blog-post">
                        <p>{!! $post->description !!}</p>
                        <blockquote>
                            <p>{!! $post->calltext !!}</p>
                        </blockquote>
                        <p>{!! $post->descriptionfull !!}</p>
                    </div>
                    <!-- /blog post -->

                    <!-- blog share -->
                    <div class="blog-share">
                        <h4>Share This Post:</h4>
                        <a href='https://www.facebook.com/sharer/sharer.php?u={{url("/blog/posts/{$post->url}")}}' id="facebook-share-btt" rel="nofollow" target="_blank" class="facebook-share-button facebook"><i class="fa fa-facebook"></i></a>
                        <a href='https://twitter.com/intent/tweet?url={{url("/blog/posts/{$post->url}")}}&text={{substr(strip_tags($post->description),0,250).'...'}}' id="twitter-share-btt" rel="nofollow" target="_blank" class="twitter twitter-share-button"><i class="fa fa-twitter"></i></a>
                        <a href='https://plus.google.com/share?url={{url("/blog/posts/{$post->url}")}}&h1=pt-BR' id="google-plus-share-btt" rel="nofollow" target="_blank" class="google-plus-share-button google-plus"><i class="fa fa-google-plus"></i></a>
                        <a href='https://api.whatsapp.com/send?text={{url("/blog/posts/{$post->url}")}}' rel="nofollow" target="_blank" class="whatsapp"><i class="fa fa-whatsapp"></i></a>
                    </div>
                    <!-- /blog share -->
                    <!-- Load Facebook SDK for JavaScript -->
                    <div id="fb-root"></div>


                    <!-- Your share button code -->
                    <div class="fb-share-button"
                         data-href='{{url("/blog/posts/{$post->url}")}}'
                         data-layout="button_count">
                    </div>

                    <!-- blog comments -->
                    <div class="blog-comments">
                        <h3>{{$post->comments()->count()}} Comentários</h3>

                        <!-- single comment -->
                        @forelse( $post->comments as $comment)
                        <div class="media">
                            <div class="media-left">
                                @if( $comment->image_user != '' && file_exists(public_path('assets/uploads/users/'. $comment->image_user)))
                                    <img src="{{URL::asset('/assets/uploads/users/'. $comment->image_user)}}" alt="{{ $comment->name}}">
                                @else
                                    <img src="{{URL::asset('/assets/uploads/users/no-image.png')}}" alt="{{ $comment->name}}">
                                @endif

                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{$comment->name}}</h4>
                                <p>{{$comment->description}}</p>
                                <div class="date-reply"><span>{{\Carbon\Carbon::parse($comment->date)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($comment->hour)->format('H:i:s')}}</span><a href="#" class="reply">Responder</a></div>
                            </div>
                            <!-- comment reply -->
                            @foreach( $comment->answers()->get() as $answer)
                            <div class="media">
                                <div class="media-left">
                                    @if( $answer->image_user != '' && file_exists(public_path('assets/uploads/users/'. $answer->image_user)))
                                        <img src="{{URL::asset('/assets/uploads/users/'. $answer->image_user)}}" alt="{{ $answer->name}}">
                                    @else
                                        <img src="{{URL::asset('/assets/uploads/users/no-image.png')}}" alt="{{ $answer->name}}">
                                    @endif
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{$answer->name}}</h4>
                                    <p>{{$answer->description}}</p>
                                    <div class="date-reply"><span>{{\Carbon\Carbon::parse($answer->date)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($answer->hour)->format('H:i:s')}}</span></div>
                                </div>
                            </div>
                            @endforeach
                            <!-- /comment reply -->
                        </div>
                        @empty
                            <div>Seja o primeiro a comentar</div>
                        @endforelse
                        <!-- /single comment -->

                        <!-- blog reply form -->
                        <div class="blog-reply-form">
                            <h3>Deixe seu comentário @if( auth()->check()) <b> {{auth()->user()->name}}</b> @endif</h3>

                            <form id="form-comment" role="form" method="post" action="{{route('comment')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @if( auth()->check())
                                    <input type="hidden" name="name" value="{{auth()->user()->name}}">
                                    <input type="hidden" name="email" value="{{auth()->user()->email}}">
                                    @else
                                    <input class="input name-input" type="text" name="name" placeholder="Nome">
                                    <input class="input email-input" type="email" name="email" placeholder="Email">
                                @endif

                                <input type="hidden" name="post" value="{{$post->id}}">
                                <textarea class="input" name="description" placeholder="Digite sua mensagem"></textarea>
                                <button class="main-button icon-button">Enviar</button>
                            </form>
                            <div class="preloader" style="display: none;">Enviando comentário...</div>
                            <div class="alert alert-success" style="display: none;">Comentário enviado com sucesso.</div>
                            <div class="alert alert-danger" style="display: none;"></div>
                        </div>
                        <!-- /blog reply form -->

                    </div>
                    <!-- /blog comments -->
                </div>
                <!-- /main blog -->

                <!-- aside blog -->
                <div id="aside" class="col-md-3">

                    <!-- search widget -->
                    <div class="widget search-widget">
                        <form>
                            <input class="input" type="text" name="search">
                            <button><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <!-- /search widget -->

                    <!-- category widget -->
                    <div class="widget category-widget">
                        <h3>Categorias</h3>

                        <a class="category" href="{{url("/blog")}} "> Todas <span>{{$postsTotal->count()}}</span></a>

                        @foreach($categories as $category)
                            <a class="category" href="{{url("/blog/categoria/{$category->url}")}} "> {{$category->name}}<span>{{ $postsTotal->where("category_id", $category->id)->count() }}</span></a>
                        @endforeach
                    </div>
                    <!-- /category widget -->

                    <!-- posts widget -->
                    <div class="widget posts-widget">
                        <h3>Posts Recentes</h3>

                        <!-- single posts -->
                        @foreach($postFeatured as $featured)
                            <div class="single-post">
                                <a class="single-post-img" href="{{url("/blog/posts/{$featured->url}")}}">
                                    <img src="{{url("assets/uploads/posts/{$featured->image}")}}" alt="">
                                </a>
                                <a href="{{url("/blog/posts/{$featured->url}")}}">{{$featured->title}}</a>
                                <p><small>By : John Doe .18 Oct, 2017</small></p>
                            </div>
                    @endforeach
                        <!-- /single posts -->

                    </div>
                    <!-- /posts widget -->

                    <!-- tags widget -->
                    <div class="widget tags-widget">
                        <h3>Tags</h3>
                        <a class="tag" href="#">Web</a>
                        <a class="tag" href="#">Photography</a>
                        <a class="tag" href="#">Css</a>
                        <a class="tag" href="#">Responsive</a>
                        <a class="tag" href="#">Wordpress</a>
                        <a class="tag" href="#">Html</a>
                        <a class="tag" href="#">Website</a>
                        <a class="tag" href="#">Business</a>
                    </div>
                    <!-- /tags widget -->

                </div>
                <!-- /aside blog -->

            </div>
            <!-- row -->

        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->


@endsection
@push('js')

<script>

    $(document).ready(function() {
        $("#header").removeClass("transparent-nav");


        $('#logo').attr('src', '{{url('assets/site/img/logo-nova.png')}}');
    } );

    $(function () {
        $('#form-comment').submit(function () {
            var dataForm = $(this).serialize();

            $.ajax({
                url: '/comment-post',
                method: 'POST',
                data: dataForm,
                beforeSend: startPreloader()
            }).done(function (data) {
                if ( data == "1"){
                    $('.alert-success').fadeIn();
                } else {
                    $('.alert-danger').fadeIn();
                    $('.alert-danger').html(data);
                }

                hideMsg();

                stopPreloader();
            }).fail(function () {
                alert("Falha ao enviar...");

                stopPreloader();
            });

            return false;
        });

        function startPreloader() {
            $('.preloader').show();
        }

        function stopPreloader() {
            $('.preloader').hide();
        }
        function hideMsg() {

            $('#form-comment')[0].reset();

            setTimeout("$('.alert').hide();", 5000);

        }
    });


</script>
@endpush