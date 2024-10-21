<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Spaces</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/pexels-am83-14636319.jpg'); /* Replace with your event background image */
            background-size: cover;
            background-attachment: fixed;
            min-height: 100vh; /* Ensures it covers the entire viewport height */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Centers content vertically */
            padding: 0; /* Remove padding */
            margin: 0; /* Remove margin */
        }
        .content {
            flex: 1; /* Takes remaining space */
            display: flex;
            justify-content: flex-start; /* Aligns to the start (left) */
            align-items: center; /* Center vertically */
            overflow: hidden; /* Prevent overflow */
            padding: 0; /* No padding */
        }
        .card {
            margin: 50px 0 0 0; /* Only margin from the top */
            opacity: 0.9; /* Slightly transparent to blend with background */
            max-width: 600px; /* Limit card width for better visibility */
        }
        h2 {
            position: absolute; /* Position it over the background image */
            top: 20px; /* Positioning from top */
            left: 20px; /* Positioning from left */
            color: white; /* Text color for contrast */
        }
        #registrationDetailsCard {
            display: none; /* Hide the card initially */
        }
    </style>
</head>
<body>
    <h2 class="mt-4">Event Spaces</h2>
    <div class="content">
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <img src="images/pexels-vidalbalielojrfotografia-12689084.jpg" class="card-img-top" alt="Event Service">
                    <div class="card-body">
                        <h5 class="card-title">Conference Hall</h5>
                        <p class="card-text">Book our spacious and well-equipped conference hall for your events and meetings. Make your day memorable with our events planning...</p>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#eventModal">Book your event Now!</button>
                    </div>
                </div>
            </div>

            <!-- Registration Details Card -->
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm" id="registrationDetailsCard">
                    <div class="card-body">
                        <h5 class="card-title">Booking Successful!</h5>
                        <p id="registrationDetails"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Event Booking -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Book Your Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="bookingForm" method="POST" action="submit_event_booking.php">
                        <div class="form-group">
                            <label for="eventName">Event Name</label>
                            <input type="text" class="form-control" id="eventName" name="eventName" placeholder="Enter event name" required>
                        </div>
                        <div class="form-group">
                            <label for="eventDate">Event Date</label>
                            <input type="date" class="form-control" id="eventDate" name="eventDate" required>
                        </div>
                        <div class="form-group">
                            <label for="eventTime">Event Time</label>
                            <input type="time" class="form-control" id="eventTime" name="eventTime" required>
                        </div>
                        <div class="form-group">
                            <label for="eventGuests">Number of Guests</label>
                            <input type="number" class="form-control" id="eventGuests" name="eventGuests" placeholder="Enter number of guests" required>
                        </div>
                        <div class="form-group">
                            <label for="eventDetails">Additional Details</label>
                            <textarea class="form-control" id="eventDetails" name="eventDetails" rows="3" placeholder="Enter any additional details"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm()">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function submitForm() {
            const form = document.getElementById('bookingForm');
            if (form.checkValidity()) {
                // Use AJAX to submit the form without refreshing the page
                $.ajax({
                    type: "POST",
                    url: "submit_event_booking.php.php", // Remove the duplicate .php
                    data: $(form).serialize(),
                    success: function(response) {
                        // Assuming the response contains the booking details
                        document.getElementById('registrationDetails').innerHTML = response;
                        document.getElementById('registrationDetailsCard').style.display = 'block';
                        $('#eventModal').modal('hide'); // Hide the modal after submission
                        form.reset(); // Reset the form
                    },
                    error: function() {
                        alert('There was an error processing your request. Please try again.');
                    }
                });
            } else {
                form.reportValidity(); // Show validation errors
            }
        }
    </script>
</body>
</html>
