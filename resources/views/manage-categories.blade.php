@extends('layouts.main')

@section('head')
    <title>ibuy Auctions</title>
@endsection

@section('content')
{{--<!DOCTYPE html>
<html>--}}

		{{--<header>
			<h1><span class="i">i</span><span class="b">b</span><span class="u">u</span><span class="y">y</span></h1>

			<form action="#">
				<input type="text" name="search" placeholder="Search for anything" />
				<input type="submit" name="submit" value="Search" />
			</form>
		</header>--}}

{{--
		<nav id="ibuy_nav">
			<ul>
                @foreach(  $categories as $category)
				    <li><a class="categoryLink" href="#">{{$category->name}}</a></li>
                @endforeach
			</ul>
		</nav>
		<img src="{{asset('public/assets/banners/1.jpg')}}" alt="Banner" />


--}}

		<main>

			<h1>Manage Categories</h1>

            <form action="{{route('category.save')}}"method="POST">
                {{ csrf_field() }}
                {{ method_field('POST')}}
                <div class="row-align">
                    <label for="new_category_name">Name</label>
                    <input type="text" name="new_category_name" class="form-control">
                </div>
                <div class="row-align">
                    <label for="new_category_description">Description</label>
                    <input type="text" name="new_category_description" class="form-control">
                </div>

                <button class="btn add-btn form-control" type="submit">Save</button>
            </form>

			<ul class="productList">
                @foreach(  $categories as $category)
                    <li class="row category-list">
                        <input value="{{$category->name}}" type="text" disabled class="form-control category-name">
                        <button class="btn edit-btn form-control"><a class="categoryLink" href="{{route('category.edit', $category->id)}}">Edit</a></button>
                        <form action="{{route('category.delete', $category->id)}}"method="POST" class="delete-btn-form">
                            {{ csrf_field() }}
                            {{ method_field('DELETE')}}
                            <button type="submit" class="btn delete-btn form-control">Delete</button>
                        </form>
                    </li>
                    <hr />
                @endforeach
			</ul>




			<footer>
				&copy; ibuy 2019
			</footer>
		</main>
{{--</html>--}}
@endsection
