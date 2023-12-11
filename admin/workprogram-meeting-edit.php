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
                        <h4>Edit Meeting</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['no'])) {
                            $id_meeting = $_GET['no'];
                            $users = "SELECT * FROM tb_rapat WHERE no_rapat='$id_meeting'";
                            $users_run = mysqli_query($con, $users);

                            if (mysqli_num_rows($users_run) > 0) {
                                foreach ($users_run as $user) {
                                    ?>
                                    <form action="code-workprogram-meeting.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id_meeting" value="<?= $user['no_rapat']; ?>">
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
                                            <input type="text" id="subject" name="subject" value="<?= $user['subjek']; ?>"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="meeting_date">Meeting Date</label>
                                            <input type="date" id="meeting_date" name="meeting_date" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="formatted_date">Formatted Date</label>
                                            <input type="text" id="formatted_date" name="formatted_date"
                                                value="<?= $user['tgl_rapat']; ?>" class="form-control" readonly>
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
                                            <button type="submit" name="update_workprogram-meeting" class="btn btn-primary">Update
                                                Work Program</button>
                                        </div>
                                    </form>
                                    <?php
                                }
                            } else {
                                ?>
                                <h4>No Record Found</h4>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Get the initial value of id_program input
        var id_program = $('#id_program').val();

        // Function to retrieve and set the program name
        function getProgramName(id) {
            $.ajax({
                url: 'workprogram-meeting-add-auto.php',
                type: 'POST',
                data: { id_program: id },
                success: function (response) {
                    $('#name_program').val(response);
                }
            });
        }

        // Trigger the AJAX request on page load with the initial value
        getProgramName(id_program);

        // Trigger the AJAX request when id_program input value changes
        $('#id_program').on('input', function () {
            var id_program = $(this).val();
            getProgramName(id_program);
        });
    });

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