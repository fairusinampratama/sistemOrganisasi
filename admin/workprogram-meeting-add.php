<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h4 class="mt-4">Main Work</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Work Program</li>
            <li class="breadcrumb-item">Meeting</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Meeting
                            <a href="view-workprogram-meeting.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code-workprogram-meeting.php" method="post" enctype="multipart/form-data">
                            <div class="col-md-6 mb-3">
                                <label for="id_program">Work Program Name</label>
                                <select id="id_program" name="id_program" class="form-control" readonly>
                                    <?php
                                    $query = "SELECT no_proker, nama_proker FROM tb_proker";
                                    $result = mysqli_query($con, $query);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $no_proker = $row['no_proker'];
                                        $nama_proker = $row['nama_proker'];
                                        echo "<option value='$no_proker'>$nama_proker</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" name="subject" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="meeting_date">Meeting Date</label>
                                <input type="date" id="meeting_date" name="meeting_date" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="formatted_date">Formatted Date</label>
                                <input type="text" id="formatted_date" name="formatted_date" class="form-control"
                                    readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="invitation">Invitation</label>
                                <input type="file" id="invitation" name="invitation" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="reports">Reports</label>
                                <input type="file" id="reports" name="reports" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" name="add_workprogram-meeting" class="btn btn-primary">Add
                                    Work Program</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to format the date as day, date-month-year
    function formatMeetingDate(date) {
        const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
        const formatter = new Intl.DateTimeFormat('id-ID', options);
        return formatter.format(date);
    }

    // Event handler for the date input field
    $('#meeting_date').on('change', function () {
        const selectedDate = new Date($(this).val());

        // Check if the selected date is valid
        if (!isNaN(selectedDate.getTime())) {
            const formattedDate = formatMeetingDate(selectedDate);
            $('#formatted_date').val(formattedDate);
        } else {
            $('#formatted_date').val('');
        }
    });
</script>



<?php
include('includes/footer.php');
include('includes/scripts.php');
?>