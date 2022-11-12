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
            <h3>Edit Auction Form</h3>
            <hr>
            <form action="{{route('auction.update', $auction->id)}}"method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH')}}
                <div class="row-align">
                    <label for="new_auction_title">Title</label>
                    <input type="text" name="new_auction_title" class="form-control" value="{{$auction->title}}">
                </div>
                <div class="row-align">
                    <label for="new_auction_category">Category</label>
                    <select name="new_auction_category" class="form-control select-btn">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" @if($selected_category->id == $category->id) selected @endif>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row-align">
                    <label for="new_auction_description">Description</label>
                    <input type="text" name="new_auction_description" class="form-control" value="{{$auction->description}}">
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
