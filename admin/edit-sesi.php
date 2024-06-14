<?php
    //import database
    include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $id = $_POST['id00'];
    $name = $_POST['name'];
    $dokter = $_POST['dokter'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $jumlah = $_POST['jumlah'];

    // Retrieve the doctor ID based on the doctor's name
    $sqlDoc = "SELECT docid FROM doctor WHERE docname='$dokter'";
    $resultDoc = $database->query($sqlDoc);

    if ($resultDoc->num_rows > 0) {
        $rowDoc = $resultDoc->fetch_assoc();
        $docid = $rowDoc['docid'];

        // Update the schedule in the database
        $sqlUpdate = "UPDATE schedule SET title='$name', docid='$docid', scheduledate='$tanggal', scheduletime='$waktu', nop='$jumlah' WHERE scheduleid='$id'";
        if ($database->query($sqlUpdate) === TRUE) {
            echo "Record updated successfully";
            header("Location: schedule.php"); // Redirect to schedule page after updating
            exit();
        } else {
            echo "Error updating record: " . $database->error;
        }
    } else {
        echo "Doctor not found";
    }
} else {
    echo "Invalid request";
}

$database->close();
?>
