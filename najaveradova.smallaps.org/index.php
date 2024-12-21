<?php require "./settings/connection.php";
$sql = "SELECT * FROM najave ORDER BY id";
$query = mysqli_query($db, $sql);
$results = mysqli_fetch_all($query, MYSQLI_ASSOC);
//Početak
$cnt = 1;
//Kreiranje
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="supernova.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Najave Radova</title>
</head>

<body>

    <?php include './partials/navbar.php'; ?>
    <br><br>
    <div class="jumbotron container">
        <h1 class="text-center fw-bold text-danger">Najave Radova</h1>
    </div>
    <br><br>
    <div class="container ">
        <div class="row ">
            <div class="col-12 ">
                <table class="table  table-bordered  table-responsive-sm" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>Br</th>
                            <th>Mrežni Element (link)</th>
                            <th>Lokacija</th>
                            <th>Početak</th>
                            <th>Kraj</th>
                            <th>Komentar</th>
                            <th>Akcija</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $today = new DateTime();
                        ?>
                        <?php foreach ($results as $result) : ?>
                            <tr class="bg-<?php

                                            $termin = new DateTime($result['trajanje']);
                                            if ($termin > $today) {
                                                echo 'light';
                                            } elseif ($termin < $today) {
                                                echo 'danger';
                                            }
                                            ?> text-<?php


                                                    if ($termin > $today) {
                                                        echo 'dark';
                                                    } elseif ($termin < $today) {
                                                        echo 'light';
                                                    }
                                                    ?>">
                                <td style="padding-top:1.5rem"><?php echo $cnt++; ?></td>
                                <td style="padding-top:1.5rem"><?php echo $result['element']; ?></td>
                                <td style="padding-top:1.5rem;width:10rem"><?php echo $result['lokacija']; ?></td>
                                <td style="padding-top:1.5rem"><?php echo date("d.m.Y H:i", strtotime($result['pocetak'])); ?></td>
                                <td style="padding-top:1.5rem"><?php echo date("d.m.Y H:i", strtotime($result['trajanje'])); ?></td>
                                <td style="padding-top:1.5rem;width:25rem"><?php echo $result['komentar']; ?></td>
                                <td style="width:13rem">
                                    <button name="Edit" class="btn  btn-warning m-3 border border-3 border-light"><a class="text-decoration-none text-white" href="./components/edit.php?id=<?php echo $result['id']; ?>">Edit</a></button>
                                    <button name="Delete" class="btn  btn-danger m-2 border border-3 border-light"><a class="text-decoration-none text-white" href="./components/delete.php?id=<?php echo $result['id']; ?>">Delete</a>
                                    </button>
                                </td>
                            </tr>

                        <?php endforeach ?>
                    </tbody>
                </table>
                <br>
                <div class="container ">

                    <button class="btn btn-info offset-5 "><a class="text-decoration-none fw-bold text-white" href="./components/add.php">Dodaj novi rad</a></button>
                    <br><br><br><br>
                </div>
            </div>
        </div>

        </form>
    </div>
</body>

</html>