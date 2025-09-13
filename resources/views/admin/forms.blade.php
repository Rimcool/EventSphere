<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management - Admin Dashboard</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendors/simple-datatables/style.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.svg') }}" type="image/x-icon">
    
    <style>
        .category-badge {
            cursor: pointer;
            transition: all 0.3s;
        }
        .category-badge:hover {
            opacity: 0.8;
        }
        .image-preview {
            max-width: 100%;
            max-height: 200px;
            margin-top: 10px;
            display: none;
            border-radius: 0.25rem;
            object-fit: cover;
        }
        .seat-counter {
            font-size: 1.2rem;
            font-weight: bold;
        }
        .alert {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
        }
        .event-card-container .card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            height: 100%;
        }
        .event-card-container .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .event-card-container .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ route('admin.index') }}"><img src="images/logo.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item">
                            <a href="{{ route('admin.index') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-calendar-event"></i>
                                <span>Events</span>
                            </a>
                            <ul class="submenu active">
                                <li class="submenu-item active">
                                    <a href="#">Create Event</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="#">Manage Events</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="#">Registrations</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item">
                            <a href="application-gallery.html" class='sidebar-link'>
                                <i class="bi bi-image-fill"></i>
                                <span>Gallery</span>
                            </a>
                        </li>

                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Students</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="#">All Students</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="#">Event History</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-title">Settings</li>

                        <li class="sidebar-item">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-gear-fill"></i>
                                <span>Backend Settings</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div id="formAlert" class="alert alert-dismissible fade" role="alert">
                <span id="alertMessage"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Create New Event</h3>
                            <p class="text-subtitle text-muted">Organize technical, academic, career and other events</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create Event</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Event Details</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" id="eventForm" action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="event-title">Event Title</label>
                                                        <input type="text" id="event-title" class="form-control" placeholder="Event Name" name="title" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="event-category">Event Category</label>
                                                        <select class="form-select" id="event-category" name="category" required>
                                                            <option value="">Select Category</option>
                                                            <option value="technical">Technical</option>
                                                            <option value="academic">Academic</option>
                                                            <option value="career">Career Development</option>
                                                            <option value="cultural">Cultural</option>
                                                            <option value="sports">Sports</option>
                                                            <option value="other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="event-description">Event Description</label>
                                                        <textarea class="form-control" id="event-description" rows="3" placeholder="Describe the event in detail..." name="description" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="event-date">Event Date</label>
                                                        <input type="date" id="event-date" class="form-control" name="date" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="event-time">Event Time</label>
                                                        <input type="time" id="event-time" class="form-control" name="time" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="event-location">Location</label>
                                                        <input type="text" id="event-location" class="form-control" placeholder="Venue or Online Platform" name="location" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="total-seats">Total Seats Available</label>
                                                        <input type="number" id="total-seats" class="form-control" placeholder="100" min="0" name="total_seats" required>
                                                        <div class="form-text">Set to 0 for unlimited registrations</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="registration-deadline">Registration Deadline</label>
                                                        <input type="datetime-local" id="registration-deadline" class="form-control" name="registration_deadline">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="event-image">Event Image</label>
                                                        <input type="file" id="event-image" class="form-control" accept="image/*" name="event_image">
                                                        <img id="imagePreview" class="image-preview" src="#" alt="Image Preview">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="mb-2">Event Tags</label>
                                                        <div>
                                                            <span class="badge bg-primary category-badge me-1 mb-1" data-category="workshop">Workshop</span>
                                                            <span class="badge bg-success category-badge me-1 mb-1" data-category="seminar">Seminar</span>
                                                            <span class="badge bg-info category-badge me-1 mb-1" data-category="conference">Conference</span>
                                                            <span class="badge bg-warning category-badge me-1 mb-1" data-category="competition">Competition</span>
                                                            <span class="badge bg-danger category-badge me-1 mb-1" data-category="webinar">Webinar</span>
                                                        </div>
                                                        <input type="hidden" id="event-tags" name="tags">
                                                        <div class="form-text">Click to select relevant tags</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <div class="checkbox">
                                                            <input type="checkbox" id="featured-event" class="form-check-input" name="featured" value="1">
                                                            <label for="featured-event">Feature this event on homepage</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <div class="checkbox">
                                                            <input type="checkbox" id="registration-required" class="form-check-input" name="registration_required" value="1" checked>
                                                            <label for="registration-required">Registration required</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end mt-3">
                                                    <button type="button" id="resetForm" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Create Event</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="event-list">
                    <h3 class="mt-5 mb-4">Existing Events</h3>
                    <div class="row event-card-container">
                        @forelse($events as $event)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    @if($event->image_path)
                                        <img src="{{ asset('storage/' . $event->image_path) }}" class="card-img-top" alt="Event Image">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $event->title }}</h5>
                                        <p class="card-text text-muted">{{ Str::limit($event->description, 100) }}</p>
                                        <div class="d-flex flex-column gap-2">
                                            <p class="mb-0"><i class="bi bi-calendar"></i> <strong>Date:</strong> {{ $event->date }} {{ $event->time }}</p>
                                            <p class="mb-0"><i class="bi bi-geo-alt"></i> <strong>Location:</strong> {{ $event->location }}</p>
                                            <p class="mb-0"><i class="bi bi-tag"></i> <strong>Category:</strong> <span class="badge bg-secondary">{{ $event->category }}</span></p>
                                            <p class="mb-0"><i class="bi bi-person-fill"></i> <strong>Seats:</strong> {{ $event->total_seats }}</p>
                                            <p class="mb-0">
                                                <strong>Tags:</strong>
                                                @foreach(explode(',', $event->tags) as $tag)
                                                    <span class="badge bg-light text-dark me-1">{{ $tag }}</span>
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between align-items-center">
                                        <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-sm btn-outline-info">View Details</a>
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    No events found.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </section>
                
            </div>
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2023 &copy; College Management System</p>
                    </div>
                    <div class="float-end">
                        <p>Admin Portal</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    
        <script src=admin/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src=admin/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image preview functionality
            const eventImage = document.getElementById('event-image');
            const imagePreview = document.getElementById('imagePreview');
            
            eventImage.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });
            
            // Category tags selection
            const categoryBadges = document.querySelectorAll('.category-badge');
            const eventTags = document.getElementById('event-tags');
            let selectedTags = [];
            
            categoryBadges.forEach(badge => {
                badge.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');
                    
                    if (this.classList.contains('bg-secondary')) {
                        // Already selected, remove it
                        this.classList.remove('bg-secondary');
                        // Restore original color
                        if (category === 'workshop') this.classList.add('bg-primary');
                        else if (category === 'seminar') this.classList.add('bg-success');
                        else if (category === 'conference') this.classList.add('bg-info');
                        else if (category === 'competition') this.classList.add('bg-warning');
                        else if (category === 'webinar') this.classList.add('bg-danger');
                        
                        selectedTags = selectedTags.filter(tag => tag !== category);
                    } else {
                        // Select it
                        this.classList.remove('bg-primary', 'bg-success', 'bg-info', 'bg-warning', 'bg-danger');
                        this.classList.add('bg-secondary');
                        selectedTags.push(category);
                    }
                    
                    eventTags.value = selectedTags.join(',');
                });
            });
            
            // Reset form button
            document.getElementById('resetForm').addEventListener('click', function() {
                document.getElementById('eventForm').reset();
                imagePreview.style.display = 'none';
                
                // Reset tags
                selectedTags = [];
                eventTags.value = '';
                categoryBadges.forEach(badge => {
                    badge.classList.remove('bg-secondary');
                    const category = badge.getAttribute('data-category');
                    if (category === 'workshop') badge.classList.add('bg-primary');
                    else if (category === 'seminar') badge.classList.add('bg-success');
                    else if (category === 'conference') badge.classList.add('bg-info');
                    else if (category === 'competition') badge.classList.add('bg-warning');
                    else if (category === 'webinar') badge.classList.add('bg-danger');
                });
            });
            
            // Form submission
            const eventForm = document.getElementById('eventForm');
            const alertBox = document.getElementById('formAlert');
            const alertMessage = document.getElementById('alertMessage');
            
            eventForm.addEventListener('submit', function(e) {
                // Client-side validation
                const eventTitle = document.getElementById('event-title').value;
                const eventCategory = document.getElementById('event-category').value;
                const eventDescription = document.getElementById('event-description').value;
                const eventDate = document.getElementById('event-date').value;
                const eventTime = document.getElementById('event-time').value;
                const eventLocation = document.getElementById('event-location').value;
                
                if (!eventTitle || !eventCategory || !eventDescription || !eventDate || !eventTime || !eventLocation) {
                    e.preventDefault();
                    showAlert('Please fill in all required fields', 'danger');
                    return;
                }
                
                // If validation passes, the form will submit normally
            });
            
            function showAlert(message, type) {
                alertMessage.textContent = message;
                alertBox.classList.remove('alert-success', 'alert-danger');
                alertBox.classList.add('alert-' + type, 'show');
                
                // Auto hide after 5 seconds
                setTimeout(() => {
                    alertBox.classList.remove('show');
                }, 5000);
            }
            
            // Check if there are success/error messages from server
            @if(session('success'))
                showAlert('{{ session('success') }}', 'success');
            @endif
            
            @if($errors->any())
                showAlert('{{ $errors->first() }}', 'danger');
            @endif
        });
    </script>
</body>
</html>