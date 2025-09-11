<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h2>Hi {{ $booking->user->name }},</h2>
    <p>Thank you for booking with <b>EventSphere</b>!</p>
    <p>Your ticket details:</p>
    <ul>
        <li><b>Event:</b> {{ $booking->event->title }}</li>
        <li><b>Date:</b> {{ $booking->event->date }}</li>
        <li><b>Seat No:</b> {{ $booking->seat_number }}</li>
    </ul>
    <p>You can also download your ticket from your dashboard.</p>
    <br>
    <p>Enjoy the event 🎉</p>
</body>
</html>
