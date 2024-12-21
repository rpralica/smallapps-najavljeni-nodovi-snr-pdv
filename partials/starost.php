<?php
// Inicijalizacija varijabli s početnim vrijednostima
$broj1 = $broj2 = $broj3 = $broj4 = $broj5 = 0;
$postR1 = $postR2 = $postR3 = $postR4 = $postR5 = 0;
$zbir = 0; // Dodana inicijalizacija za varijablu $zbir
$error = ['emptyfields' => '']; // Inicijalizacija niza za greške

if (isset($_POST['brojRadnika'])) { // Provjera da li je forma poslana
    // Sanitizacija unosa
    $broj1 = filter_var($_POST['broj1'], FILTER_SANITIZE_NUMBER_INT);
    $broj2 = filter_var($_POST['broj2'], FILTER_SANITIZE_NUMBER_INT);
    $broj3 = filter_var($_POST['broj3'], FILTER_SANITIZE_NUMBER_INT);
    $broj4 = filter_var($_POST['broj4'], FILTER_SANITIZE_NUMBER_INT);
    $broj5 = filter_var($_POST['broj5'], FILTER_SANITIZE_NUMBER_INT);
    $rezZbir = filter_var($_POST['rezZbir'], FILTER_SANITIZE_NUMBER_INT);

    // Sanitizacija unosa postotaka
    $post1 = filter_var($_POST['post1'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $post2 = filter_var($_POST['post2'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $post3 = filter_var($_POST['post3'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $post4 = filter_var($_POST['post4'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $post5 = filter_var($_POST['post5'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Provjera da li su sva polja popunjena
    if (empty($_POST['broj1']) || empty($_POST['broj2']) || empty($_POST['broj3']) || empty($_POST['broj4']) || empty($_POST['broj5'])) {
        $error['emptyfields'] = 'Popunite sva polja';
    } else {
        // Izračunavanje zbroja i postotaka
        $zbir = $broj1 + $broj2 + $broj3 + $broj4 + $broj5;

        $postR1 = ($broj1 * 100) / $zbir;               // Round na 2 decimale Prvi način
        $postR1 = round($postR1, 2);
        $postR2 = round((($broj2 * 100) / $zbir), 2);   // Round na 2 decimale Drugi način
        $postR3 = round((($broj3 * 100) / $zbir), 2);
        $postR4 = round((($broj4 * 100) / $zbir), 2);
        $postR5 = round((($broj5 * 100) / $zbir), 2);
    }
}

// Funkcija za izračunavanje totalnog postotka
function total() {
    global $postR1, $postR2, $postR3, $postR4, $postR5;
    return $postR1 + $postR2 + $postR3 + $postR4 + $postR5;
}
?>
<div class="container ">
    <section id="starost"></section>
    <br>
    <h1 class="text-center bg-primary text-white display-6 fw-bold rounded p-3">Računanje starosti zaposlenih</h1>
</div>
<br><br>
<?php if (!empty($error['emptyfields'])) : ?>
    <div class="alert bg-danger text-white container-sm text-center fw-bold w-75 alert-dismissible fade show" role="alert">
        <h3><strong><?php echo $error['emptyfields'] ?></strong></h3>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>
<form name="starost" id="starost" action="<?php echo 'index.php#starost'; ?>" method="post">
    <div class="container">
        <div class="row">
            <div class="col-4 bg-info border border border-light border-3">
                <br><br>
                <h3 class="text-center">Starost</h3>
                <br><br>
                <input disabled class="form-control" type="text" value="<30"><br>
                <input disabled class="form-control" type="text" value="31-40"><br>
                <input disabled class="form-control" type="text" value="41-50"><br>
                <input disabled class="form-control" type="text" value="51-60"><br>
                <input disabled class="form-control" type="text" value=">61"><br>
                <input class="form-control" type="text" value="Ukupno"><br>
            </div>
            <div class="col-4 bg-warning ">
                <br><br>
                <h3 class="text-center">Broj</h3>
                <br><br>
                <input class="form-control" type="number" min="1" name="broj1" value="<?php echo htmlspecialchars($broj1); ?>"><br>
                <input class="form-control" type="number" min="1" name="broj2" value="<?php echo htmlspecialchars($broj2); ?>"><br>
                <input class="form-control" type="number" min="1" name="broj3" value="<?php echo htmlspecialchars($broj3); ?>"><br>
                <input class="form-control" type="number" min="1" name="broj4" value="<?php echo htmlspecialchars($broj4); ?>"><br>
                <input class="form-control" type="number" min="1" name="broj5" value="<?php echo htmlspecialchars($broj5); ?>"><br>
                <input class="form-control" type="text" name="rezZbir" value="<?php echo htmlspecialchars($zbir); ?>"><br>
                <br><br>
            </div>
            <div class="col-4 bg-danger">
                <br><br>
                <h3 class="text-center">Postotak</h3>
                <br><br>
                <input class="form-control" type="text" disabled name="post1" value="<?php echo htmlspecialchars($postR1); ?>"><br>
                <input class="form-control" type="text" disabled name="post2" value="<?php echo htmlspecialchars($postR2); ?>"><br>
                <input class="form-control" type="text" disabled name="post3" value="<?php echo htmlspecialchars($postR3); ?>"><br>
                <input class="form-control" type="text" disabled name="post4" value="<?php echo htmlspecialchars($postR4); ?>"><br>
                <input class="form-control" type="text" disabled name="post5" value="<?php echo htmlspecialchars($postR5); ?>"><br>
                <input class="form-control" type="text" disabled name="post6" value="<?php echo htmlspecialchars(total()); ?>"><br>
            </div>
        </div>
    </div>
    <br>
    <button name="brojRadnika" type="submit" class=" btn btn-success offset-5"><strong>Izračunaj broj radnika</strong></button>
</form>
