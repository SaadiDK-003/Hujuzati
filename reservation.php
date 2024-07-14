<?php
require_once './core/database.php';

if (isLoggedin() === false) {
    header('Location: login.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITLE ?> | Reservation</title>
    <?php include './includes/css_links.php'; ?>
    <link rel="stylesheet" href="./css/style.min.css">
</head>

<body class="reservation_page">
    <?php include_once './includes/header.php'; ?>
    <main>
        <section class="login">
            <div class="container my-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1>Reservation</h1>
                    </div>
                    <div class="col-12 col-md-8 mx-auto">
                        <form id="reservation-form" method="post">
                            <div class="row">
                                <!-- <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="phone">Phone <span class="text-danger">*</span></label>
                                        <input type="tel" name="phone" id="phone" class="form-control" required>
                                    </div>
                                </div> -->
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="start-time">Date & Time <span class="text-danger">*</span></label>
                                        <input type="datetime-local" name="start_time" id="start-time" class="form-control" required>
                                        <input type="hidden" name="end_time" id="end" value="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="total-members">Total members <span class="text-danger">*</span></label>
                                        <select name="total_members" id="total-members" class="form-select" required>
                                            <option value="" selected hidden>Select Members</option>
                                            <option value="1">Single Person</option>
                                            <option value="2">Two Members</option>
                                            <option value="3">Three Members</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="total-tables">How many tables <span class="text-danger">*</span></label>
                                        <select name="total_tables" id="total-tables" class="form-select" required>
                                            <option value="" selected hidden>Select Tables</option>
                                            <option value="1">One Table</option>
                                            <option value="2">Two Tables</option>
                                            <option value="3">Three Tables</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="table-location">Table Location <span class="text-danger">*</span></label>
                                        <select name="table_location" id="table-location" class="form-select" required>
                                            <option value="" selected hidden>Select Table Location</option>
                                            <option value="inside">Inside</option>
                                            <option value="outside">Outside</option>
                                            <option value="near-window">Near Window</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="cafe">Cafe</label>
                                        <select name="cafe" id="cafe" class="form-select" required>
                                            <option value="" selected hidden>Select Cafe</option>
                                            <?php
                                            $c_list = $db->query("CALL `select_all_cafe`()");
                                            while ($cafe_list = mysqli_fetch_object($c_list)) : ?>
                                                <option value="<?= $cafe_list->cafeID ?>"><?= $cafe_list->store_name ?></option>
                                            <?php endwhile;
                                            $c_list->close();
                                            $db->next_result();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="events">Events</label>
                                        <select name="events" id="events" class="form-select">
                                            <option value="" selected hidden>Select Event</option>
                                            <option value="">No Event</option>
                                            <option value="birthday">Birthday</option>
                                            <option value="anniversary">Anniversary</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <h6 class="text-secondary">Fields with <span class="text-danger">*</span> are mandatory</h6>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <button type="submit" id="submit" class="d-block mx-auto mx-md-0 ms-md-auto w-25 btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <?php include './includes/js_links.php'; ?>
    <script>
        $(document).ready(function() {

            // Add a custom validation method
            $.validator.addMethod("futureDateTime", function(value, element) {
                var selectedDateTime = new Date(value);
                var currentDateTime = new Date();
                return selectedDateTime >= currentDateTime;
            }, "Please select a current or future date and time.");

            $("#cafe").on('change', function(e) {
                e.preventDefault();
                let cafeID = $(this).val();
                $.ajax({
                    url: 'ajax/cafe_info.php',
                    method: 'POST',
                    data: {
                        cafeID: cafeID
                    },
                    success: function(res) {

                    }
                });
            });


            $("#reservation-form").validate({
                rules: {
                    "start_time": {
                        futureDateTime: true
                    }
                },
                submitHandler: function(form) {
                    // If the form is valid, you can proceed with form submission or other actions
                    let formData = $("#reservation-form").serialize();
                    $.ajax({
                        url: "ajax/reservationForm.php",
                        method: "POST",
                        data: formData,
                        success: function(res) {
                            console.log(res);
                        }
                    })
                }
            });

            $("#start-time").on("change", function(e) {
                e.preventDefault();
                let date1 = $(this).val();
                var d1 = new Date(date1);
                d2 = new Date(d1);
                d2.setMinutes(d1.getMinutes() + 180);
                // Formatting d2 to "yyyy-MM-ddTHH:mm"
                let year = d2.getFullYear();
                let month = String(d2.getMonth() + 1).padStart(2, "0"); // Months are zero-based, so add 1
                let day = String(d2.getDate()).padStart(2, "0");
                let hours = String(d2.getHours()).padStart(2, "0");
                let minutes = String(d2.getMinutes()).padStart(2, "0");

                let formattedDate = `${year}-${month}-${day}T${hours}:${minutes}`;

                $("#end").val(formattedDate);
            });
        });
    </script>
</body>

</html>