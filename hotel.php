<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

// test
// var_dump($hotels[0]['name']);

$filter_parking = ($_GET['check_parking'] === 'true');
$filter_vote_3 = ($_GET['check_vote_3'] === 'true');
// var_dump($filter_parking);
// var_dump($filter_vote_3);

// stabilisco che l'array di riferimento è uguale a quello di partenza, affinchè ogni volta che applico un filtro e ricarico la pagina si ripristina
$filter_hotels = $hotels;
// condizione di filtro per Parcheggio disponibile (true)
if ($filter_parking) {
    $filter_hotels = array_filter($filter_hotels, function ($hotel) {
        return $hotel['parking'] === true;
    });
}
// condizione di filtro se voto >= 3
if ($filter_vote_3) {
    $filter_hotels = array_filter($filter_hotels, function ($hotel) {
        return $hotel['vote'] >= 3;
    });
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>PHP Hotel Table</title>

</head>

<body>
    <div class="container text-center">
        <!-- se all'applicazione dei filtri non visualizzo alcun risultato perchè l'array è vuoto allora mostro una stringa -->
        <?php if (empty($hotels)) {
            echo 'Non ci sono hotel disponibili con questi filtri.';
        } else { ?>
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">HOTELS</th>
                        <?php foreach ($filter_hotels as $hotel) { ?>
                            <th scope="col">
                                <?php echo $hotel['name']; ?>
                            </th>
                        <?php } ?>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($filter_hotels[0] as $key => $value) { ?>
                        <?php if ($key !== 'name') { ?>
                            <tr>
                                <th scope="row">
                                    <?php
                                    $key_uc = ucfirst($key);
                                    echo str_replace('_', ' ', $key_uc);
                                    ?>
                                </th>
                                <?php foreach ($filter_hotels as $hotel) { ?>
                                    <td>
                                        <?php
                                        $value = $hotel[$key];
                                        if (is_bool($value)) {
                                            echo $value ? 'Disponibile' : 'Non disponibile';
                                        } else {
                                            echo $value;
                                        }
                                        ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
            <div class="container">
                <div class="input-group mb-3 d-flex justify-content-center">
                    <form class="input-group-text" action="hotel.php" method="GET">
                        <h4 class="px-3">Filtra i risultati:</h4><br>
                        <label for="check_parking" class="px-3">Parcheggio Disponibile</label>
                        <input name="check_parking" id="check_parking" class="form-check-input mt-0" type="checkbox" value="true">
                        <label for="check_vote_3" class="px-3">Voto 3+</label>
                        <input name="check_vote_3" id="check_vote_3" class="form-check-input mt-0" type="checkbox" value="true">
                        <button type="submit" class="btn btn-dark mx-3">Applica Filtri</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>