<header>
    <div class="mobile-menu d-block d-md-none pe-5">
        <a href="#!" class="btn btn-primary btn-sm btn-slide-menu">
            <i class="fas fa-bars"></i>
        </a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-2 content-center">
                <a href="./">
                    <img src="./img/logo_bg_black.png" class="w-25" alt="logo-1">
                </a>
                <!-- <h3>LOGO</h3> -->
            </div>
            <div class="col-7 content-center">
                <ul class="navigation list-unstyled d-flex gap-5">
                    <li><a href="./">Home</a></li>
                    <li><a href="#!">About</a></li>
                    <li><a href="./menu.php">Menu</a></li>
                </ul>
            </div>
            <div class="col-3 content-center gap-3 flex-column flex-md-row">
                <?php if (isLoggedin() === true) : ?>
                    <a class="btn btn-primary border border-3" href="reservation.php">Reservation</a>
                    <?php if ($userRole == 'admin') : ?>
                        <a class="btn btn-primary border border-3" href="adminDashboard.php">Dashboard</a>
                    <?php elseif ($userRole == 'cafe_owner') : ?>
                        <a class="btn btn-primary border border-3" href="cafeOwnerDashboard.php">Dashboard</a>
                    <?php else : ?>
                        <a class="btn btn-primary border border-3" href="dashboard.php">Dashboard</a>
                    <?php endif; ?>
                    <a class="btn btn-danger border border-3" href="logout.php">Logout</a>
                <?php else : ?>
                    <a class="btn btn-primary border border-3" href="./login.php">Reservation</a>
                    <a class="btn btn-success border border-3" href="./login.php">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>