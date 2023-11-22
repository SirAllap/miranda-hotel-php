@extends('layout')
@section('title', 'About Us')

@section('content')

<main class="room-details-intro">
	<div class="room-details-intro__text">
		<section class="room-details-intro__head-section">
			<h5 class="room-details-intro__head-text subtitle-trigger">
				THE ULTIMATE LUXURY
			</h5>
			<h1 class="room-details-intro__head-text big-title">
				Ultimate Room
			</h1>
			<div class="room-details-intro__breadcrumbs-container">
				<div class="room-details-intro__breadcrumbs">
					<a href="/index.php"><span class="room-details-intro__breadcrumbs-home">Home</span></a>
					<span class="room-details-intro__breadcrumbs-separator">&nbsp|&nbsp</span>
					<span class="room-details-intro__breadcrumbs-about">Room Details</span>
				</div>
			</div>
		</section>
	</div>
</main>

@if(isset($room))
<main class="room-details-intro__room-details">
	<div class="room-details-intro__room-details-wrapper">
		<div class="room-details-intro__room-details-text-wrapper">
			<h4 class="subtitle-trigger">{{ $room['room_type'] }}</h4>
			<h1 class="regular-title">Luxury Double Bed</h1>
			<span class="price-amount-small">${{ $room['price'] }}</span>
			<span class="price-nigth-small">/Night</span>
		</div>
		<img src="{{ $room['URL'] }}" alt="a photo of a hotel room" />
	</div>
	<div class="room-details-intro__rooms-details-availability">
		<p>Check Availability</p>
		<form action="">
			<label for="">Check In</label>
			<input class="room-details-intro__calendar-picker" placeholder="Fri, 14th June 2020" type="date" onfocus="(this.type='date')" onblur="(this.type='text')" required />
			<label for="">Check Out</label>
			<input class="room-details-intro__calendar-picker" placeholder="Sun, 16th June 2020" type="date" onfocus="(this.type='date')" onblur="(this.type='text')" required />
			<label for="">Full Name</label>
			<input id="input-details-name" name="full-name" placeholder="Your full name" type="text" required />
			<label for="">Email</label>
			<input id="input-details-email" name="email" placeholder="Enter email address" type="text" required />
			<label for="">Phone</label>
			<input id="input-details-phone" name="phone" placeholder="Add phone number" type="text" required />
			<label for="">Special Request</label>
			<input id="input-details-special-request" name="special-request" placeholder="Enter subject" type="text" required />
		</form>
		<button class="button button--beige button--auto">
			CHECK AVAILABILITY
		</button>
		<div class="room-details-intro__body-text">
			<p>
				Experience the pinnacle of luxury in our exquisite hotel
				room. As you step inside, you'll be enveloped in an
				ambiance of elegance and refinement. Our room seamlessly
				combines modern sophistication with timeless charm,
				featuring luxurious fabrics, rich colors, and
				custom-made furnishings. Take in breathtaking views
				through large windows, which frame either a captivating
				cityscape or serene natural scenery. Drift into blissful
				slumber on a plush king-size bed adorned with
				high-quality linens. The marble en-suite bathroom offers
				a tranquil escape, complete with a deep soaking tub and
				a rejuvenating rainfall shower. With personalized
				concierge service and top-notch in-room amenities, your
				stay becomes a truly extraordinary experience.
			</p>
		</div>
	</div>
</main>
@endif

<main class="room-details-intro__amenities">
	<h4 class="small-title">Amenities</h4>
	<hr />
	<div class="room-details-intro__amenities-services">
		<div class="room-details-intro__amenities-services-left">
			<div>
				<img src="../assets/images/offers_services/air_conditioner.png" alt="" /><span>Air Conditioner</span>
			</div>
			<div>
				<img src="../assets/images/offers_services/breakfast.png" alt="" /><span>Breakfast</span>
			</div>
			<div>
				<img src="../assets/images/offers_services/cleaning.png" alt="" /><span>Cleaning</span>
			</div>
			<div>
				<img src="../assets/images/offers_services/grocery.png" alt="" /><span>Grocery</span>
			</div>
			<div>
				<img src="../assets/images/offers_services/shop_near.png" alt="" /><span>Shop Near</span>
			</div>
			<div>
				<img src="../assets/images/offers_services/support.png" alt="" /><span>24/7 Online Support</span>
			</div>
			<div>
				<img src="../assets/images/offers_services/security.png" alt="" /><span>Smart Security</span>
			</div>
		</div>

		<div class="room-details-intro__amenities-services-right">
			<div>
				<img src="../assets/images/offers_services/Vector.png" alt="" /><span>High Speed Wifi</span>
			</div>
			<div>
				<img src="../assets/images/offers_services/kitchen.png" alt="" /><span>Kitchen</span>
			</div>
			<div>
				<img src="../assets/images/offers_services/shower.png" alt="" /><span>Shower</span>
			</div>
			<div>
				<img src="../assets/images/offers_services/single_bed.png" alt="" /><span>Single Bed</span>
			</div>
			<div>
				<img src="../assets/images/offers_services/towels.png" alt="" /><span>Towels</span>
			</div>
			<div>
				<img src="../assets/images/offers_services/locker.png" alt="" /><span>Strong Locker</span>
			</div>
			<div>
				<img src="../assets/images/offers_services/team.png" alt="" /><span>Expert Team</span>
			</div>
		</div>
	</div>
</main>

<main class="room-details-intro__founder-container">
	<div class="room-details-intro__founder">
		<div>
			<img src="../assets/images/elipse-banner.png" alt="a banner on the top right of the main photo" />
			<img src="../assets/images/founder_photo.png" alt="a photo of the founder" />
		</div>
		<h4 class="small-title">David P. Robaina</h4>
		<h5 class="subtitle-trigger">FOUNDER, QUX CO.</h5>
		<p>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit,
			sed do eiusmod tempor incididunt ut labore et dolore.
		</p>
	</div>
</main>

<main class="room-details-intro__cancellation-container">
	<div class="room-details-intro__cancellation">
		<h4 class="small-title">Cancellation</h4>
		<hr />
		<p>
			At Miranda, we understand that plans can change. To provide flexibility and peace of mind, we offer the following cancellation policy:
		</p>
		<br>
		<p>
			Cancellation Terms:
		</p>
		<br>
		<p>
			- Guests can receive a full refund if the reservation is canceled up to 14 days before the scheduled date.
		</p>
		<p>
			- Cancellations made within 14 days of the scheduled date may not be eligible for a refund.
		</p>
		<br>
		<p>
			We appreciate your understanding and look forward to hosting you. If you have any questions or need assistance, please feel free to contact our customer support team.
		</p>
		<br>
		<p>
			Thank you for choosing Hotel Miranda.
		</p>
	</div>
</main>

<main class="room-details-cards">
	<h4 class="small-title">Related Rooms</h4>
	<hr />
	<div class="room-details-cards__card">
		<div class="swiper swiper-rooms-offer">
			<div class="swiper-wrapper">
				<div class="offers-popular__card swiper-slide">
					<img src="../assets/images/hotelRooms/hotel_room13.jpg" alt="a picture of a hotel room" />
					<div class="offers-popular__card-service-info">
						<img src="../assets/images/miranda_services_info.png" alt="an illustration of the room services" />
					</div>
					<div class="offers-popular__text-container">
						<h4 class="small-title">Minimal Duplex Room</h4>
						<p class="filled-text">
							Lorem ipsum dolor sit amet, consectetur
							adipi sicing elit, sed do eiusmod tempor.
						</p>
						<span class="offers-popular__text-frist-span price-amount">$345/Night</span>&nbsp&nbsp&nbsp&nbsp<span class="offers-popular__text-second-span"><a href="/room-details.php">Booking Now</a></span>
					</div>
				</div>
				<div class="offers-popular__card swiper-slide">
					<img src="../assets/images/hotelRooms/hotel_room1.jpg" alt="a picture of a hotel room" />
					<div class="offers-popular__card-service-info">
						<img src="../assets/images/miranda_services_info.png" alt="an illustration of the room services" />
					</div>
					<div class="offers-popular__text-container">
						<h4 class="small-title">Minimal Duplex Room</h4>
						<p class="filled-text">
							Lorem ipsum dolor sit amet, consectetur
							adipi sicing elit, sed do eiusmod tempor.
						</p>
						<span class="offers-popular__text-frist-span price-amount">$345/Night</span>&nbsp&nbsp&nbsp&nbsp<span class="offers-popular__text-second-span"><a href="/room-details.php">Booking Now</a></span>
					</div>
				</div>
				<div class="offers-popular__card swiper-slide">
					<img src="../assets/images/hotelRooms/hotel_room7.jpg" alt="a picture of a hotel room" />
					<div class="offers-popular__card-service-info">
						<img src="../assets/images/miranda_services_info.png" alt="an illustration of the room services" />
					</div>
					<div class="offers-popular__text-container">
						<h4 class="small-title">Minimal Duplex Room</h4>
						<p class="filled-text">
							Lorem ipsum dolor sit amet, consectetur
							adipi sicing elit, sed do eiusmod tempor.
						</p>
						<span class="offers-popular__text-frist-span price-amount">$345/Night</span>&nbsp&nbsp&nbsp&nbsp<span class="offers-popular__text-second-span"><a href="/room-details.php">Booking Now</a></span>
					</div>
				</div>
				<div class="offers-popular__card swiper-slide">
					<img src="../assets/images/hotelRooms/hotel_room5.jpg" alt="a picture of a hotel room" />
					<div class="offers-popular__card-service-info">
						<img src="../assets/images/miranda_services_info.png" alt="an illustration of the room services" />
					</div>
					<div class="offers-popular__text-container">
						<h4 class="small-title">Minimal Duplex Room</h4>
						<p class="filled-text">
							Lorem ipsum dolor sit amet, consectetur
							adipi sicing elit, sed do eiusmod tempor.
						</p>
						<span class="offers-popular__text-frist-span price-amount">$345/Night</span>&nbsp&nbsp&nbsp&nbsp<span class="offers-popular__text-second-span"><a href="/room-details.php">Booking Now</a></span>
					</div>
				</div>
				<div class="offers-popular__card swiper-slide">
					<img src="../assets/images/hotelRooms/hotel_room13.jpg" alt="a picture of a hotel room" />
					<div class="offers-popular__card-service-info">
						<img src="../assets/images/miranda_services_info.png" alt="an illustration of the room services" />
					</div>
					<div class="offers-popular__text-container">
						<h4 class="small-title">Minimal Duplex Room</h4>
						<p class="filled-text">
							Lorem ipsum dolor sit amet, consectetur
							adipi sicing elit, sed do eiusmod tempor.
						</p>
						<span class="offers-popular__text-frist-span price-amount">$345/Night</span>&nbsp&nbsp&nbsp&nbsp<span class="offers-popular__text-second-span"><a href="/room-details.php">Booking Now</a></span>
					</div>
				</div>
				<div class="offers-popular__card swiper-slide">
					<img src="../assets/images/hotelRooms/hotel_room12.jpg" alt="a picture of a hotel room" />
					<div class="offers-popular__card-service-info">
						<img src="../assets/images/miranda_services_info.png" alt="an illustration of the room services" />
					</div>
					<div class="offers-popular__text-container">
						<h4 class="small-title">Minimal Duplex Room</h4>
						<p class="filled-text">
							Lorem ipsum dolor sit amet, consectetur
							adipi sicing elit, sed do eiusmod tempor.
						</p>
						<span class="offers-popular__text-frist-span price-amount">$345/Night</span>&nbsp&nbsp&nbsp&nbsp<span class="offers-popular__text-second-span"><a href="/room-details.php">Booking Now</a></span>
					</div>
				</div>
				<div class="offers-popular__card swiper-slide">
					<img src="../assets/images/hotelRooms/hotel_room11.jpg" alt="a picture of a hotel room" />
					<div class="offers-popular__card-service-info">
						<img src="../assets/images/miranda_services_info.png" alt="an illustration of the room services" />
					</div>
					<div class="offers-popular__text-container">
						<h4 class="small-title">Minimal Duplex Room</h4>
						<p class="filled-text">
							Lorem ipsum dolor sit amet, consectetur
							adipi sicing elit, sed do eiusmod tempor.
						</p>
						<span class="offers-popular__text-frist-span price-amount">$345/Night</span>&nbsp&nbsp&nbsp&nbsp<span class="offers-popular__text-second-span"><a href="/room-details.php">Booking Now</a></span>
					</div>
				</div>
			</div>
			<div class="swiper-button-next swiper-buttons"></div>
			<div class="swiper-button-prev swiper-buttons"></div>
		</div>
	</div>
</main>

@endsection