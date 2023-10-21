@extends('frontend.layouts.master')
@section('MHAJE','Página de Lista de Deseos')
@section('main-content')
	<!-- Migas de Pan -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{('home')}}">Inicio<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="javascript:void(0);">Lista de Deseos</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin de Migas de Pan -->
			
	<!-- Carrito de Compras -->
	<div class="shopping-cart section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Resumen del Carrito de Compras -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th>PRODUCTO</th>
								<th>NOMBRE</th>
								<th class="text-center">TOTAL</th> 
								<th class="text-center">AGREGAR AL CARRITO</th> 
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody>
							@if(Helper::getAllProductFromWishlist())
								@foreach(Helper::getAllProductFromWishlist() as $key=>$wishlist)
									<tr>
										@php 
											$photo=explode(',',$wishlist->product['photo']);
										@endphp
										<td class="image" data-title="No"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></td>
										<td class="product-des" data-title="Descripción">
											<p class="product-name"><a href="{{route('product-detail',$wishlist->product['slug'])}}">{{$wishlist->product['title']}}</a></p>
											<p class="product-des">{!!($wishlist['summary']) !!}</p>
										</td>
										<td class="total-amount" data-title="Total"><span>${{$wishlist['amount']}}</span></td>
										<td><a href="{{route('add-to-cart',$wishlist->product['slug'])}}" class='btn text-white'>Agregar al Carrito</a></td>
										<td class="action" data-title="Eliminar"><a href="{{route('wishlist-delete',$wishlist->id)}}"><i class="ti-trash remove-icon"></i></a></td>
									</tr>
								@endforeach
							@else 
								<tr>
									<td class="text-center">
										No hay elementos en la lista de deseos. <a href="{{route('product-grids')}}" style="color:blue;">Continuar comprando</a>
									</td>
								</tr>
							@endif
						</tbody>
					</table>
					<!--/ Fin del Resumen del Carrito de Compras -->
				</div>
			</div>
		</div>
	</div>
	<!--/ Fin del Carrito de Compras -->
```


			
	<!-- Inicio de la Sección de Servicios de Tienda -->
	<section class="shop-services section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Inicio de Servicio Individual -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Envío gratuito</h4>
                <p>En pedidos superiores a $100</p>
					</div>
					<!-- Fin de Servicio Individual -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Inicio de Servicio Individual -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Devolución gratuita</h4>
                <p>Devoluciones en un plazo de 30 días</p>
					</div>
					<!-- Fin de Servicio Individual -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Inicio de Servicio Individual -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Pago seguro</h4>
                <p>Pago 100% seguro</p>
					</div>
					<!-- Fin de Servicio Individual -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Inicio de Servicio Individual -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Mejor precio</h4>
                <p>Precio garantizado</p>
					</div>
					<!-- Fin de Servicio Individual -->
				</div>
			</div>
		</div>
	</section>
	<!-- Fin de la Sección de Servicios de Tienda -->

	
	@include('frontend.layouts.newsletter')
	
	
	
	<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span class="ti-close" aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <div class="row no-gutters">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <!-- Deslizador de Producto -->
                        <div class="product-gallery">
                            <div class="quickview-slider-active">
                                <div class="single-slider">
                                    <img src="images/modal1.jpg" alt="#">
                                </div>
                                <div class="single-slider">
                                    <img src="images/modal2.jpg" alt="#">
                                </div>
                                <div class="single-slider">
                                    <img src="images/modal3.jpg" alt="#">
                                </div>
                                <div class="single-slider">
                                    <img src="images/modal4.jpg" alt="#">
                                </div>
                            </div>
                        </div>
                        <!-- Fin de Deslizador de Producto -->
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="quickview-content">
                            <h2>Vestido de Cambio Acampanado</h2>
                            <div class="quickview-ratting-review">
                                <div class="quickview-ratting-wrap">
                                    <div class="quickview-ratting">
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <a href="#"> (1 opinión de cliente)</a>
                                </div>
                                <div class="quickview-stock">
                                    <span><i class="fa fa-check-circle-o"></i> en stock</span>
                                </div>
                            </div>
                            <h3>$29.00</h3>
                            <div class="quickview-peragraph">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam.</p>
                            </div>
                            <div class="size">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <h5 class="title">Tamaño</h5>
                                        <select>
                                            <option selected="selected">s</option>
                                            <option>m</option>
                                            <option>l</option>
                                            <option>xl</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <h5 class="title">Color</h5>
                                        <select>
                                            <option selected="selected">naranja</option>
                                            <option>morado</option>
                                            <option>negro</option>
                                            <option>rosa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="quantity">

										<!-- Input Order -->
<div class="input-group">
    <div class="button minus">
        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
            <i class="ti-minus"></i>
        </button>
    </div>
    <input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000" value="1">
    <div class="button plus">
        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
            <i class="ti-plus"></i>
        </button>
    </div>
</div>
<!--/ End Input Order -->
</div>
<div class="add-to-cart">
    <a href="#" class="btn">Agregar al carrito</a>
    <a href="#" class="btn min"><i class="ti-heart"></i></a>
    <a href="#" class="btn min"><i class="fa fa-compress"></i></a>
</div>
<div class="default-social">
    <h4 class="share-now">Compartir:</h4>
    <ul>
        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
        <li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
    </ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Fin del Modal -->

	
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@endpush