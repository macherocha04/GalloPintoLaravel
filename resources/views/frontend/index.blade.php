@extends('frontend.layouts.master')
@section('title', 'MHAJE || PÁGINA PRINCIPAL')
@section('main-content')
<!-- Área del Carrusel -->
@if(count($banners) > 0)
    <section id="Gslider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($banners as $key => $banner)
                <li data-target="#Gslider" data-slide-to="{{ $key }}" class="{{ ($key == 0 ? 'active' : '') }}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
            @foreach($banners as $key => $banner)
                <div class="carousel-item {{ ($key == 0 ? 'active' : '') }}">
                    <img class="first-slide" src="{{ $banner->photo }}" alt="Primer diapositiva">
                    <div class="carousel-caption d-none d-md-block text-left">
                        <h1 class="wow fadeInDown">{{ $banner->title }}</h1>
                        <p>{!! html_entity_decode($banner->description) !!}</p>
                        <a class="btn btn-lg ws-btn wow fadeInUpBig" href="{{ route('product-grids') }}" role="button">Comprar Ahora<i class="far fa-arrow-alt-circle-right"></i></i></a>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
        </a>
    </section>
@endif

<!--/ Fin del Área del Carrusel -->

<!-- Comienzo de Pequeños Banners -->
<section class="small-banner section">
    <div class="container-fluid">
        <div class="row">
            @php
            $category_lists = DB::table('categories')->where('status', 'activo')->limit(3)->get();
            @endphp
            @if ($category_lists)
                @foreach ($category_lists as $cat)
                    @if ($cat->is_parent == 1)
                        <!-- Banner Individual -->
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-banner">
                                @if ($cat->photo)
                                    <img src="{{ $cat->photo }}" alt="{{ $cat->photo }}">
                                @else
                                    <img src="https://via.placeholder.com/600x370" alt="#">
                                @endif
                                <div class="content">
                                    <h3>{{ $cat->title }}</h3>
                                    <a href="{{ route('product-cat', $cat->slug) }}">Descubrir Ahora</a>
                                </div>
                            </div>
                        </div>
                        <!-- /Fin de Banner Individual -->
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- Fin de Pequeños Banners -->

<!-- Inicio del Área de Productos -->
<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Productos Destacados</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-info">
                    <div class="nav-main">
                        <!-- Pestañas de Navegación -->
                        <ul class="nav nav-tabs filter-tope-group" id="myTab" role="tablist">
                            @php
                                $categories = DB::table('categories')->where('status', 'activo')->where('is_parent', 1)->get();
                            @endphp
                            @if($categories)
                            <button class="btn" style="background: black" data-filter="*">
                                Todos los Productos
                            </button>
                                @foreach($categories as $key => $cat)
                                <button class="btn" style="background: none; color: black;" data-filter=".{{$cat->id}}">
                                    {{$cat->title}}
                                </button>
                                @endforeach
                            @endif
                        </ul>
                        <!--/ Fin de Pestañas de Navegación -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Área de Productos -->
<div class="tab-content isotope-grid" id="myTabContent">
    <!-- Inicio de Pestaña Individual -->
    @if($product_lists)
        @foreach($product_lists as $key => $product)
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{$product->cat_id}}">
            <div class="single-product">
                <div class="product-img">
                    <a href="{{route('product-detail',$product->slug)}}">
                        @php
                            $photo = explode(',',$product->photo);
                        @endphp
                        <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                        <img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                        @if($product->stock <= 0)
                            <span class="out-of-stock">Agotado</span>
                        @elseif($product->condition == 'new')
                            <span class="new">Nuevo</span>
                        @elseif($product->condition == 'hot')
                            <span class="hot">Destacado</span>
                        @else
                            <span class="price-dec">{{$product->discount}}% de descuento</span>
                        @endif
                    </a>
                    <div class="button-head">
                        <div class="product-action">
                            <a data-toggle="modal" data-target="#{{$product->id}}" title="Vista Rápida" href="#"><i class=" ti-eye"></i><span>Vista Rápida</span></a>
                            <a title="Lista de Deseos" href="{{route('add-to-wishlist',$product->slug)}}" ><i class=" ti-heart "></i><span>Añadir a la Lista de Deseos</span></a>
                        </div>
                        <div class="product-action-2">
                            <a title="Agregar al Carrito" href="{{route('add-to-cart',$product->slug)}}">Agregar al Carrito</a>
                        </div>
                    </div>
                </div>
                <div class="product-content">
                    <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                    <div class="product-price">
                        @php
                            $after_discount = ($product->price - ($product->price * $product->discount) / 100);
                        @endphp
                        <span>${{number_format($after_discount,2)}}</span>
                        <del style="padding-left:4%;">${{number_format($product->price,2)}}</del>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    <!--/ Fin de Pestaña Individual -->
    @endif

                        <!--/ Fin de Pestaña Individual -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Fin del Área de Productos -->
{{-- @php
    $featured=DB::table('products')->where('is_featured',1)->where('status','active')->orderBy('id','DESC')->limit(1)->get();
@endphp --}}
<!-- Inicio de Banner Mediano -->
<section class="midium-banner">
    <div class="container">
        <div class="row">
            @if($featured)
                @foreach($featured as $data)
                    <!-- Un Solo Banner  -->
                    <div class="col-lg-6 col-md-6 col-12">
                        <div un solo-banner>
                            @php
                                $photo=explode(',',$data->photo);
                            @endphp
                            <img src="{{$photo[0]}}" alt="{{$photo[0]}}">
                            <div class="contenido">
                                <p>{{$data->cat_info['title']}}</p>
                                <h3>{{$data->title}} <br>Hasta<span> {{$data->discount}}%</span></h3>
                                <a href="{{route('product-detail',$data->slug)}}">Comprar Ahora</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Fin de Un Solo Banner -->
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- Fin de Banner Mediano -->


<!-- Inicio de los Productos Más Populares -->
<div class="product-area most-popular section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Hot Item</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel popular-slider">
                    @foreach($product_lists as $product)
                        @if($product->condition == 'hot')
                            <!-- Inicio de Producto Individual -->
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{route('product-detail',$product->slug)}}">
                                        @php
                                            $photo = explode(',',$product->photo);
                                        @endphp
                                        <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                        <img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                    </a>
                                    <div class="button-head">
                                        <div class="product-action">
                                            <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                            <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}" ><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                        </div>
                                        <div class="product-action-2">
                                            <a href="{{route('add-to-cart',$product->slug)}}">Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                    <div class="product-price">
                                        <span class="old">${{number_format($product->price,2)}}</span>
                                        @php
                                        $after_discount=($product->price-($product->price*$product->discount)/100)
                                        @endphp
                                        <span>${{number_format($after_discount,2)}}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin de Producto Individual -->
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin de los Productos Más Populares -->

<!-- Inicio de la Lista de Productos de la Tienda en Casa -->
<section class="shop-home-list section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="shop-section-title">
                            <h1>Últimos Artículos</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @php
                        $product_lists=DB::table('products')->where('status','active')->orderBy('id','DESC')->limit(6)->get();
                    @endphp
                    @foreach($product_lists as $product)
                        <div class="col-md-4">
                            <!-- Inicio de Elemento Individual de la Lista -->
                            <div class="single-list">
                                <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="list-image overlay">
                                        @php
                                            $photo=explode(',',$product->photo);
                                            // dd($photo);
                                        @endphp
                                        <img src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                        <a href="{{route('add-to-cart',$product->slug)}}" class="buy"><i class="fa fa-shopping-bag"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 no-padding">
                                    <div class="content">
                                        <h4 class="title"><a href="#">{{$product->title}}</a></h4>
                                        <p class="price with-discount">${{number_format($product->discount,2)}}</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- Fin de Elemento Individual de la Lista -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Fin de la Lista de Productos de la Tienda en Casa -->


<!-- Inicio del Blog de la Tienda -->
<section class="shop-blog section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Desde Nuestro Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @if($posts)
                @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Inicio de Entrada Individual del Blog -->
                        <div class="shop-single-blog">
                            <img src="{{$post->photo}}" alt="{{$post->photo}}">
                            <div class="content">
                                <p class="date">{{$post->created_at->format('d M , Y. D')}}</p>
                                <a href="{{route('blog.detail',$post->slug)}}" class="title">{{$post->title}}</a>
                                <a href="{{route('blog.detail',$post->slug)}}" class="more-btn">Continuar Leyendo</a>
                            </div>
                        </div>
                        <!-- Fin de Entrada Individual del Blog -->
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- Fin del Blog de la Tienda -->


<!-- Inicio del Área de Servicios de la Tienda -->
<section class="shop-services section home">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Inicio del Servicio Individual -->
                <div class="single-service">
                    <i class="ti-rocket"></i>
                    <h4>Envío Gratuito</h4>
                    <p>Pedidos superiores a $100</p>
                </div>
                <!-- Fin del Servicio Individual -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Inicio del Servicio Individual -->
                <div class="single-service">
                    <i class="ti-reload"></i>
                    <h4>Devolución Gratuita</h4>
                    <p>Devoluciones en un plazo de 30 días</p>
                </div>
                <!-- Fin del Servicio Individual -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Inicio del Servicio Individual -->
                <div class "single-service">
                    <i class="ti-lock"></i>
                    <h4>Pago Seguro</h4>
                    <p>Pago 100% seguro</p>
                </div>
                <!-- Fin del Servicio Individual -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Inicio del Servicio Individual -->
                <div class="single-service">
                    <i class="ti-tag"></i>
                    <h4>Mejor Precio</h4>
                    <p>Precio garantizado</p>
                </div>
                <!-- Fin del Servicio Individual -->
            </div>
        </div>
    </div>
</section>
<!-- Fin del Área de Servicios de la Tienda -->


@include('frontend.layouts.newsletter')

<!-- Ventana Modal -->
@if($product_lists)
    @foreach($product_lists as $key=>$product)
        <div class="modal fade" id="{{$product->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span class="ti-close" aria-hidden="true"></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row no-gutters">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <!-- Carrusel de Producto -->
                                        <div class="product-gallery">
                                            <div class="quickview-slider-active">
                                                @php
                                                    $photo=explode(',',$product->photo);
                                                // dd($photo);
                                                @endphp
                                                @foreach($photo as $data)
                                                    <div class="single-slider">
                                                        <img src="{{$data}}" alt="{{$data}}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    <!-- Fin del Carrusel de Producto -->
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
    <div class="quickview-content">
        <h2>{{$product->title}}</h2>
        <div class="quickview-ratting-review">
            <div class="quickview-ratting-wrap">
                <div class="quickview-ratting">
                    {{-- <i class="yellow fa fa-star"></i>
                    <i class="yellow fa fa-star"></i>
                    <i class="yellow fa fa-star"></i>
                    <i class="yellow fa fa-star"></i>
                    <i class="fa fa-star"></i> --}}
                    @php
                        $rate=DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
                        $rate_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
                    @endphp
                    @for($i=1; $i<=5; $i++)
                        @if($rate>=$i)
                            <i class="yellow fa fa-star"></i>
                        @else
                        <i class="fa fa-star"></i>
                        @endif
                    @endfor
                </div>
                <a href="#"> ({{$rate_count}} reseñas de clientes)</a>
            </div>
            <div class="quickview-stock">
                @if($product->stock >0)
                <span><i class="fa fa-check-circle-o"></i> {{$product->stock}} en stock</span>
                @else
                <span><i class="fa fa-times-circle-o text-danger"></i> {{$product->stock}} fuera de stock</span>
                @endif
            </div>
        </div>
        @php
            $after_discount=($product->price-($product->price*$product->discount)/100);
        @endphp
        <h3><small><del class="text-muted">${{number_format($product->price,2)}}</del></small>    ${{number_format($after_discount,2)}}  </h3>
        <div class="quickview-peragraph">
            <p>{!! html_entity_decode($product->summary) !!}</p>
        </div>
        @if($product->size)
            <div class="size">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <h5 class="title">Tamaño</h5>
                        <select>
                            @php
                            $sizes=explode(',',$product->size);
                            // dd($sizes);
                            @endphp
                            @foreach($sizes as $size)
                                <option>{{$size}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-lg-6 col-12">
                        <h5 class="title">Color</h5>
                        <select>
                            <option selected="selected">naranja</option>
                            <option>morado</option>
                            <option>negro</option>
                            <option>rosa</option>
                        </select>
                    </div> --}}
                </div>
            </div>
        @endif
        <form action="{{route('single-add-to-cart')}}" method="POST" class="mt-4">
            @csrf
            <div class="quantity">

                                                <!-- Sección de Cantidad -->
<div class="input-group">
    <div class="button minus">
        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
            <i class="ti-minus"></i>
        </button>
    </div>
    <input type="hidden" name="slug" value="{{$product->slug}}">
    <input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1">
    <div class="button plus">
        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
            <i class="ti-plus"></i>
        </button>
    </div>
</div>
<!--/ Fin de la Sección de Cantidad -->
</div>
<div class="add-to-cart">
    <button type="submit" class="btn">Agregar al carrito</button>
    <a href="{{route('add-to-wishlist',$product->slug)}}" class="btn min"><i class="ti-heart"></i></a>
</div>
</form>
<div class="default-social">
    <!-- Compartir en redes sociales BEGIN --><div class="sharethis-inline-share-buttons"></div><!-- Compartir en redes sociales END -->
</div>
</div>
</div>
</div>
</div>
</div>
    @endforeach
@endif
<!-- Fin del Modal -->
@endsection

@push('styles')
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
    <style>
        /* Deslizamiento del Banner */
        #Gslider .carousel-inner {
            background: #000000;
            color: negro;
        }

        #Gslider .carousel-inner {
            height: 550px;
        }
        #Gslider .carousel-inner img {
            width: 100% !important;
            opacity: .8;
        }

        #Gslider .carousel-inner .carousel-caption {
            bottom: 60%;
        }

        #Gslider .carousel-inner .carousel-caption h1 {
            font-size: 50px;
            font-weight: negrita;
            line-height: 100%;
            color: #F7941D;
        }

        #Gslider .carousel-inner .carousel-caption p {
            font-size: 18px;
            color: negro;
            margin: 28px 0 28px 0;
        }

        #Gslider .carousel-indicators {
            bottom: 70px;
        }
    </style>
@endpush


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>

    /*==================================================================
    [ Isotope ]*/
    var $contenedorTope = $('.isotope-grid');
    var $filtro = $('.filter-tope-group');

    // Filtrar elementos al hacer clic en un botón
    $filtro.each(function () {
        $filtro.on('click', 'button', function () {
            var valorFiltro = $(this).attr('data-filter');
            $contenedorTope.isotope({ filter: valorFiltro });
        });
    });

    // Inicializar Isotope
    $(window).on('load', function () {
        var $cuadricula = $contenedorTope.each(function () {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine: 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var botonesIsotope = $('.filter-tope-group button');

    $(botonesIsotope).each(function () {
        $(this).on('click', function () {
            for (var i = 0; i < botonesIsotope.length; i++) {
                $(botonesIsotope[i]).removeClass('how-active1');
            }
            $(this).addClass('how-active1');
        });
    });
</script>
<script>
     function cancelarPantallaCompleta(el) {
        var metodoCancelar = el.cancelFullScreen || el.webkitCancelFullScreen || el.mozCancelFullScreen || el.exitFullscreen;
        if (metodoCancelar) { // cancelar pantalla completa.
            metodoCancelar.call(el);
        } else if (typeof window.ActiveXObject !== "undefined") { // IE antiguo.
            var wscript = new ActiveXObject("WScript.Shell");
            if (wscript !== null) {
                wscript.SendKeys("{F11}");
            }
        }
    }

    function solicitarPantallaCompleta(el) {
        // Compatible con la mayoría de los navegadores y sus versiones.
        var metodoSolicitar = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;

        if (metodoSolicitar) { // Pantalla completa nativa.
            metodoSolicitar.call(el);
        } else if (typeof window.ActiveXObject !== "undefined") { // IE antiguo.
            var wscript = new ActiveXObject("WScript.Shell");
            if (wscript !== null) {
                wscript.SendKeys("{F11}");
            }
        }
        return false;
    }
</script>
@endpush

