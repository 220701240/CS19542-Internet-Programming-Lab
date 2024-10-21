<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Management Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/pexels-macnalodao-17748655.jpg');
            background-size: cover;
            background-attachment: fixed;
        }
        .main-content {
            margin-top: 100px; /* Adjust the margin as needed */
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Lenara Hotel Dashboard</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="bookings.php.php">Bookings</a></li>
                <li class="nav-item"><a class="nav-link" href="event.php.php">Event Spaces</a></li>
                <li class="nav-item"><a class="nav-link" href="spa.php.php">Spa Services</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container main-content">
                <h2 id="welcomeText" class="mt-4" style="color:white;">Hello User!!</h2>

        <h2 id="welcomeText" class="mt-4" style="color:white;">Our Services</h2>
                <h2 id="welcomeText" class="mt-4" style="color:white;">Dinning Services</h2>
        <h2 id="welcomeText" class="mt-4" style="color:white;">Event Spaces</h2>
        <h2 id="welcomeText" class="mt-4" style="color:white;">Spa services</h2>

        <div class="row mt-4">
            <!-- Other Services ... -->
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="loginForm">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="submitLogin()">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function submitLogin() {
            const username = document.getElementById('username').value;
            if (username) {
                // Update the welcome text
                document.getElementById('welcomeText').textContent = `Hello, ${username}`;
                // Hide the modal
                $('#loginModal').modal('hide');
            }
        }
    </script>
</body>
</html>
