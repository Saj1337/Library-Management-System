<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light bg_color">
        <div class="container">
            <a class="navbar-brand font-weight-bold" style="font-family: 'Lato', sans-serif; color: #481639"
                href="index.php"><img src="images/leaf.jpg" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="index.php">Home</a>
                    </li>


                    <!-- If the user is logged in and session is set then these nav option will show -->
                    <?php if (isset($_SESSION['email'])) { ?>
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="profile.php">Profile
                        </a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="search.php">Search
                        </a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="dashboard.php">Dashboard
                        </a>
                    </li>
                    <li class="nav-item p-1 dropdown">
                        <a class="nav-link text-dark font-weight-bold dropdown-toggle" href="#" id="navbarDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Loan
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="borrowed-book.php">Borrow</a>
                            <a class="dropdown-item" href="return.php">Return</a>
                        </div>
                    </li>



                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="leaderboard.php">LeaderBoard
                        </a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="about_us.php">About Us
                        </a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="logout.php">Logout
                        </a>
                    </li>
                    <!-- Bell color changing depending on progress -->





                    <?php } else if (isset($_SESSION['admin'])) { ?>
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="admin.php">Add Books
                        </a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="book-details.php">View Books
                        </a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="leaderboard.php">LeaderBoard
                        </a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="about_us.php">About Us
                        </a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="logout.php">Logout
                        </a>
                    </li>
                    <?php } else { ?>
                    <!-- These are when user is not logged in -->
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="login.php">Login
                        </a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="register.php">Register
                        </a>
                    </li>
                    <!-- <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="register.php">Register
                        </a>
                    </li> -->
                    <li class="nav-item p-1">
                        <a class="nav-link text-dark font-weight-bold" href="about_us.php">About Us
                        </a>
                    </li>

                    <?php } ?>





                </ul>

            </div>
        </div>
    </nav>
</div>