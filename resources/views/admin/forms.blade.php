<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management - Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin/css/bootstrap.css">

    <link rel="stylesheet" href="admin/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="admin/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="admin/css/app.css">
    <link rel="shortcut icon" href="admin/images/favicon.svg" type="image/x-icon">
    
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
        }
        .seat-counter {
            font-size: 1.2rem;
            font-weight: bold;
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
                            <a href="index.html"><img src="admin/images/logo/logo.png" alt="Logo" srcset=""></a>
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
                            <a href="index.html" class='sidebar-link'>
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
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create Event</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Event Creation Form -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Event Details</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" id="eventForm">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="event-title">Event Title</label>
                                                        <input type="text" id="event-title" class="form-control"
                                                            placeholder="Event Name" name="event-title" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="event-category">Event Category</label>
                                                        <select class="form-select" id="event-category" required>
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
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="event-description">Event Description</label>
                                                        <textarea class="form-control" id="event-description" rows="3"
                                                            placeholder="Describe the event in detail..." required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="event-date">Event Date</label>
                                                        <input type="date" id="event-date" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="event-time">Event Time</label>
                                                        <input type="time" id="event-time" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="event-location">Location</label>
                                                        <input type="text" id="event-location" class="form-control"
                                                            placeholder="Venue or Online Platform" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="total-seats">Total Seats Available</label>
                                                        <input type="number" id="total-seats" class="form-control"
                                                            placeholder="100" min="1" required>
                                                        <div class="form-text">Set to 0 for unlimited registrations</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="registration-deadline">Registration Deadline</label>
                                                        <input type="datetime-local" id="registration-deadline" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="event-image">Event Image</label>
                                                        <input type="file" id="event-image" class="form-control" accept="image/*">
                                                        <img id="imagePreview" class="image-preview" src="#" alt="Image Preview">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label class="mb-2">Event Tags</label>
                                                        <div>
                                                            <span class="badge bg-primary category-badge me-1 mb-1" data-category="workshop">Workshop</span>
                                                            <span class="badge bg-success category-badge me-1 mb-1" data-category="seminar">Seminar</span>
                                                            <span class="badge bg-info category-badge me-1 mb-1" data-category="conference">Conference</span>
                                                            <span class="badge bg-warning category-badge me-1 mb-1" data-category="competition">Competition</span>
                                                            <span class="badge bg-danger category-badge me-1 mb-1" data-category="webinar">Webinar</span>
                                                        </div>
                                                        <input type="hidden" id="event-tags">
                                                        <div class="form-text">Click to select relevant tags</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <div class="checkbox">
                                                            <input type="checkbox" id="featured-event" class="form-check-input">
                                                            <label for="featured-event">Feature this event on homepage</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <div class="checkbox">
                                                            <input type="checkbox" id="registration-required" class="form-check-input" checked>
                                                            <label for="registration-required">Registration required</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end mt-3">
                                                    <button type="button" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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

                <!-- Event Statistics Section -->
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Event Statistics</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 col-lg-3 col-md-6">
                                            <div class="card">
                                                <div class="card-body px-3 py-4-5">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="stats-icon purple">
                                                                <i class="bi bi-calendar-event"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <h6 class="text-muted font-semibold">Total Events</h6>
                                                            <h6 class="font-extrabold mb-0">142</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-3 col-md-6">
                                            <div class="card">
                                                <div class="card-body px-3 py-4-5">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="stats-icon blue">
                                                                <i class="bi bi-people-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <h6 class="text-muted font-semibold">Total Registrations</h6>
                                                            <h6 class="font-extrabold mb-0">3,254</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-3 col-md-6">
                                            <div class="card">
                                                <div class="card-body px-3 py-4-5">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="stats-icon green">
                                                                <i class="bi bi-ticket-perforated"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <h6 class="text-muted font-semibold">Available Seats</h6>
                                                            <h6 class="font-extrabold mb-0">586</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-3 col-md-6">
                                            <div class="card">
                                                <div class="card-body px-3 py-4-5">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="stats-icon red">
                                                                <i class="bi bi-collection-play"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <h6 class="text-muted font-semibold">Upcoming Events</h6>
                                                            <h6 class="font-extrabold mb-0">12</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Recent Events Table -->
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Recent Events</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-lg">
                                            <thead>
                                                <tr>
                                                    <th>Event Name</th>
                                                    <th>Category</th>
                                                    <th>Date</th>
                                                    <th>Registrations</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-bold-500">Web Development Workshop</td>
                                                    <td>Technical</td>
                                                    <td>24 Oct 2023</td>
                                                    <td>
                                                        <div class="progress progress-primary mb-2">
                                                            <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <span class="seat-counter">85/100</span>
                                                    </td>
                                                    <td><span class="badge bg-success">Active</span></td>
                                                    <td><a href="#"><i class="bi bi-pencil-square"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Career Fair 2023</td>
                                                    <td>Career</td>
                                                    <td>15 Nov 2023</td>
                                                    <td>
                                                        <div class="progress progress-primary mb-2">
                                                            <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <span class="seat-counter">65/100</span>
                                                    </td>
                                                    <td><span class="badge bg-success">Active</span></td>
                                                    <td><a href="#"><i class="bi bi-pencil-square"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Science Symposium</td>
                                                    <td>Academic</td>
                                                    <td>5 Dec 2023</td>
                                                    <td>
                                                        <div class="progress progress-primary mb-2">
                                                            <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <span class="seat-counter">45/100</span>
                                                    </td>
                                                    <td><span class="badge bg-warning">Upcoming</span></td>
                                                    <td><a href="#"><i class="bi bi-pencil-square"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Cultural Festival</td>
                                                    <td>Cultural</td>
                                                    <td>20 Sep 2023</td>
                                                    <td>
                                                        <div class="progress progress-primary mb-2">
                                                            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <span class="seat-counter">120/120</span>
                                                    </td>
                                                    <td><span class="badge bg-danger">Completed</span></td>
                                                    <td><a href="#"><i class="bi bi-eye"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Coding Competition</td>
                                                    <td>Technical</td>
                                                    <td>10 Oct 2023</td>
                                                    <td>
                                                        <div class="progress progress-primary mb-2">
                                                            <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <span class="seat-counter">90/100</span>
                                                    </td>
                                                    <td><span class="badge bg-success">Active</span></td>
                                                    <td><a href="#"><i class="bi bi-pencil-square"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script src="admin/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="admin/js/bootstrap.bundle.min.js"></script>
    <script src="admin/js/main.js"></script>

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
                        this.classList.add('bg-primary');
                        selectedTags = selectedTags.filter(tag => tag !== category);
                    } else {
                        // Select it
                        this.classList.remove('bg-primary');
                        this.classList.add('bg-secondary');
                        selectedTags.push(category);
                    }
                    
                    eventTags.value = selectedTags.join(',');
                });
            });
            
            // Form submission
            const eventForm = document.getElementById('eventForm');
            
            eventForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Basic validation
                const eventTitle = document.getElementById('event-title').value;
                const eventCategory = document.getElementById('event-category').value;
                
                if (!eventTitle || !eventCategory) {
                    alert('Please fill in all required fields');
                    return;
                }
                
                // Simulate form submission
                alert('Event created successfully!');
                eventForm.reset();
                imagePreview.style.display = 'none';
                
                // Reset tags
                selectedTags = [];
                eventTags.value = '';
                categoryBadges.forEach(badge => {
                    badge.classList.remove('bg-secondary');
                    if (badge.getAttribute('data-category') === 'workshop') {
                        badge.classList.add('bg-primary');
                    } else if (badge.getAttribute('data-category') === 'seminar') {
                        badge.classList.add('bg-success');
                    } else if (badge.getAttribute('data-category') === 'conference') {
                        badge.classList.add('bg-info');
                    } else if (badge.getAttribute('data-category') === 'competition') {
                        badge.classList.add('bg-warning');
                    } else if (badge.getAttribute('data-category') === 'webinar') {
                        badge.classList.add('bg-danger');
                    }
                });
            });
        });
    </script>
</body>

</html>