<?php
$ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'secret'=> '6Lf9JTkoAAAAAFnADJQP2Xcd_93lvOZhPjd4wa6z',
    'response' => $_POST['g-recaptche-response'],
]);
curl_setopt($sh, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$result = json_decode($response);
if ($result->$success) {
    echo 'validasi berhasil'
}
echo'apakah km robot?'