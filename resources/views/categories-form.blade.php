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

            <button class="btn add-btn"></button>

            <h1>Add Category Page</h1>

            <hr />
            <h1>Category Form</h1>

            <form action="#">
                <label>Category Name</label> <input type="text" name="category_name" />
                <label>Another Text box</label> <input type="text" />
                <input type="checkbox" /> <label>Checkbox</label>
                <input type="radio" /> <label>Radio</label>
                <input type="submit" value="Submit" />

            </form>



			<footer>
				&copy; ibuy 2019
			</footer>
		</main>
{{--</html>--}}
@endsection
