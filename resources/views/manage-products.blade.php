@extends('layouts.main')

@section('head')
    <title>ibuy Admin - Manage Products</title>
@endsection

@section('content')

		<main>
            <h2 class="header">Manage Products</h2>
            <br>
            <div>
                <hr>
                <h3>Add Product Form</h3>
                <hr>
                <form action="{{route('product.save')}}"method="POST">
                    {{ csrf_field() }}
                    {{ method_field('POST')}}
                    <div class="row-align">
                        <label for="new_product_name">Name</label>
                        <input type="text" name="new_product_name" class="form-control">
                    </div>
                    <div class="row-align">
                        <label for="new_product_price">Price</label>
                        <input type="text" name="new_product_price" class="form-control">
                    </div>
                    <div class="row-align">
                        <label for="new_product_category">Category</label>
                        <select name="new_product_category" class="form-control select-btn">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row-align">
                        <label for="new_product_description">Description</label>
                        <input type="text" name="new_product_description" class="form-control">
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
