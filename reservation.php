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
        <section class="reservation">
            <div class="container my-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1>Reservation</h1>
                        <span class="showResponse w-50 mx-auto"></span>
                    </div>
                    <div class="col-12 col-md-8 mx-auto">
                        <form id="reservation-form" method="post">
                            <div class="row">
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
                                        <label for="start-time">Date & Time <span class="text-danger">*</span></label>
                                        <input type="datetime-local" name="start_time" id="start-time" class="form-control" required disabled>
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
                                            <option value="4">More Three Members</option>
                                            <!-- <option value="4">Four Members</option>
                                            <option value="5">Five Members</option>
                                            <option value="6">Six Members</option> -->
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
                                            <option value="4">More Three Tables</option>
                                            <!-- <option value="4">Four Tables</option>
                                            <option value="5">Five Tables</option> -->
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
                                        <label for="events">Events</label>
                                        <select name="events" id="events" class="form-select">
                                            <option value="" selected hidden>Select Event</option>
                                            <option value="">No Event</option>
                                            <option value="birthday">Birthday</option>
                                            <option value="anniversary">Anniversary</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-3 cafe_info d-none">
                                    <div class="render_cafe_info"></div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <h6 class="text-secondary">Fields with <span class="text-danger">*</span> are mandatory</h6>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <input type="hidden" name="end_time" id="end" value="">
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

            // Add a custom validation method to check future date and time
            $.validator.addMethod("futureDateTime", function(value, element) {
                var selectedDateTime = new Date(value);
                var currentDateTime = new Date();
                return selectedDateTime >= currentDateTime;
            }, "Please select a current or future date and time.");

            // Add a custom validation method to check if the time is within store hours
            $.validator.addMethod("withinStoreHours", function(value, element) {
                let storeOpenTime = $("#start-time").data("storeOpenTime");
                let storeCloseTime = $("#start-time").data("storeCloseTime");

                if (!storeOpenTime || !storeCloseTime) {
                    return true; // Skip validation if store hours are not set yet
                }

                var selectedDate = new Date(value);
                var selectedTime = selectedDate.getHours() * 60 + selectedDate.getMinutes();
                var storeOpenMinutes = parseInt(storeOpenTime.split(':')[0]) * 60 + parseInt(storeOpenTime.split(':')[1]);
                var storeCloseMinutes = parseInt(storeCloseTime.split(':')[0]) * 60 + parseInt(storeCloseTime.split(':')[1]);

                return selectedTime >= storeOpenMinutes && selectedTime <= storeCloseMinutes;
            }, "Please select a time within the store's opening hours.");

            $("#cafe").on('change', function(e) {
                e.preventDefault();
                $("#start-time").removeAttr('disabled');
                let cafeID = $(this).val();
                $.ajax({
                    url: 'ajax/cafe_info.php',
                    method: 'POST',
                    data: {
                        cafeID: cafeID
                    },
                    success: function(res) {
                        $(".cafe_info").removeClass("d-none");
                        $(".render_cafe_info").html(res);

                        const date = new Date();
                        const year = date.getFullYear();
                        const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
                        const day = String(date.getDate()).padStart(2, '0');
                        const hours = String(date.getHours()).padStart(2, '0');
                        const minutes = String(date.getMinutes() + 3).padStart(2, '0');
                        const formattedDate = `${year}-${month}-${day}T${hours}:${minutes}`;


                        // Get store open and close times
                        let storeOpenTime = $("#store_open_time").val();
                        let storeCloseTime = $("#store_close_time").val();
                        // console.log(currentDate);
                        $("#start-time").val(formattedDate);

                        $("#start-time").data("storeOpenTime", storeOpenTime);
                        $("#start-time").data("storeCloseTime", storeCloseTime);
                        $("#start-time").focus();
                    }
                });
            });

            $("#reservation-form").validate({
                rules: {
                    "start_time": {
                        futureDateTime: true,
                        withinStoreHours: true
                    }
                },
                messages: {
                    "start_time": {
                        futureDateTime: "Please select a current or future date and time.",
                        withinStoreHours: "Please select a time within the store's opening hours."
                    }
                },
                submitHandler: function(form) {
                    // If the form is valid, you can proceed with form submission or other actions
                    let formData = $("#reservation-form").serialize();
                    $.ajax({
                        url: "ajax/reservationForm.php",
                        method: "POST",
                        data: formData,
                        success: function(response) {
                            let res = JSON.parse(response);
                            $(".showResponse").addClass(`d-block alert alert-${res.status}`).html(res.msg);
                            setTimeout(() => {
                                // $(".showResponse").removeClass(`d-block alert alert-${res.status}`).html('');
                                window.location.href = './dashboard.php';
                            }, 1800);
                        }
                    })
                }
            });

            $("#start-time").on("change", function(e) {
                e.preventDefault();
                let date1 = $(this).val();
                console.log(date1);
                var d1 = new Date(date1);
                var d2 = new Date(d1);
                d2.setMinutes(d1.getMinutes() + 60);

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