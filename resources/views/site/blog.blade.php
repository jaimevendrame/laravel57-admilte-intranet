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
                        <li>Blog</li>
                    </ul>
                    <h1 class="white-text">Blog</h1>

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

                    <!-- row -->
                    <div class="row">

                        <!-- single blog -->
                        @forelse($posts as $post)
                        <div class="col-md-6">
                            <div class="single-blog">
                                <div class="blog-img">
                                    <a href="{{url("/blog/posts/{$post->url}")}}">
                                        <img src="{{url("assets/uploads/posts/{$post->image}")}}" alt="{{$post->title}}">
                                    </a>
                                </div>
                                <h4><a href="/blog/post">{{$post->title}}</a></h4>
                                <div class="blog-meta">
                                    <span class="blog-meta-author">Por: <a href="#">{{$post->user->name}}</a></span>
                                    <div class="pull-right">
                                        <span>{{\Carbon\Carbon::parse($post->date)->format('d/m/Y')}}</span>
                                        <span class="blog-meta-comments"><a href="#"><i class="fa fa-comments"></i> 35</a></span>
                                        <span class="blog-meta-comments"><a href="#"><i class="fa fa-eye"></i> {{$post->views()->count()}}</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @empty
                            <p>Nenhum post</p>
                        @endforelse
                    </div>
                    <!-- /row -->

                    <!-- row -->
                    <div class="row">

                        <!-- pagination -->
                        <div class="col-md-12">
                            <div class="post-pagination">
                                {!! $posts->links()  !!}
                            </div>
                        </div>
                        <!-- pagination -->

                    </div>
                    <!-- /row -->
                </div>
                <!-- /main blog -->

                <!-- aside blog -->
                <div id="aside" class="col-md-3">

                    <!-- search widget -->
                    <div class="widget search-widget">
                        <form role="form" method="post" action="{{route('search.blog')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input class="input" type="text" name="key-search">
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
</script>
@endpush