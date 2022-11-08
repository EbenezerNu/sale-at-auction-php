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

        <h2 class="header">Manage Categories</h2>
        <br>
        <div>
            <hr>
            <h3>Edit Category Form</h3>
            <hr>
            <form action="{{route('category.edit', $category->id)}}"method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH')}}
                <div class="row-align">
                    <label for="new_category_name">Name</label>
                    <input type="text" name="new_category_name" class="form-control" value="{{$category->name}}">
                </div>
                <div class="row-align">
                    <label for="new_category_description">Description</label>
                    <input type="text" name="new_category_description" class="form-control" value="{{$category->description}}">
                </div>

                <button class="btn add-btn form-control" type="submit">Save</button>
            </form>
            <hr>
        </div>



        <footer>
            &copy; ibuy 2019
        </footer>
    </main>
    {{--</html>--}}
@endsection
