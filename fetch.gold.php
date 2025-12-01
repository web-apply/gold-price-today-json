<?php
$url = "https://GoldPrice.Today/json.php?data=live";
$json = file_get_contents($url);
$data = json_decode($json, true);

if (!$data) {
    die("Failed to fetch or decode JSON\\n");
}

// Example: get gold price in TRY
if (isset($data["TRY"])) {
    $tryPrice = $data["TRY"]["gold_price"];
    echo "Gold price in TRY: $tryPrice\n";
}

// Save snapshot
file_put_contents('prices.json', json_encode($data, JSON_PRETTY_PRINT));

// Optional: save historic snapshot
$ts = date('Y-m-d_H-i');
file_put_contents("history/{$ts}.json", json_encode($data));
?>
