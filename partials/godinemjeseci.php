<?php
$godine = $mjeseci = $totalMjes = $gd = $mj = '';
$god = $mjes = $dana = '';
$inpDays = $years = $months = $days = '';

$errors = ['godine' => '', 'mjeseci' => '', 'razlika' => ''];

if (isset($_POST['calcGodMjes'])) {
    $godine = filter_var($_POST['godine'], FILTER_SANITIZE_NUMBER_INT);
    $mjeseci = filter_var($_POST['mjeseci'], FILTER_SANITIZE_NUMBER_INT);

    if (empty($godine)) {
        $godine = 0;
    }
    if (empty($mjeseci)) {
        $mjeseci = 0;
    }

    $totalMjes = $godine * 12 + $mjeseci;
    $gdi = $totalMjes / 12;
    $gd = floor($gdi);
    $mj = $totalMjes % 12;
}

if (isset($_POST['diffDate'])) {
    $pocetak = htmlspecialchars($_POST['pocetak']);
    $kraj = htmlspecialchars($_POST['kraj']);

    $date1 = date_create($pocetak);
    $date2 = date_create($kraj);

    if ($date1 >= $date2) {
        $errors['razlika'] = 'Početni datum mora biti manji od krajnjeg datuma.';
    } else {
        $diff = date_diff($date2, $date1);
        $god = $diff->format("%y");
        $mjes = $diff->format("%m");
        $dana = $diff->format("%d");
    }
}

if (isset($_POST['convertDays'])) {
    $inpDays = filter_var($_POST['inpDays'], FILTER_SANITIZE_NUMBER_INT);

    if (!empty($inpDays)) {
        $years = floor($inpDays / 365);
        $months = floor(($inpDays - ($years * 365)) / 30.5);
        $days = floor($inpDays - ($years * 365) - ($months * 30.5));
    } else {
        $inpDays = 0;
    }
}
?>

<form action="<?php echo 'razlikedatuma.php#datumi'; ?>" method="post">
    <div class="container ">
        <div style="background: lightskyblue;" class="row  rounded   mb-5">
            <div class="col-6">
                <br><br>
                <h2 class="text-center">Godine i mjeseci</h2>
                <br><br>
                <section id="datumi"></section>
                <label class="form-label" for="godine">Godine</label>
                <input class="form-control bold" name="godine" value="<?php echo $godine; ?>" min="0" type="number"><br>
                <label class="form-label" for="mjeseci">Mjeseci</label>
                <input class="form-control bold" value="<?php echo $mjeseci; ?>" min="0" name="mjeseci" type="number"><br><br>
                <button class="btn btn-lg btn-danger mt-3 offset-4" name="calcGodMjes" type="submit">Izračunaj</button>
                <br><br>
                <hr>
                <h3 class="text-center">Rezultat</h3>
                <label class="form-label" for="rezGodineMjes">Godine/Mjeseci</label>
                <input class="form-control bold" name="rezGodineMjes" type="text" value="<?php echo "$gd godina i $mj mjesec(i)"; ?>">
                <label class="form-label" for="rezMjes">Mjeseci</label>
                <input class="form-control bold" name="rezMjes" type="text" value="<?php echo $totalMjes . " mjeseci"; ?>">
                <br><br>
            </div>

            <div class="col-6">
                <div class="container">
                    <br><br>
                    <div class="row">
                        <h2 class="text-center">Razlike datuma</h2>
                    </div>
                </div>

                <div class="container">
                    <?php if ($errors['razlika']) : ?>
                        <div style="height:2.2em;" class="alert alert-sm alert-danger text-center fw-bold alert-dismissible fade show" role="alert">
                            <p style="margin-top:-10px"><?php echo $errors['razlika'] ?></p>
                            <button style="margin-top:-10px" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif ?>
                    <br><br><br>
                    <div class="row">
                        <div class="col-6">
                            <input type="datetime-local" id="pocetak" name="pocetak" class="form-control"><br>
                        </div>

                        <div class="col-6">
                            <input type="datetime-local" id="kraj" name="kraj" class="form-control mt-0"><br>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row offset-2">
                        <div class="col-4">
                            <label for="rdg" class="form-label"><strong>Godina</strong></label>
                            <input style="width:4rem;height:4rem;font-size:2rem;font-weight:bold" type="text" name="rdg" class="form-control" value="<?php echo $god; ?>">
                        </div>

                        <div class="col-4">
                            <label for="rdm" class="form-label"><strong>Mjeseci</strong></label>
                            <input style="width:4rem;height:4rem;font-size:2rem;font-weight:bold" type="text" name="rdm" class="form-control" value="<?php echo $mjes; ?>">
                        </div>

                        <div class="col-4">
                            <label for="rdd" class="form-label offset-1"><strong>Dana</strong></label>
                            <input style="width:4rem;height:4rem;font-size:2rem;font-weight:bold" type="text" name="rdd" class="form-control" value="<?php echo $dana; ?>">
                        </div>
                    </div>
                </div>
                <br><br>
                <button class="btn btn-lg btn-danger offset-5" name="diffDate">Izračunaj</button><br><br>
                <hr>

                <!-- Convert days to years and months -->
                <div class="container">
                    <div class="row">
                        <div class="col-9 offset-2">
                            <label class="mt-4" for="inpDays">Dani</label>
                            <input type="text" name="inpDays" class="form-control w-100" value="<?php echo $inpDays; ?>">
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row offset-2">
                        <div class="col-4">
                            <label for="resYears" class="form-label"><strong>Godina</strong></label>
                            <input style="width:4rem;height:4rem;font-size:1.3rem;font-weight:bold" type="text" name="resYears" class="form-control text-center" value="<?php echo $years; ?>">
                        </div>

                        <div class="col-4">
                            <label for="resMonths" class="form-label"><strong>Mjeseci</strong></label>
                            <input style="width:4rem;height:4rem;font-size:1.3rem;font-weight:bold" type="text" name="resMonths" class="form-control text-center" value="<?php echo $months; ?>">
                        </div>

                        <div class="col-4">
                            <label for="resDays" class="form-label offset-1"><strong>Dana</strong></label>
                            <input style="width:4rem;height:4rem;font-size:1.3rem;font-weight:bold" type="text" name="resDays" class="form-control text-center" value="<?php echo $days; ?>"><br>
                        </div>
                    </div>
                    <button name="convertDays" class="btn btn-lg w-50 btn-success offset-4 container-sm">Pretvori dane</button>
                </div>
                <br>
            </div>
        </div>
    </div>
</form>