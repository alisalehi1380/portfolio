<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Themes Industry">
    <!-- description -->
    <meta name="description"
          content="Product is a highly creative, modern, visually stunning and Bootstrap responsive multipurpose agency and HTML5 template with 14 ready home page demos.">
    <!-- keywords -->
    <meta name="keywords"
          content="creative, modern, clean, bootstrap responsive, html5, css3, portfolio, blog, agency, templates, multipurpose, one page, corporate, start-up, studio, branding, designer, freelancer, carousel, parallax, photography, personal, masonry, grid, faq">
    <!-- Page Title -->
    <title>Blog</title>
    <link rel="stylesheet" href="{{asset('blog/css/jquery.fancybox.min.css')}}">
    <!-- Favicon -->
    <link rel="icon" href="../blog/img/favicon.ico">
    <!-- Bundle -->
    <link rel="stylesheet" href="{{asset('blog/css/bundle.min.css')}}">
    <!-- Plugin Css -->

    <link rel="stylesheet" href="{{asset('blog/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('blog/css/cubeportfolio.min.css')}}">
    <link rel="stylesheet" href="{{asset('blog/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('blog/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('blog/css/mediaelementplayer.css')}}">
    <link rel="stylesheet" href="{{asset('blog/css/mejs-controls.svg')}}">
    <!-- Style Sheet -->
    <link rel="stylesheet" href="{{asset('blog/css/style.css')}}">

</head>

<body data-spy=" " data-target=".navbar" data-offset="150">

<!--  PRELOADER  -->
<div class="loader-area">
    <div class='loader'>
        <div class='one'></div>
        <div class='two'></div>
        <div class='three'></div>
    </div>
</div>

<!--<a class="scroll-top-arrow" href="javascript:void(0);"><i class="fa fa-angle-up"></i></a>-->

<!-- START NAVBAR SECTION -->
<header>

    <nav id="my-nav" class="navbar navbar-expand-lg navbar-light rounded-bar fixed-navbar">
        <div class="row w-100 m-0">
            <div class="col-3 p-0 mt-3 mt-md-4">
                <ul class="navbar-icons">
                    <li class="navbar_list"><i class="lab la-facebook-f"></i></li>
                    <li class="navbar_list"><i class="lab la-twitter"></i></li>
                    <li class="navbar_list"><i class="lab la-linkedin-in"></i></li>
                </ul>
            </div>

            <div class="col-6">
                <div class="logo ml-auto mr-auto width-logo text-center mt-2 mt-md-3">
                    <a href="{{route('index.guest')}}"><img src="{{asset('blog/images/logo.png')}}" alt="Logo Img"></a>
                </div>
            </div>

            <div class="col-3 p-0 text-right">
                <div class="menu-btn mt-3 mt-md-4">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>

    </nav>

    <div class="outer-wrapper">
        <div class="overlay1">

            <a class="close-outerwindow"><i class="las la-times"></i></a>

            <nav class="navbar-1 w-100">

                <div class="row text-center">

                    <div class="col-12">
                        <div class="logo-img text-center">
                            <a href="#"><img src="{{asset('blog/images/logo.png')}}" alt="Logo Img"></a>
                        </div>
                        <ul class="navbar-nav mt-5 text-center small-nav">
                            <li class="nav-item"><a class="nav-link active" href="{{route('index.guest')}}">Home</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#">Top Stories</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Blogs</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>

                            @auth()
                                <li class="nav-item"><a class="nav-link" href="{{route('logout')}}">Logout</a></li>
                            @endauth

                            @guest()
                                <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
                            @endguest

                        </ul>
                        <ul class="footer_ul text-center mt-3 margin-top">
                            <li class="footer_list"><i class="lab la-facebook-f"></i></li>
                            <li class="footer_list"><i class="lab la-twitter"></i></li>
                            <li class="footer_list"><i class="lab la-google-plus"></i></li>
                            <li class="footer_list"><i class="lab la-linkedin-in"></i></li>
                        </ul>
                    </div>
                </div>
            </nav>

        </div>
    </div>

</header>

<div id="page_content">

    <!--HEADER IMAGE-->
    <section id="bg-top-stories-img" class="bg-top-stories-img">
        <div class="overlay"></div>
    </section>

    <section id="search">
        <div class="container">
            <div class="row pt-sm-5">
                <div class="col-12 col-lg-4 order-2 order-md-1">
                    


                    <section id="popular_post">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-0">
                                    {{--poplular post--}}

                                </div>
                            </div>
                        </div>
                    </section>

                    {{--tags--}}
                    <section id="tags">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 pr-0 pl-0">
                                    <div class="outer_tag mt-4">
                                        <h2 class="main_tag">Tags</h2>
                                        <div class="inner_tag">
                                            <div class="tag_text">
                                                @foreach($tags as $tag)
                                                    <span><a href="">{{$tag['title']}}</a></span>
                                                @endforeach


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>


                </div>

                <div class="col-sm-12 col-md-12 col-lg-8 pt-sm-4 pt-md-0 pt-lg-0 order-1 order-md-2">

                @foreach($posts as $post)
                    <!--..................MINIMAL POST....-->
                        <div class="minimal_image mt-sm-10 mt-md-0 mt-lg-0">
                            <section class="min-post">

                                <img src="{{$post->cover}}" alt="Blog Image">
                            </section>
                        </div>
                        <div class="text_minimal">
                            <a class="text-black" href="{{route('single.post.guest',[$post->id,$post->slug])}}">
                                <h2>{{\Illuminate\Support\Str::upper($post->title)}}</h2></a>
                            <div class="display">

                                <p class="badge-pill bg-info">{{$post->created_at->diffForHumans()}}</p>
                                <div class="verticle_line margin_1 bg-black"></div>&nbsp;

                                <p class="badge-pill bg-primary">
                                    {{$post->comments()->where('show',true)->count()}} comments</p>
                                &nbsp;<div class="verticle_line margin bg-black"></div>
                                &nbsp;<h5>
                                    <a href="{{route('get.post.writer' ,$post->writer_id)}}">
                                    {{$post->writer->name}}
                                    </a>
                                </h5>
                            </div>
                            <p class="sub-heading text-grey">
                                {!!\Illuminate\Support\Str::limit($post->body,400) !!}
                            </p>
                            <a href="{{route('single.post.guest',[$post->id,$post->slug])}}"
                               class="btn btn-large btn-primary">Read More</a>
                        </div>
                        <div class="divider1"></div>


                @endforeach


                <!--..........PAGINATION..........-->
                    {{$posts->links()}}


                </div>
            </div>
        </div>
    </section>

    <!--  START FOOTER SECTION  -->
    <section id="footer" class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <ul class="footer_ul">
                        <li class="footer_list"><i class="lab la-facebook-f"></i></li>
                        <li class="footer_list"><i class="lab la-twitter"></i></li>
                        <li class="footer_list"><i class="lab la-google-plus"></i></li>
                        <li class="footer_list"><i class="lab la-linkedin-in"></i></li>
                        <li class="footer_list"><i class="lab la-instagram"></i></li>
                        <li class="footer_list"><i class="las la-envelope"></i></li>
                    </ul>
                    <p class="info footer_text"><i class="far fa-copyright"></i>2020 MegaOne. Made with love by
                        themesindustry</p>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- JavaScript -->
<script src="{{asset('blog/js/bundle.min.js')}}"></script>

<!-- Plugin Js -->
<script src="{{asset('blog/js/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('blog/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('blog/js/jquery.cubeportfolio.min.js')}}"></script>
<!-- REVOLUTION JS FILES -->
<script src="{{asset('blog/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{asset('blog/js/jquery.themepunch.revolution.min.js')}}"></script>

<!-- custom script -->
<script src="{{asset('blog/js/mediaelement-and-player.min.js')}}"></script>
<script src="{{asset('blog/js/wow.min.js')}}"></script>
<script src="{{asset('blog/js/script.js')}}"></script>
</body>
</html>
