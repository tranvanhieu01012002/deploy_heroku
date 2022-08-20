@extends('Layouts.master')
@section('content')
<div class="rev-slider">
	<div class="fullwidthbanner-container">
					<div class="fullwidthbanner">
						<div class="bannercontainer" >
					    <div class="banner" >
								<ul>
									<!-- THE FIRST SLIDE -->
									@foreach ($slides as $item)
										<li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
											<div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
															<div class="tp-bgimg defaultimg" 
															data-lazyload="undefined" 
															data-bgfit="cover" 
															data-bgposition="center center" 
															data-bgrepeat="no-repeat" 
															data-lazydone="undefined" 
															src="source/image/slide/{{$item->image}}" 
															        
															style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('source/image/slide/{{$item->image}}'); 
															background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
															</div>
														</div>
		
											</li>
									@endforeach
								</ul>
							</div>
						</div>

						<div class="tp-bannertimer"></div>
					</div>
				</div>
				<!--slider-->
	</div>
	{{Session::has("status")?Session::get("status"):""}}
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>New Products</h4>
							<div class="beta-products-details">
								<p class="pull-left">co: {{count(isset($cakes)?$cakes:0)}}</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach ($cakes as $cake)
								<div class="col-sm-3">
									<div class="single-item">
										<div class="single-item-header">
											<a href="product.html"><img width="100%" height="20%" src={{env('APP_URL').'/image/product/'.$cake->image}} alt="test"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$cake->name}}</p>
											<p class="single-item-price">
												@if ($cake->promotion_price != 0)
												<span class="flash-del">${{$cake->unit_price}}</span>
												<span class="flash-sale">${{$cake->promotion_price}}</span>
												@else
													<span>${{$cake->unit_price}}</span>
												@endif
											
												
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{route('addToCart',$cake->id)}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('shop.show',$cake->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
							{{ $cakes->links() }}
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Top Products</h4>
							<div class="beta-products-details">
								<p class="pull-left">{{count(isset($cakesFull)?$cakesFull:0)}} styles found</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
							@foreach ($cakesFull as $cake)
							<div class="col-sm-3">
								<div class="single-item">
									<div class="single-item-header">
										<a href="product.html"><img height="20%" width="100%" src={{env('APP_URL').'/image/product/'.$cake->image}} alt="test"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$cake->name}}</p>
										<p class="single-item-price">
											@if ($cake->promotion_price != 0)
											<span class="flash-del">${{$cake->unit_price}}</span>
											<span class="flash-sale">${{$cake->promotion_price}}</span>
											@else
												<span>${{$cake->unit_price}}</span>
											@endif
										
											
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="/add-to-cart/{{$cake->id}}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{route('shop.show',$cake->id)}}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							
								@endforeach
							</div>
							{{ $cakesFull->links() }}
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->
			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->

@endsection