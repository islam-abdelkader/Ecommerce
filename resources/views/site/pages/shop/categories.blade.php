@extends('layouts.site')
@section('title')
    Shop
@endsection
@section('content')
    <div class="page-content">
				<!--start breadcrumb-->
				@include('site.includes.shop.header')
				<!--end breadcrumb-->
				<!--start shop categories-->
				<section class="py-4">
					<div class="container">
						<div class="product-categories">
							<div class="row row-cols-1 row-cols-lg-4">
                            @if ($categories)
                                @foreach ($categories as $category )
                                @include('site.includes.category.category-card')
                                @endforeach
                            @endif
                            </div>
							<!--end row-->
						</div>
					</div>
				</section>
				<!--end shop categories-->
			</div>
@endsection