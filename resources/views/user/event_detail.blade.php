<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $event->title }} - Event Details</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="EventSphere - Event Details" name="keywords">
    <meta content="Event details for {{ $event->title }}" name="description">

    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <style>
        .event-card {
            max-width: 800px;
            margin: 40px auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 15px;
            overflow: hidden;
        }
        .event-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
        }
        .event-details-section {
            padding: 30px;
        }
        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .info-item .icon {
            color: #17a2b8; /* Bootstrap info color */
            font-size: 1.2em;
            margin-right: 10px;
            width: 25px;
            text-align: center;
        }
        .seat-counter {
            display: flex;
            align-items: center;
            margin: 15px 0;
        }
        .seat-counter button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .seat-counter input {
            width: 60px;
            height: 40px;
            text-align: center;
            margin: 0 10px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .ticket {
            border: 2px dashed #007bff;
            border-radius: 10px;
            padding: 20px;
            margin: 15px 0;
            background: #f8f9fa;
        }
        .ticket-header {
            text-align: center;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        .ticket-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .ticket-info div {
            margin-bottom: 8px;
        }
        #ticketQrCode {
            display: flex;
            justify-content: center;
            margin: 15px 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid bg-dark">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center text-white">
                    <small><i class="fa fa-phone-alt mr-2"></i>+012 345 6789</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>info@example.com</small>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-2" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="text-white px-2" href=""><i class="fab fa-twitter"></i></a>
                    <a class="text-white px-2" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="text-white px-2" href=""><i class="fab fa-instagram"></i></a>
                    <a class="text-white pl-2" href=""><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
   <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <a href="{{ url('/') }}" class="navbar-brand ml-lg-3 d-flex align-items-center">
                <img src="images/logo.png" alt="EventSphere Logo" height="50" class="mr-2">
                <h1 class="m-0 text-uppercase text-primary">
                    EventSphere
                </h1>
            </a>

            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->is('about') ? 'active' : '' }}">About</a>
                    <a href="{{ route('events') }}" class="nav-item nav-link {{ request()->is('events') ? 'active' : '' }}">Events</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ route('features') }}" class="dropdown-item">Our Features</a>
                            <a href="{{ route('team') }}" class="dropdown-item">Instructors</a>
                            <a href="{{ route('testimonial') }}" class="dropdown-item">Testimonial</a>
                        </div>
                    </div>
                    <a href="{{ route('contact.create') }}" class="nav-item nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
                </div>
               <a href="{{ route('events') }}" class="btn btn-primary py-2 px-4 d-none d-lg-block">Join Us</a>
            </div>
        </nav>
    </div>
    <div class="jumbotron jumbotron-fluid page-header position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-1">Event Detail</h1>
            <div class="d-inline-flex text-white mb-5">
                <p class="m-0 text-uppercase"><a class="text-white" href="{{ url('/') }}">Home</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Event Detail</p>
            </div>
            <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-light bg-white text-body px-4 dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Events</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Event 1</a>
                            <a class="dropdown-item" href="#">Event 2</a>
                            <a class="dropdown-item" href="#">Event 3</a>
                        </div>
                    </div>
                    <input type="text" class="form-control border-light" style="padding: 30px 25px;" placeholder="Keyword">
                    <div class="input-group-append">
                        <button class="btn btn-secondary px-4 px-lg-5">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card event-card">
            @if($event->image_path)
                <img src="{{ asset('storage/' . $event->image_path) }}" class="event-image card-img-top" alt="Event Image">
            @else
                <img src="https://via.placeholder.com/800x400.png?text=Event+Image" class="event-image card-img-top" alt="Event Placeholder Image">
            @endif
            <div class="event-details-section">
                <h2 class="card-title text-primary">{{ $event->title }}</h2>
                <p class="card-text">{{ $event->description }}</p>

                <div class="mt-4">
                    <div class="info-item">
                        <span class="icon"><i class="far fa-calendar-alt"></i></span>
                        <p class="m-0"><strong>Date:</strong> {{ $event->date }} {{ $event->time }}</p>
                    </div>
                    <div class="info-item">
                        <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                        <p class="m-0"><strong>Location:</strong> {{ $event->location }}</p>
                    </div>
                    <div class="info-item">
                        <span class="icon"><i class="fas fa-tag"></i></span>
                        <p class="m-0"><strong>Category:</strong> {{ $event->category }}</p>
                    </div>
                    <div class="info-item">
                        <span class="icon"><i class="fas fa-hashtag"></i></span>
                        <p class="m-0"><strong>Tags:</strong> {{ $event->tags }}</p>
                    </div>
                    <div class="info-item">
                        <span class="icon"><i class="fas fa-user-friends"></i></span>
                        <p class="m-0">
                            <strong>Seats Left:</strong>
                            @php
                                $seatsLeft = $event->total_seats - ($event->booked_seats ?? 0);
                            @endphp
                            <span id="seatsLeftCount" class="badge {{ $seatsLeft > 0 ? 'badge-success' : 'badge-danger' }} ml-2">
                                {{ $seatsLeft > 0 ? $seatsLeft : 'No seats' }}
                            </span>
                        </p>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success mt-4">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger mt-4">{{ session('error') }}</div>
                @endif

                @if($seatsLeft > 0)
                    <!-- Book Seat Button triggers modal -->
                    <button type="button" class="btn btn-primary btn-block mt-4" data-toggle="modal" data-target="#bookingModal">
                        Book Your Seats
                    </button>
                @else
                    <button class="btn btn-secondary btn-block mt-4" disabled>No Seats Available</button>
                @endif

                <!-- Booking Modal -->
                <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="bookingForm" action="{{ route('event.book', $event->id) }}" method="POST">
                            @csrf
                            <div class="modal-header">
                              <h5 class="modal-title" id="bookingModalLabel">Book Your Seats</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="userName">Your Name</label>
                                <input type="text" class="form-control" id="userName" name="name" required>
                              </div>
                              <div class="form-group">
                                <label for="userEmail">Your Email</label>
                                <input type="email" class="form-control" id="userEmail" name="email" required>
                              </div>
                              <div class="form-group">
                                <label for="seatCount">Number of Seats</label>
                                <div class="seat-counter">
                                    <button type="button" id="decreaseSeats" class="btn btn-outline-secondary">-</button>
                                    <input type="number" class="form-control text-center" id="seatCount" name="seat_count" min="1" max="{{ $seatsLeft }}" value="1" required>
                                    <button type="button" id="increaseSeats" class="btn btn-outline-secondary">+</button>
                                </div>
                                <small class="form-text text-muted">Maximum {{ $seatsLeft }} seats available</small>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-primary">Confirm Booking</button>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>

                <!-- Ticket Modal -->
                <div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ticketModalLabel">Your Event Tickets</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="ticket">
                            <div class="ticket-header">
                                <h4 class="text-success"><i class="fas fa-check-circle"></i> Booking Confirmed!</h4>
                                <h5 class="text-primary">{{ $event->title }}</h5>
                            </div>
                            <div class="ticket-info">
                                <div><strong>Ticket Number:</strong> <span id="ticketNumber"></span></div>
                                <div><strong>Booking Date:</strong> <span id="bookingDate"></span></div>
                                <div><strong>Name:</strong> <span id="ticketName"></span></div>
                                <div><strong>Email:</strong> <span id="ticketEmail"></span></div>
                                <div><strong>Seats Booked:</strong> <span id="ticketSeats"></span></div>
                                <div><strong>Event Date:</strong> {{ $event->date }}</div>
                                <div><strong>Time:</strong> {{ $event->time }}</div>
                                <div><strong>Location:</strong> {{ $event->location }}</div>
                            </div>
                            <div id="ticketQrCode" class="my-3"></div>
                            <div class="alert alert-info mt-3">
                              <i class="fas fa-info-circle"></i> Welcome to <strong>{{ $event->title }}</strong>! We're excited to have you. Please present this ticket at the entrance.
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button id="downloadTicketBtn" class="btn btn-outline-primary"><i class="fas fa-download"></i> Download Ticket</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

            </div>
        </div>
        <div class="text-center mt-3 mb-5">
            <a href="{{ route('events') }}" class="btn btn-outline-secondary mr-2"><i class="fas fa-arrow-left"></i> Back to Events</a>
            <a href="{{ url('/') }}" class="btn btn-outline-primary">Back to Home</a>
        </div>
    </div>
    <div class="container-fluid position-relative overlay-top bg-dark text-white-50 py-5" style="margin-top: 90px;">
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-md-6 mb-5">
                    <a href="index.html" class="navbar-brand">
                        <h1 class="mt-n2 text-uppercase text-white"><i class="fa fa-book-reader mr-3"></i>EventSphere</h1>
                    </a>
                    <p class="m-0">Accusam nonumy clita sed rebum kasd eirmod elitr. Ipsum ea lorem at et diam est, tempor rebum ipsum sit ea tempor stet et consetetur dolores. Justo stet diam ipsum lorem vero clita diam</p>
                </div>
                <div class="col-md-6 mb-5">
                    <h3 class="text-white mb-4">Newsletter</h3>
                    <div class="w-100">
                        <div class="input-group">
                            <input type="text" class="form-control border-light" style="padding: 30px;" placeholder="Your Email Address">
                            <div class="input-group-append">
                                <button class="btn btn-primary px-4">Sign Up</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h3 class="text-white mb-4">Get In Touch</h3>
                    <p><i class="fa fa-map-marker-alt mr-2"></i>123 Street, New York, USA</p>
                    <p><i class="fa fa-phone-alt mr-2"></i>+012 345 67890</p>
                    <p><i class="fa fa-envelope mr-2"></i>info@example.com</p>
                    <div class="d-flex justify-content-start mt-4">
                        <a class="text-white mr-4" href="#"><i class="fab fa-2x fa-twitter"></i></a>
                        <a class="text-white mr-4" href="#"><i class="fab fa-2x fa-facebook-f"></i></a>
                        <a class="text-white mr-4" href="#"><i class="fab fa-2x fa-linkedin-in"></i></a>
                        <a class="text-white" href="#"><i class="fab fa-2x fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h3 class="text-white mb-4">Our Events</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Tech Talks</a>
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Workshops</a>
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Conferences</a>
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Webinars</a>
                        <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Meetups</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h3 class="text-white mb-4">Quick Links</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Privacy Policy</a>
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Terms & Condition</a>
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Regular FAQs</a>
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Help & Support</a>
                        <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white-50 border-top py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                    <p class="m-0">Copyright &copy; <a class="text-white" href="#">EventSphere</a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <p class="m-0">Designed by <a class="text-white" href="https://htmlcodex.com">HTML Codex</a></p>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="btn btn-lg btn-primary rounded-0 btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    
    <script>
    $(document).ready(function() {
        // Initialize seats from server or localStorage
        let availableSeats = {{ $seatsLeft }};
        const eventId = {{ $event->id }};
        const storageKey = `event_${eventId}_seats`;
        
        // Check if we have a stored value for this event
        const storedSeats = localStorage.getItem(storageKey);
        if (storedSeats !== null) {
            availableSeats = parseInt(storedSeats);
            updateSeatsDisplay(availableSeats);
        }
        
        // Seat counter functionality
        $('#increaseSeats').click(function() {
            const seatInput = $('#seatCount');
            let currentValue = parseInt(seatInput.val());
            if (currentValue < availableSeats) {
                seatInput.val(currentValue + 1);
            }
        });
        
        $('#decreaseSeats').click(function() {
            const seatInput = $('#seatCount');
            let currentValue = parseInt(seatInput.val());
            if (currentValue > 1) {
                seatInput.val(currentValue - 1);
            }
        });
        
        $('#seatCount').on('change', function() {
            let value = parseInt($(this).val());
            if (isNaN(value) || value < 1) {
                $(this).val(1);
            } else if (value > availableSeats) {
                $(this).val(availableSeats);
            }
        });
        
    // ... (your existing code) ...

// Handle form submission with AJAX
$('#bookingForm').on('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission

    const form = $(this);
    const url = form.attr('action');
    const formData = form.serialize(); // This serializes all form inputs

    // Disable the button to prevent multiple submissions
    const submitBtn = form.find('button[type="submit"]');
    submitBtn.prop('disabled', true).text('Booking...');

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        success: function(response) {
            // This code runs if the server returns a successful response (200 OK)
            console.log(response);

            // Update available seats and display
            let availableSeats = response.seatsLeft;
            localStorage.setItem(storageKey, availableSeats);
            updateSeatsDisplay(availableSeats);

            // Populate ticket modal with data from the server's response
            $('#ticketNumber').text(response.ticketNumber);
            $('#bookingDate').text(response.bookingDate);
            $('#ticketName').text(response.name);
            $('#ticketEmail').text(response.email);
            $('#ticketSeats').text(response.seatCount);

            // Generate QR code based on the response
            $('#ticketQrCode').empty();
            const qrText = `Event: {{ $event->title }}\nTicket: ${response.ticketNumber}\nName: ${response.name}\nSeats: ${response.seatCount}\nDate: {{ $event->date }}`;
            new QRCode(document.getElementById("ticketQrCode"), {
                text: qrText,
                width: 150,
                height: 150
            });

            // Hide booking modal and show ticket modal
            $('#bookingModal').modal('hide');
            setTimeout(function() {
                $('#ticketModal').modal('show');
            }, 500);

            // Re-enable the submit button
            submitBtn.prop('disabled', false).text('Confirm Booking');
        },
        error: function(xhr) {
            // This code runs if the server returns an error
            console.log(xhr.responseText);
            let errorMessage = 'An error occurred during booking. Please try again.';
            try {
                const errorResponse = JSON.parse(xhr.responseText);
                if (errorResponse.message) {
                    errorMessage = errorResponse.message;
                }
            } catch (e) {
                // Do nothing
            }
            alert(errorMessage);
            
            // Re-enable the submit button
            submitBtn.prop('disabled', false).text('Confirm Booking');
        }
    });
}); 
    </script>
</body>

</html>