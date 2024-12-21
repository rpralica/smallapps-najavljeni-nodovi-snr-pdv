<?php
require "../settings/connection.php";

$id = $_GET['id'];
$sql = "SELECT *FROM najave WHERE id=$id";
$query = mysqli_query($db, $sql);
$result = mysqli_fetch_assoc($query);

$error = $_GET['error'] ?? ''; // Get the error parameter from the URL


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="shortcut icon" href="../supernova.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <title>Edit Record</title>

</head>

<body>
    <div class="container">
        <br><br>

        <div class="jumbotron container">
            <h1 class="text-center">Edit</h1>
        </div>
        <br><br>
        <div class="col-6 offset-2">
            <?php
            if ($error === 'invalid_date_range') {
                echo '<div class="alert alert-danger text-center" role="alert"><strong>Trajanje ne može biti manje od početka.</strong></div>';
            }
            ?>
        </div>
        <div class="row">
            <form action="../helpers/update.php" method="POST">
                <br><br>
                <div class="col-6 offset-2">
                    <input type="hidden" class="form-control" name="id" value="<?php echo $result['id'] ?>"><br>
                    <label class="form-control  h4 bg-info"><strong>Mrežni Element</strong></label>
                    <input type="text" class="form-control " name="element" value="<?php echo $result['element'] ?>"><br>
                    <?php
                    if ($error === 'empty_element') {
                        echo '<div class="alert   alert-danger pt-1 fw-bold text-center  alert-dismissible fade show" style="height:2rem" role="alert">
                             Popunite element
                            <button type="button" class="btn-close  pt-1" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                    ?>
                    <label class="form-control  h4 bg-info"><strong>Lokacija</strong></label>
                    <input type="text" class="form-control" name="lokacija" value="<?php echo $result['lokacija'] ?>"><br>

                    <?php
                    if ($error === 'empty_lokacija') {
                        echo '<div class="alert   alert-danger pt-1 fw-bold text-center  alert-dismissible fade show" style="height:2rem" role="alert">
                             Popunite lokaciju
                            <button type="button" class="btn-close  pt-1" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                    ?>

                    <label class="form-control  h4 bg-info"><strong>Početak Radova</strong></label>
                    <input type="datetime-local" class="form-control" id="pocetak" name="pocetak" value="<?php echo $result['pocetak'] ?>"><br>
                    <label class="form-control  h4 bg-info"><strong>Trajanje Radova</strong></label>
                    <input type="datetime-local" class="form-control" name="trajanje" id="kraj" value="<?php echo $result['trajanje'] ?>"><br>
                    <label class="form-control  h4 bg-info"><strong>Komentar</strong></label> <br>
                    <textarea type="text" class="form-control" name="komentar" cols="53" rows="5"><?php echo $result['komentar'] ?></textarea> <br>
                    <button type="submit" name="btnUpdate" class="btn btn-info offset-2 w-50">Update</button>
                    <br><br>
                </div>
            </form>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        flatpickr('#pocetak', {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        flatpickr('#kraj', {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
    </script>
</body>

</html>