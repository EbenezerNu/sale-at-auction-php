@extends('layouts.main')

@section('head')
    <title>ibuy Auctions</title>
@endsection

@section('content')
{{--<!DOCTYPE html>
<html>--}}

		<header>
			<h1><span class="i">i</span><span class="b">b</span><span class="u">u</span><span class="y">y</span></h1>

			<form action="{{route('home')}}">
				<input type="text" name="search" placeholder="Search for anything" value="{{$keyword}}"/>
				<input type="submit" name="submit" value="Search" />
			</form>
		</header>

		<nav id="ibuy_nav">
			<ul>
                @foreach(  $categories as $category)
				    <li><a class="categoryLink @if($selected_category == $category->id) active @endif " href="{{route('filter-category', $category->id)}}">{{$category->name}}</a></li>
                @endforeach
			</ul>
		</nav>
		<img src="{{asset('public/assets/banners/1.jpg')}}" alt="Banner" />

		<main>

			<h1>Latest Listings / Search Results / Category listing</h1>

			<ul class="productList">
                @foreach(  $products as $product)
                    <li>
                        <img src="{{asset('public/assets/product.png')}}" alt="{{$product->name}}">
                        <article>
                            <h2>{{$product->name}}</h2>
                            <h3>{{$product->category->name}}</h3>
                            <p>{{$product->description}}
                            <p class="price">Current bid: £{{$product->price}}</p>
                            <a href="{{ route('product.view', $product->id)}}" class="more auctionLink">More &gt;&gt;</a>
                        </article>
                    </li>
                @endforeach
				{{--<li>
					<img src="{{asset('public/assets/product.png')}}" alt="product name">
					<article>
						<h2>Product name</h2>
						<h3>Product category</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales ornare purus, non laoreet dolor sagittis id. Vestibulum lobortis laoreet nibh, eu luctus purus volutpat sit amet. Proin nec iaculis nulla. Vivamus nec tempus quam, sed dapibus massa. Etiam metus nunc, cursus vitae ex nec, scelerisque dapibus eros. Donec ac diam a ipsum accumsan aliquet non quis orci. Etiam in sapien non erat dapibus rhoncus porta at lorem. Suspendisse est urna, egestas ut purus quis, facilisis porta tellus. Pellentesque luctus dolor ut quam luctus, nec porttitor risus dictum. Aliquam sed arcu vehicula, tempor velit consectetur, feugiat mauris. Sed non pellentesque quam. Integer in tempus enim.</p>

						<p class="price">Current bid: £123.45</p>
						<a href="#" class="more auctionLink">More &gt;&gt;</a>
					</article>
				</li>
				<li>
					<img src="{{asset('public/assets/product.png')}}" alt="product name">
					<article>
						<h2>Product name</h2>
						<h3>Product category</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales ornare purus, non laoreet dolor sagittis id. Vestibulum lobortis laoreet nibh, eu luctus purus volutpat sit amet. Proin nec iaculis nulla. Vivamus nec tempus quam, sed dapibus massa. Etiam metus nunc, cursus vitae ex nec, scelerisque dapibus eros. Donec ac diam a ipsum accumsan aliquet non quis orci. Etiam in sapien non erat dapibus rhoncus porta at lorem. Suspendisse est urna, egestas ut purus quis, facilisis porta tellus. Pellentesque luctus dolor ut quam luctus, nec porttitor risus dictum. Aliquam sed arcu vehicula, tempor velit consectetur, feugiat mauris. Sed non pellentesque quam. Integer in tempus enim.</p>

						<p class="price">Current bid: £123.45</p>
						<a href="#" class="more auctionLink">More &gt;&gt;</a>
					</article>
				</li>--}}
			</ul>

			<hr />

			{{--<h1>Product Page</h1>
			<article class="product">

					<img src="{{asset('public/assets/product.png')}}" alt="product name">
					<section class="details">
						<h2>Product name</h2>
						<h3>Product category</h3>
						<p>Auction created by <a href="#">User.Name</a></p>
						<p class="price">Current bid: £123.45</p>
						<time>Time left: 8 hours 3 minutes</time>
						<form action="#" class="bid">
							<input type="text" name="bid" placeholder="Enter bid amount" />
							<input type="submit" value="Place bid" />
						</form>
					</section>
					<section class="description">
					<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales ornare purus, non laoreet dolor sagittis id. Vestibulum lobortis laoreet nibh, eu luctus purus volutpat sit amet. Proin nec iaculis nulla. Vivamus nec tempus quam, sed dapibus massa. Etiam metus nunc, cursus vitae ex nec, scelerisque dapibus eros. Donec ac diam a ipsum accumsan aliquet non quis orci. Etiam in sapien non erat dapibus rhoncus porta at lorem. Suspendisse est urna, egestas ut purus quis, facilisis porta tellus. Pellentesque luctus dolor ut quam luctus, nec porttitor risus dictum. Aliquam sed arcu vehicula, tempor velit consectetur, feugiat mauris. Sed non pellentesque quam. Integer in tempus enim.</p>


					</section>

					<section class="reviews">
						<h2>Reviews of User.Name </h2>
						<ul>
							<li><strong>Ali said </strong> great ibuyer! Product as advertised and delivery was quick <em>29/09/2019</em></li>
							<li><strong>Dave said </strong> disappointing, product was slightly damaged and arrived slowly.<em>22/07/2019</em></li>
							<li><strong>Susan said </strong> great value but the delivery was slow <em>22/07/2019</em></li>

						</ul>

						<form>
							<label>Add your review</label> <textarea name="reviewtext"></textarea>

							<input type="submit" name="submit" value="Add Review" />
						</form>
					</section>
					</article>

					<hr />
					<h1>Sample Form</h1>

					<form action="#">
						<label>Text box</label> <input type="text" />
						<label>Another Text box</label> <input type="text" />
						<input type="checkbox" /> <label>Checkbox</label>
						<input type="radio" /> <label>Radio</label>
						<input type="submit" value="Submit" />

					</form>--}}



			<footer>
				&copy; ibuy 2019
			</footer>
		</main>
{{--</html>--}}
@endsection
