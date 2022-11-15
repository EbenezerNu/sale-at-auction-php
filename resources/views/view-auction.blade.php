@extends('layouts.main')

@section('head')
    <title>ibuy Admin - Manage Auctions</title>
@endsection

@section('content')

		<main>
            <h2 class="header">Manage Auctions</h2>
            <br>
            <div>
                <hr>
                <h1>Auction Page</h1>
            </div>

            <br>
            {{--<ul class="productList">
                <li>
                    <img src="{{asset('public/assets/product.png')}}" alt="{{$auction->name}}">
                    <article>
                        <h2>{{$auction->name}}</h2>
                        <h3>{{$auction->category->name}}</h3>
                        <p>{{$auction->description}}
                        <p class="price">Current bid: £{{$auction->price}}</p>
                    </article>
                </li>
            </ul>--}}

            <img src="{{asset('public/assets/product.png')}}" alt="{{$auction->name}}">
            <section class="details">
                <h2>{{$auction->name}}</h2>
                <h3>{{$auction->category->name}}</h3>
                <p>Auction created by <a href="#">{{$auction->createdBy}}</a></p>
                <p class="price">Current bid: £{{$auction->price}}</p>
                <time>Time left: {{$bid_hour}} hours {{$bid_minute}} minutes</time>
                <form action="{{route('auction.bid', $auction->id)}}" method="POST" class="bid">
                    {{ csrf_field() }}
                    <input type="text" name="bid" placeholder="Enter bid amount" />
                    <input type="submit" value="Place bid" />
                </form>
            </section>
            <section class="description">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales ornare purus, non laoreet dolor sagittis id. Vestibulum lobortis laoreet nibh, eu luctus purus volutpat sit amet. Proin nec iaculis nulla. Vivamus nec tempus quam, sed dapibus massa. Etiam metus nunc, cursus vitae ex nec, scelerisque dapibus eros. Donec ac diam a ipsum accumsan aliquet non quis orci. Etiam in sapien non erat dapibus rhoncus porta at lorem. Suspendisse est urna, egestas ut purus quis, facilisis porta tellus. Pellentesque luctus dolor ut quam luctus, nec porttitor risus dictum. Aliquam sed arcu vehicula, tempor velit consectetur, feugiat mauris. Sed non pellentesque quam. Integer in tempus enim.</p>

            </section>
            <hr />
            <br>
            <article class="product">

                <section class="reviews">

                    <h2>Reviews of {{ Auth::user()->name }}</h2>
                    <ul>
                        @foreach($reviews as $review)
                            <li><strong>{{$review->createdby}} said </strong> {{$review->description}} <em>{{$review->createdAt}}</em></li>
                        @endforeach

                    </ul>

                    <form action="{{route('reviews.save', $auction->id)}}"method="POST">
                        {{ csrf_field() }}
                        <label>Add your review</label> <textarea name="reviewtext"></textarea>

                        <input type="submit" name="submit" value="Add Review" />
                    </form>
                </section>

            </article>

            <article class="product">

                {{--<img src="{{asset('public/assets/product.png')}}" alt="{{$product->name}}">
                <section class="details">
                    <h2>{{$product->name}}</h2>
                    <h3>{{$product->category->name}}</h3>
                    <p>Auction created by <a href="#">User.Name</a></p>
                    <p class="price">Current bid: £{{$product->price}}</p>
                    <time>Time left: 8 hours 3 minutes</time>
                    <form action="#" class="bid">
                        <input type="text" name="bid" placeholder="Enter bid amount" />
                        <input type="submit" value="Place bid" />
                    </form>
                </section>
                <section class="description">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales ornare purus, non laoreet dolor sagittis id. Vestibulum lobortis laoreet nibh, eu luctus purus volutpat sit amet. Proin nec iaculis nulla. Vivamus nec tempus quam, sed dapibus massa. Etiam metus nunc, cursus vitae ex nec, scelerisque dapibus eros. Donec ac diam a ipsum accumsan aliquet non quis orci. Etiam in sapien non erat dapibus rhoncus porta at lorem. Suspendisse est urna, egestas ut purus quis, facilisis porta tellus. Pellentesque luctus dolor ut quam luctus, nec porttitor risus dictum. Aliquam sed arcu vehicula, tempor velit consectetur, feugiat mauris. Sed non pellentesque quam. Integer in tempus enim.</p>

                </section>--}}

            </article>

			<footer>
				&copy; ibuy 2019
			</footer>
		</main>

@endsection
