<?php
$file = fopen(__DIR__ . '/donnees.csv', 'r');
// Créer un tableau pour stocker les données
$data = [];

while (($row = fgetcsv($file, 100)) != FALSE) {
    $data[] = [
        'valeurs' => $row
    ];
}
fclose($file);
$resultat = 0;
$nombreValeurs = count($data);
$minValue = $data[0]['valeurs'][0] - $data[$nombreValeurs - 1]['valeurs'][0];
$max = max($data);
$min = min($data);
$cleMin = array_search($min, $data);
$cleMax = array_search($max, $data);

while(true)
{
    if($cleMax == 0 && ($cleMin == $nombreValeurs - 1))
    {
        for ($i=0; $i < $nombreValeurs; $i++) {   
            if($data[$i] < $data[0]['valeurs'][0])
            {
                continue;
            }
            else
            {
                $resultat = -($data[0]['valeurs'][0] - $data[$nombreValeurs - 1]['valeurs'][0]);
                break;
            }
        }
    }
    elseif($cleMin == 0 && $cleMax == $nombreValeurs - 1)
    {
        $resultat = 0;
        break;
    }

    for($i = 0; $i < $nombreValeurs - 1; $i++)
    {
        if(($data[$i]['valeurs'][0] - $data[$i + 1]['valeurs'][0]) > $minValue)
        {
            $minValue = $data[$i]['valeurs'][0] - $data[$i + 1]['valeurs'][0];
            if ($data[$i + 2]['valeurs'][0] < $data[$i + 1]['valeurs'][0]) {
                $resultat = -($minValue + ($data[$i + 1]['valeurs'][0] - $data[$i + 2]['valeurs'][0]));
            }
            else
            {
                $resultat = -($minValue);
            }
        }
        else {
            $resultat = $resultat;
        }
    }
    break;
}

// Write an answer using echo(). DON'T FORGET THE TRAILING \n
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)

echo("$resultat\n");
?>