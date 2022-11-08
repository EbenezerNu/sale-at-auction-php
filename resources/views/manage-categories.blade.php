@extends('layouts.main')

@section('head')
    <title>ibuy Admin - Manage Categories</title>
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
            <h2 class="header">Manage Categories</h2>
            <br>
            <div>
                <hr>
                <h3>Add Category Form</h3>
                <hr>
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
                <hr>
            </div>

            <br>
            <div class="row">
                <hr>
                <h3>Available Categories</h3>

			    <ul class="productList">
                @foreach(  $categories as $category)
                    <hr />
                    <li class="row category-list">
                        <input value="{{$category->name}}" type="text" disabled class="form-control category-name">
                        <button class="btn edit-btn form-control"><a class="categoryLink" href="{{route('category.edit.form', $category->id)}}">Edit</a></button>
                        <form action="{{route('category.delete', $category->id)}}"method="POST" class="delete-btn-form">
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
{{--</html>--}}
@endsection
