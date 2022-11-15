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
                    <div class="row-align">
                        <label for="new_auction_title">Title</label>
                        <input type="text" name="new_auction_title" class="form-control" required>
                    </div>
                    <div class="row-align">
                        <label for="new_auction_category">Category</label>
                        <select name="new_auction_category" class="form-control select-btn" required>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row-align">
                        <label for="new_auction_description">Starting Bid</label>
                        <input type="text" name="new_auction_starting_bid" class="form-control" required>
                    </div>
                    <div class="row-align">
                        <label for="new_auction_description">Description</label>
                        <input type="text" name="new_auction_description" class="form-control">
                    </div>
                    <div class="row-align">
                        <label for="new_auction_end_date">End Date</label>
                        <input type="Date" name="new_auction_end_date" class="form-control" required>
                    </div>

                    <button class="btn add-btn form-control" type="submit">Save</button>
                </form>
                <hr>
            </div>

            <br>

			<footer>
				&copy; ibuy 2019
			</footer>
		</main>

@endsection
