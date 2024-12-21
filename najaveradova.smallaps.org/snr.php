<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>SNR </title>

    <link rel="icon" href="supernova.jpg" type="image/x-icon">
</head>

<body>
    <?php include './partials/navbar.php'; ?>
    <form method="POST">
        <div class="container">
            <label id="input" class="h3" for="input">Unesite podatke:</label><br><br>
            <textarea class="form-control " name="input" id="input" rows="10" cols="100"><?php echo isset($_POST['input']) ? htmlspecialchars($_POST['input']) : ''; ?></textarea><br><br>
        </div>
        <button id="btnInput" class="btn btn-info  btn-lg offset-4 text-white " type="submit">Procesiraj</button>
        <br><br>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input = $_POST['input'];

        $aliases = [
            "bl" => 'Banja Luka',
            "bn" => 'Bijeljina',
            "brod" => 'Brod',
            "br" => 'Brčko',
            "bt" => 'Bratunac',
            "cajnice" => 'Čajniče',
            "cz" => 'Cazin',
            "de" => 'Cazin',
            "dubica" => 'Kozarska Dubica',
            "foca" => 'Foča',
            "grd" => 'Gradiška',
            "is" => 'Istočno Sarajevo',
            "kv" => 'Kotor Varoš',
            "lkt" => 'Laktaši',
            "mg" => 'Mrkonjić Grad',
            "mod" => 'Modriča',
            "ng" => 'Novi Grad',
            "pale" => 'Pale',
            "pd" => 'Prijedor',
            "rog" => 'Rogatica',
            "sekovici" => 'Šekovići',
            "sok" => 'Sokolac',
            "srb" => 'Srbac',
            "trb" => 'Trebinje',
            "tslc" => 'Teslić',
            "uglj" => 'Ugljevik',
            "vla" => 'Vlasenica',
            "vsgd" => 'Višegrad',
            "zv" => 'Zvornik',
            "do" => 'Doboj',
            "der" => 'Derventa',
            "nev" => 'Nevesinje',
            "Zvornik" => 'Zvornik',
            "ga" => 'Gacko'
        ];

        $lines = explode("\n", $input);
        $data = [];
        $output = "<p>Kolege,</p><p>u nastavku spisak čvorišta sa lošim SNR parametrima. Na ovim područijima moguća degradacija servisa ka korisniku:</p>";

        foreach ($lines as $line) {
            if (preg_match('/^(.*?) - (.*?) · (.*?)\t([\d.]+)/', $line, $matches)) {
                [$full, $cmts, $cable, $node, $snr] = $matches;

                // Uklanjanje === sa obe strane nodova
                $node = trim(str_replace("===", "", $node));

                $aliasKey = explode("-", $cmts)[0];
                $location = $aliases[$aliasKey] ?? ucfirst($aliasKey);

                // Store the data in an array
                $data[$cmts][$node] = isset($data[$cmts][$node]) && $data[$cmts][$node]['snr'] < $snr
                    ? $data[$cmts][$node]
                    : ['cable' => $cable, 'node' => $node, 'snr' => $snr, 'location' => $location];
            }
        }

        ksort($data); // Sort CMTS by alphabetical order

        foreach ($data as $cmts => $nodes) {
            $location = reset($nodes)['location'];
            $output .= "<div><strong>• {$location} CMTS: {$cmts}</strong></div>"; // CMTS with location

            foreach ($nodes as $info) {
                $output .= "<div style='margin-left: 30px;'>· {$info['cable']} {$info['node']} SNR: {$info['snr']}</div>"; // Indented cables
            }

            // Add a line break between different CMTS
            $output .= "<br>"; // This adds space between the CMTS sections
        }

        echo "<div class='container-fluid'>";
        echo "<div class='row'>";
        echo "<div class='col-12 output'>{$output}</div>";
        echo "</div>";
        echo "</div>";

        exit;
    }
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>