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
                            @if($seatsLeft > 0)
                                <span class="badge badge-success ml-2">{{ $seatsLeft }}</span>
                            @else
                                <span class="badge badge-danger ml-2">No seats</span>
                            @endif
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
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#bookingModal">
                        Book Seat
                    </button>
                @else
                    <button class="btn btn-secondary btn-block mt-4" disabled>No Seats Available</button>
                @endif

                <!-- Booking Modal -->
                <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <form id="bookingForm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="bookingModalLabel">Book Your Seat</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="userName">Your Name</label>
                            <input type="text" class="form-control" id="userName" required>
                          </div>
                          <div class="form-group">
                            <label for="userEmail">Your Email</label>
                            <input type="email" class="form-control" id="userEmail" required>
                          </div>
                          <!-- Add more booking questions here if needed -->
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Submit Booking</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <!-- Ticket Modal -->
                <div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content" id="ticketContent">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ticketModalLabel">Your Event Ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-center">
                        <h4 class="text-success">Booking Confirmed!</h4>
                        <p><strong>Ticket Number:</strong> <span id="ticketNumber"></span></p>
                        <p><strong>Name:</strong> <span id="ticketName"></span></p>
                        <p><strong>Email:</strong> <span id="ticketEmail"></span></p>
                        <hr>
                        <p><strong>Event:</strong> {{ $event->title }}</p>
                        <p><strong>Date:</strong> {{ $event->date }} {{ $event->time }}</p>
                        <p><strong>Location:</strong> {{ $event->location }}</p>
                        <div class="alert alert-info mt-3">
                          Welcome to <strong>{{ $event->title }}</strong>! We're excited to have you. Get ready to enjoy and make great memories!
                        </div>
                        <p class="text-info">Show this ticket at the event entrance.</p>
                        <button id="downloadTicketBtn" class="btn btn-outline-primary mt-3">Download Ticket</button>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

            </div>
        </div>
        <div class="text-center mt-3 mb-5">
            <a href="{{ url('/') }}" class="btn btn-outline-dark">Back to Home</a>
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
                    <p class="m-0">Copyright &copy; <a class="text-white" href="#">Your Site Name</a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <p class="m-0">Designed by <a class="text-white" href="https://htmlcodex.com">HTML Codex</a> Distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a></p>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
                $(document).ready(function() {
                    $('#bookingForm').on('submit', function(e) {
                        e.preventDefault();
                        var name = $('#userName').val();
                        var email = $('#userEmail').val();
                        // Generate a random ticket number
                        var ticketNumber = 'EVT-' + Math.floor(100000 + Math.random() * 900000);
                        $('#bookingModal').modal('hide');
                        $('#ticketName').text(name);
                        $('#ticketEmail').text(email);
                        $('#ticketNumber').text(ticketNumber);

                        // Decrease seats left badge
                        var $badge = $('.info-item strong:contains("Seats Left:")').next('.badge');
                        var seatsLeft = parseInt($badge.text());
                        if (seatsLeft > 0) {
                            seatsLeft -= 1;
                            $badge.text(seatsLeft);
                            if (seatsLeft === 0) {
                                $badge.removeClass('badge-success').addClass('badge-danger').text('No seats');
                                $('.btn.btn-primary.btn-block[data-target="#bookingModal"]').prop('disabled', true).removeClass('btn-primary').addClass('btn-secondary').text('No Seats Available');
                            }
                        }

                        setTimeout(function() {
                            $('#ticketModal').modal('show');
                        }, 500);
                    });

                    // Download ticket as image
                    $('#downloadTicketBtn').on('click', function() {
                        html2canvas(document.querySelector("#ticketContent")).then(function(canvas) {
                            var link = document.createElement('a');
                            link.download = 'event_ticket.png';
                            link.href = canvas.toDataURL();
                            link.click();
                        });
                    });
                });
                </script>
</body>

</html>