@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Profile Sidebar -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                   @php
    // Define a color palette
    $colors = ['#6c5ce7', '#00b894', '#d63031', '#0984e3', '#e17055', '#2d3436', '#fd79a8'];

    // Pick color based on user id (stable & repeatable)
    $bgColor = $colors[Auth::id() % count($colors)];
@endphp

@if(Auth::user()->profile_picture)
    <img src="{{ asset('storage/'.Auth::user()->profile_picture) }}" 
         class="rounded-circle mb-3" width="150" height="150">
@else
    <div class="rounded-circle text-white d-flex align-items-center justify-content-center mb-3"
         style="width:150px; height:150px; font-size:48px; font-weight:bold; background-color: {{ $bgColor }};">
        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
    </div>
@endif


                    <h4>{{ Auth::user()->name }}</h4>
                    <p class="text-muted">{{ Auth::user()->email }}</p>

                    @if(Auth::user()->location)
                        <p><i class="bi bi-geo-alt"></i> {{ Auth::user()->location }}</p>
                    @endif

                    <a href="{{ route('user.editProfile') }}" class="btn btn-primary btn-sm mt-2">Edit Profile</a>
                    <a href="{{ route('user.changePassword') }}" class="btn btn-warning btn-sm mt-2">Change Password</a>
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm mt-2">Logout</a>
                </div>
            </div>

            <!-- Social Links -->
            <div class="card mt-3 shadow-sm">
                <div class="card-body">
                    <h5>Connect with me</h5>
                    <ul class="list-unstyled">
                        @if(Auth::user()->facebook)
                            <li><a href="{{ Auth::user()->facebook }}" target="_blank"><i class="bi bi-facebook"></i> Facebook</a></li>
                        @endif
                        @if(Auth::user()->instagram)
                            <li><a href="{{ Auth::user()->instagram }}" target="_blank"><i class="bi bi-instagram"></i> Instagram</a></li>
                        @endif
                        @if(Auth::user()->twitter)
                            <li><a href="{{ Auth::user()->twitter }}" target="_blank"><i class="bi bi-twitter-x"></i> Twitter</a></li>
                        @endif
                        @if(Auth::user()->linkedin)
                            <li><a href="{{ Auth::user()->linkedin }}" target="_blank"><i class="bi bi-linkedin"></i> LinkedIn</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- Profile Main -->
        <div class="col-md-8">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5>About Me</h5>
                    <p>{{ Auth::user()->bio ?? 'No bio added yet.' }}</p>
                </div>
            </div>

            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5>Notification Preferences</h5>
                    <p>
                        @if(Auth::user()->notifications == 'all')
                            ✅ Receiving all notifications
                        @elseif(Auth::user()->notifications == 'important')
                            ⚡ Only important updates
                        @else
                            🔕 No notifications
                        @endif
                    </p>
                </div>
            </div>

            <!-- Booking History -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>My Recent Bookings</h5>
                    @if($bookings->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Event</th>
                                    <th>Seat</th>
                                    <th>Date</th>
                                    <th>Ticket</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->event->title }}</td>
                                        <td>{{ $booking->seat_number }}</td>
                                        <td>{{ $booking->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ asset('storage/'.$booking->ticket_image) }}" target="_blank" class="btn btn-sm btn-success">View Ticket</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No bookings yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
