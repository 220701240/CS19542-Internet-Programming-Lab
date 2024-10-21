<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spa Services</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/pexels-gapeppy1-2373201.jpg'); /* Replace with your spa background image */
            background-size: cover;
            background-attachment: fixed;
        }
        .card {
            margin-top: 50px;
        }
        #bookingDetailsCard {
            display: none; /* Hide the card initially */
        }
    </style>
</head>
<body>
    <div class="container main-content">
        <h2 class="mt-4">Spa Services</h2>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <img src="images/pexels-quang-nguyen-vinh-222549-2134224.jpg" class="card-img-top" alt="Relaxing Spa">
                    <div class="card-body">
                        <h5 class="card-title">Relaxing Spa</h5>
                        <p class="card-text">Enjoy a rejuvenating spa experience with our top-notch facilities and professional staff.</p>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#spaModal">Book Now!</button>
                    </div>
                </div>
            </div>

            <!-- Booking Details Card -->
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm" id="bookingDetailsCard">
                    <div class="card-body">
                        <h5 class="card-title">Registration Status</h5>
                        <p id="bookingDetails"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <h3>Leave Your Feedback</h3>
        <form id="feedbackForm" class="mt-3">
            <div class="form-group">
                <label for="customerName">Your Name:</label>
                <input type="text" id="customerName" name="customerName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="rating">Rating:</label>
                <select id="rating" name="rating" class="form-control" required>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Good</option>
                    <option value="3">3 - Average</option>
                    <option value="2">2 - Poor</option>
                    <option value="1">1 - Terrible</option>
                </select>
            </div>
            <div class="form-group">
                <label for="review">Your Review:</label>
                <textarea id="review" name="review" class="form-control" rows="4" required></textarea>
            </div>
            <button type="button" class="btn btn-primary" onclick="submitFeedback()">Submit</button>
        </form>
    </div>

    <!-- Reviews Display -->
    <div class="mt-4">
        <h3>Customer Reviews</h3>
        <div id="reviewsList" class="list-group"></div>
    </div>

    <!-- Modal for Spa Booking -->
    <div class="modal fade" id="spaModal" tabindex="-1" role="dialog" aria-labelledby="spaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="spaModalLabel">Book Your Spa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="spaBookingForm">
                        <div class="form-group">
                            <label for="userName">Name</label>
                            <input type="text" class="form-control" id="spaName" placeholder="Enter your name" required>
                        </div>
                        <div class="form-group">
                            <label for="spaDate">Date</label>
                            <input type="date" class="form-control" id="spaDate" required>
                        </div>
                        <div class="form-group">
                            <label for="spaTime">Time</label>
                            <input type="time" class="form-control" id="spaTime" required>
                        </div>
                        <div class="form-group">
                            <label for="guestCount">Number of Guests</label>
                            <input type="number" class="form-control" id="spaGuests" placeholder="Enter number of guests" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitSpaForm()">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function submitFeedback() {
    const name = document.getElementById('customerName').value;
    const rating = document.getElementById('rating').value;
    const review = document.getElementById('review').value;

    const feedbackData = {
        name: name,
        rating: rating,
        review: review,
    };

    // Here, you can send the feedbackData to your server via AJAX, or store it locally for demo purposes
    // For now, let's just display it on the page
    const reviewsList = document.getElementById('reviewsList');
    const reviewItem = document.createElement('div');
    reviewItem.className = 'list-group-item list-group-item-action';
    reviewItem.innerHTML = `<strong>${feedbackData.name} (${feedbackData.rating}/5)</strong><p>${feedbackData.review}</p>`;
    reviewsList.appendChild(reviewItem);

    // Clear the form fields
    document.getElementById('feedbackForm').reset();
}

        function submitSpaForm() {
            const name = document.getElementById('spaName').value;
            const date = document.getElementById('spaDate').value;
            const time = document.getElementById('spaTime').value;
            const guests = document.getElementById('spaGuests').value;

            // AJAX request to check for existing booking
            $.ajax({
                type: "POST",
                url: "check_spa_booking.php.php", // Change this to your actual check script path
                data: {
                    spaName: name,
                    spaDate: date,
                    spaTime: time
                },
                success: function(response) {
                    const result = JSON.parse(response);
                    if (result.status === "error") {
                        // Display error message
                        document.getElementById('bookingDetails').innerHTML = result.message;
                        document.getElementById('bookingDetailsCard').style.display = 'block';
                    } else {
                        // Proceed to book if no conflict
                        $.ajax({
                            type: "POST",
                            url: "process_spa_booking.php.php", // Change this to your actual processing script path
                            data: {
                                spaName: name,
                                spaDate: date,
                                spaTime: time,
                                spaGuests: guests
                            },
                            success: function(bookingResponse) {
                                // Show successful booking message
                                document.getElementById('bookingDetails').innerHTML = bookingResponse;
                                document.getElementById('bookingDetailsCard').style.display = 'block';
                            }
                        });
                    }
                }
            });

            $('#spaModal').modal('hide'); // Hide the modal after submission
        }
    </script>
</body>
</html>
