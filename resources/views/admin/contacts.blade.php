<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Submissions - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendors/simple-datatables/style.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.svg') }}" type="image/x-icon">
    
    <!-- Include jsPDF for PDF export functionality -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    
    <style>
        .status-badge {
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 700;
            border-radius: 0.25rem;
        }
        .message-preview {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .action-buttons {
            white-space: nowrap;
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
                            <a href="{{ route('admin.index') }}"><img src="{{ asset('admin/images/logo/logo.png') }}" alt="Logo" srcset=""></a>
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

                        <!-- Other menu items would be here -->

                        <li class="sidebar-item active">
                            <a href="{{ route('admin.contacts.index') }}" class='sidebar-link'>
                                <i class="bi bi-envelope-fill"></i>
                                <span>Contact Submissions</span>
                            </a>
                        </li>

                        <!-- Other menu items would be here -->

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
                            <h3>Contact Form Submissions</h3>
                            <p class="text-subtitle text-muted">View and manage user contact submissions</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Contact Submissions</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Contact Submissions</h5>
                            <div>
                                <button class="btn btn-primary" id="exportPdf">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Export to PDF
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            
                            <table class="table table-striped" id="contactTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Submitted At</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->phone ?? 'N/A' }}</td>
                                        <td>{{ $contact->subject }}</td>
                                        <td class="message-preview" title="{{ $contact->message }}">
                                            {{ Str::limit($contact->message, 50) }}
                                        </td>
                                        <td>{{ $contact->created_at->format('M j, Y g:i A') }}</td>
                                        <td>
                                            @if($contact->status == 'new')
                                                <span class="badge bg-info">New</span>
                                            @elseif($contact->status == 'in_progress')
                                                <span class="badge bg-warning">In Progress</span>
                                            @else
                                                <span class="badge bg-success">Completed</span>
                                            @endif
                                        </td>
                                        <td class="action-buttons">
                                            <button class="btn btn-sm btn-info view-btn" data-id="{{ $contact->id }}" data-bs-toggle="modal" data-bs-target="#viewMessageModal">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                            <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-info btn-sm">View</a>
                                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this contact?')">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            <!-- Pagination Links -->
                            <div class="d-flex justify-content-center">
                                {{ $contacts->links() }}
                            </div>
                        </div>
                    </div>

                </section>
            </div>

            <!-- View Message Modal -->
            <div class="modal fade" id="viewMessageModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Message Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Name:</strong> <span id="modal-name"></span>
                                </div>
                                <div class="col-md-6">
                                    <strong>Email:</strong> <span id="modal-email"></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Phone:</strong> <span id="modal-phone"></span>
                                </div>
                                <div class="col-md-6">
                                    <strong>Subject:</strong> <span id="modal-subject"></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <strong>Message:</strong>
                                <p id="modal-message" class="p-3 bg-light rounded"></p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Submitted At:</strong> <span id="modal-date"></span>
                                </div>
                                <div class="col-md-6">
                                    <strong>Status:</strong> <span id="modal-status"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('admin/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('admin/vendors/simple-datatables/simple-datatables.js') }}"></script>
    
    <script>
        // Initialize jsPDF
        window.jsPDF = window.jspdf.jsPDF;

        // Function to export data as PDF
        function exportToPDF() {
            const doc = new jsPDF();
            
            // Add title
            doc.setFontSize(18);
            doc.text('Contact Form Submissions', 14, 15);
            
            // Add date
            doc.setFontSize(10);
            doc.text(`Generated on: ${new Date().toLocaleString()}`, 14, 22);
            
            // Prepare data for the table
            const tableData = [];
            document.querySelectorAll('#contactTable tbody tr').forEach(row => {
                const cells = row.querySelectorAll('td');
                tableData.push([
                    cells[0].textContent,
                    cells[1].textContent,
                    cells[2].textContent,
                    cells[3].textContent,
                    cells[4].textContent,
                    cells[6].textContent,
                    cells[7].textContent
                ]);
            });
            
            // Create the table
            doc.autoTable({
                startY: 30,
                head: [['ID', 'Name', 'Email', 'Phone', 'Subject', 'Submitted At', 'Status']],
                body: tableData,
                theme: 'grid',
                headStyles: {
                    fillColor: [41, 128, 185],
                    textColor: 255
                },
                styles: {
                    fontSize: 8,
                    cellPadding: 1
                },
                margin: { top: 30 }
            });
            
            // Save the PDF
            doc.save('contact-submissions-' + new Date().toISOString().slice(0, 10) + '.pdf');
        }

        // Document ready function
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable
            const dataTable = new simpleDatatables.DataTable('#contactTable', {
                perPage: 10,
                perPageSelect: [5, 10, 15, 20, 25],
                labels: {
                    placeholder: "Search records...",
                    perPage: "{select} entries per page",
                    noRows: "No entries to found",
                    info: "Showing {start} to {end} of {rows} entries"
                }
            });
            
            // Add event listener for PDF export button
            document.getElementById('exportPdf').addEventListener('click', exportToPDF);
            
            // Add event listeners to view buttons
            document.querySelectorAll('.view-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const row = this.closest('tr');
                    const cells = row.querySelectorAll('td');
                    
                    // Populate modal with data
                    document.getElementById('modal-name').textContent = cells[1].textContent;
                    document.getElementById('modal-email').textContent = cells[2].textContent;
                    document.getElementById('modal-phone').textContent = cells[3].textContent;
                    document.getElementById('modal-subject').textContent = cells[4].textContent;
                    document.getElementById('modal-message').textContent = this.closest('tr').querySelector('.message-preview').title;
                    document.getElementById('modal-date').textContent = cells[6].textContent;
                    document.getElementById('modal-status').textContent = cells[7].textContent;
                });
            });
        });
    </script>

    <script src="{{ asset('admin/js/main.js') }}"></script>
</body>

</html>