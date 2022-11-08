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
            <h3>Edit Product Form</h3>
            <hr>
            <form action="{{route('product.edit', $product->id)}}"method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH')}}
                <div class="row-align">
                    <label for="new_product_name">Name</label>
                    <input type="text" name="new_product_name" class="form-control" value="{{$product->name}}">
                </div>
                <div class="row-align">
                    <label for="new_product_description">Description</label>
                    <input type="text" name="new_product_description" class="form-control" value="{{$product->description}}">
                </div>

                <button class="btn add-btn form-control" type="submit">Save</button>
            </form>
            <hr>
        </div>



        <footer>
            &copy; ibuy 2019
        </footer>
    </main>

@endsection
