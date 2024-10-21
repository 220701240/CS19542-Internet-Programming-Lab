<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("https://images.pexels.com/photos/2291599/pexels-photo-2291599.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2");
            background-size: cover;
            background-attachment: fixed;
        }
        .main-content {
            margin-top: 100px;
        }
        .confirmation-card {
            display: none; /* Initially hidden */
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Hotel Dashboard</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Rooms</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Bookings</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
            </ul>
        </div>
    </nav>

    <h2 style="color:white;">Reserve a table at our exclusive dining area</h2>
    
    <!-- Dining Service Card -->
    <div class="container main-content">
        <h2 class="mt-4">Dining Services</h2>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <img src="images/pexels-jan-van-der-wolf-11680885-16648471.jpg" class="card-img-top" alt="Dining Service">
                    <div class="card-body">
                        <h5 class="card-title">Dining Services</h5>
                        <p class="card-text">Enjoy our exquisite dining options, featuring gourmet meals and a variety of cuisines.</p>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#diningModal">Book your seat Now!</button>
                    </div>
                </div>
            </div>

            <!-- Confirmation Card -->
            <div class="col-md-6">
                <div id="confirmationCard" class="card confirmation-card">
                    <div class="card-body">
                        <h5 class="card-title">Booking Confirmed!</h5>
                        <p id="confirmationText" class="card-text"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Calendar and Booking Form -->
    <div class="modal fade" id="diningModal" tabindex="-1" aria-labelledby="diningModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="diningModalLabel">Dining Reservation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="calendar"></div>

                    <form id="bookingForm" class="mt-4">
                        <h3>Book a Dining Service</h3>
                        <label for="service">Service:</label>
                        <select id="service" name="service" class="form-control">
                            <option value="dining">Dining</option>
                        </select><br>

                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" class="form-control" required><br>

                        <label for="time">Time:</label>
                        <input type="time" id="time" name="time" class="form-control" required><br>

                        <label for="numGuests">Number of Guests:</label>
                        <input type="number" id="numGuests" name="numGuests" class="form-control" required><br>

                        <label for="tableLayout">Table Layout:</label>
                        <select id="tableLayout" name="tableLayout" class="form-control">
                            <option value="window">Window-side</option>
                            <option value="garden">Garden View</option>
                            <option value="private">Private Booth</option>
                            <option value="open">Open Area</option>
                        </select><br>

                        <label for="dietPreferences">Dietary Preferences:</label>
                        <textarea id="dietPreferences" name="dietPreferences" class="form-control" placeholder="e.g., vegetarian, gluten-free"></textarea><br>

                        <button type="button" class="btn btn-primary" onclick="submitForm()">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.0/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                dateClick: function(info) {
                    document.getElementById('date').value = info.dateStr;
                }
            });
            calendar.render();
        });

        function submitForm() {
            const formData = {
                service: document.getElementById('service').value,
                date: document.getElementById('date').value,
                time: document.getElementById('time').value,
                numGuests: document.getElementById('numGuests').value,
                tableLayout: document.getElementById('tableLayout').value,
                dietPreferences: document.getElementById('dietPreferences').value,
            };

            fetch('submit_booking.php.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Hide the modal after form submission
                    $('#diningModal').modal('hide');
                    // Show the confirmation card and display user details
                    document.getElementById('confirmationCard').style.display = 'block';
                    document.getElementById('confirmationText').innerHTML = `
                        Your booking for <strong>${data.details.numGuests}</strong> guests on <strong>${data.details.date}</strong> at <strong>${data.details.time}</strong> has been confirmed.
                        <br><br><strong>Service:</strong> ${data.details.service}
                        <br><strong>Table Layout:</strong> ${data.details.tableLayout}
                        <br><strong>Dietary Preferences:</strong> ${data.details.dietPreferences}
                    `;
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
