<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thank You for Your Feedback</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #4F46E5; color: white; padding: 20px; text-align: center; }
        .content { background-color: #f9f9f9; padding: 20px; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #666; }
        .rating { color: #FFD700; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>EventSphere</h1>
            <h2>Thank You for Your Feedback!</h2>
        </div>
        
        <div class="content">
            <p>Hello <strong>{{ $feedback->name }}</strong>,</p>
            
            <p>Thank you for taking the time to provide feedback for <strong>{{ $feedback->event->title }}</strong>.</p>
            
            <p><strong>Your Rating:</strong> 
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $feedback->rating)
                        <span class="rating">★</span>
                    @else
                        <span>☆</span>
                    @endif
                @endfor
                ({{ $feedback->rating }}/5)
            </p>
            
            <p><strong>Your Comments:</strong><br>
            {{ $feedback->comments }}</p>
            
            <p>Your feedback is valuable to us and helps us improve our events for the future.</p>
            
            <p>Best regards,<br>
            The EventSphere Team</p>
        </div>
        
        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} EventSphere. All rights reserved.</p>
        </div>
    </div>
</body>
</html>