<?php
//Connection
require "../settings/connection.php";




$element = $lokacija = $pocetak = $trajanje = '';
$errors = array('element' => '', 'lokacija' => '', 'pocetak' => '', 'trajanje' => '', 'veciDatum' => '');

if (isset($_POST['btnSub'])) {
    $element = htmlspecialchars($_POST['element']);
    $lokacija = htmlspecialchars($_POST['lokacija']);
    $pocetak = htmlspecialchars($_POST['pocetak']);
    $trajanje = htmlspecialchars($_POST['trajanje']);
    $komentar = htmlspecialchars($_POST['komentar']);

    // check ime
    if (empty($_POST['element'])) {
        $errors['element'] = 'Upišite mrežni element';
    } else {
        $element = $_POST['element'];
    }

    // check title
    if (empty($_POST['lokacija'])) {
        $errors['lokacija'] = 'Upišite lokacija';
    } else {
        $lokacija = $_POST['lokacija'];
    }

    // check ingredients
    if (empty($_POST['pocetak'])) {
        $errors['pocetak'] = 'Upišite početak radova';
    } else {
        $pocetak = $_POST['pocetak'];
    }

    if (empty($_POST['trajanje'])) {
        $errors['trajanje'] = 'Upišite trajanje';
    } else {
        if ($trajanje <= $pocetak) {
            $errors['veciDatum'] = 'Kraj radova ne može biti manje od početka';
        }
        $trajanje = $_POST['trajanje'];
    }

    $komentar = htmlspecialchars($_POST['komentar']);


    if (array_filter($errors)) {
        //echo 'errors in form';
    } else {
        $sql = "INSERT INTO najave VALUES (NULL,'$element','$lokacija','$pocetak','$trajanje','$komentar')";
        $query = mysqli_query($db, $sql);

        if ($query) {
            header("Location: ../index.php");
        }
    }
}
?>

<?php

if (isset($_POST['btnHome'])) {
    header('Location:../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../supernova.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    <title>Novi Zadatak</title>
</head>
<div class="container">
    <br>
    <div class="row">
        <?php ?>
        <div class="jumbotron container">
            <h1 class="text-center">Novi Zadatak</h1>
        </div>
        <br>
        <?php if ($errors['veciDatum']) : ?>
            <div class="alert  alert-danger   text-center fw-bold  alert-dismissible fade show" role="alert">
                <?php echo $errors['veciDatum'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <br><br>
            <div class="col-6 offset-2">
                <div class="form-floating ">
                    <input type="text" class="form-control" style="height:2.5rem" name="element" style="" placeholder="Upišite mrežni element" value="<?php echo $element ?>"><br>
                    <label for="floatingInput" style="padding-top:0.5em">Mrežni Element</label>
                </div>
                <?php if ($errors['element']) : ?>
                    <div class="alert  alert-danger   text-center fw-bold  alert-dismissible fade show" role="alert">
                        <?php echo $errors['element'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>
                <div class="form-floating">
                    <input type="text" class="form-control" style="height:2.5rem" name="lokacija" placeholder="Upišite lokaciju" value="<?php echo $lokacija ?>"><br>
                    <label for="floatingInput" style="padding-top:0.5em">Lokacija</label>
                </div>
                <?php if ($errors['lokacija']) : ?>
                    <div class="alert alert-danger text-center fw-bold  alert-dismissible fade show" role="alert">
                        <?php echo $errors['lokacija'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>
                <div class="form-floating">
                    <input type="text" id="pocetak" class="form-control" style="height:2.5rem" name="pocetak" placeholder="Upišite početak radova" value="<?php echo $pocetak; ?>"><br>
                    <label for="floatingInput" style="padding-top:0.5em">Početak radova</label>
                </div>
                <?php if ($errors['pocetak']) : ?>
                    <div class="alert alert-danger text-center fw-bold  alert-dismissible fade show" role="alert">
                        <?php echo $errors['pocetak'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>
                <div class="form-floating">
                    <input type="text" id="kraj" class="form-control" style="height:2.5rem" name="trajanje" placeholder="Upišite trajanje radova" value="<?php echo $trajanje; ?>"><br>
                    <label for="floatingInput" style="padding-top:0.5em">Trajanje radova</label>
                </div>

                <?php if ($errors['trajanje']) : ?>
                    <div class="alert alert-danger text-center fw-bold  alert-dismissible fade show" role="alert">
                        <?php echo $errors['trajanje'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>

                <div class="form-floating">
                    <textarea class="form-control" id="floatingTextarea" placeholder="Leave a comment here" style="height: 100px" name="komentar" cols="5" rows="18"></textarea> <br>
                    <label for="floatingTextarea">Komentar</label>
                </div>


                <br><br>




                <br><br>


                <div class="container">
                    <div class="row">
                        <div class="col-9">
                            <button name="btnSub" id="btnSave" type="submit" class="btn btn-info">Save</button>
                        </div>
                        <div class="col-3">

                            <button name="btnHome" id="btnHome" type="submit" class="btn btn-info ">Home</button>

                        </div>
                    </div>
                </div>



                <br><br>
            </div>
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