@extends('layouts.main')

@section('head')
    <title>ibuy Admin - Manage Auction</title>
@endsection

@section('content')

		<main>
            <h2 class="header">Manage Auction</h2>
            <br>
            <div>
                <hr>
                <h3>Add Auction Form</h3>
                <hr>
                <form action="{{route('auction.save')}}"method="POST">
                    {{ csrf_field() }}
                    {{ method_field('POST')}}
                    {{--<div class="row-align">
                        <label for="new_auction_name">Name</label>
                        <input type="text" name="new_auction_name" class="form-control">
                    </div>--}}
                    <div class="row-align">
                        <label for="new_auction_price">Price</label>
                        <input type="text" name="new_auction_price" class="form-control">
                    </div>
                    <div class="row-align">
                        <label for="new_product_category">Category</label>
                        <input type="text" name="new_product_category" class="form-control" value="{{$category->name}}">
                    </div>
                    <div class="row-align">
                        <label for="new_auction_end_date">End Date</label>
                        <input type="Date" name="new_auction_end_date" class="form-control">
                    </div>

                    <button class="btn add-btn form-control" type="submit">Save</button>
                </form>
                <hr>
            </div>

            <br>
            <div class="row">
                <hr>
                <h3>Available Products</h3>

			    <ul class="productList">
                @foreach(  $products as $product)
                    <hr />
                    <li class="row product-list">
                        <input value="{{$product->name}}" type="text" disabled class="form-control product-name">
                        <input value="{{$product->category->name}}" type="text" disabled class="form-control product-category-name">
                        <input value="{{$product->price}}" type="text" disabled class="form-control product-price">
                        <button class="btn edit-btn form-control"><a class="productLink" href="{{route('product.edit.form', $product->id)}}">Edit</a></button>
                        <form action="{{route('product.delete', $product->id)}}"method="POST" class="delete-btn-form">
                            {{ csrf_field() }}
                            {{ method_field('DELETE')}}
                            <button type="submit" class="btn delete-btn form-control">Delete</button>
                        </form>
                    </li>
                @endforeach
			</ul>

                <hr>
            </div>



			<footer>
				&copy; ibuy 2019
			</footer>
		</main>

@endsection
