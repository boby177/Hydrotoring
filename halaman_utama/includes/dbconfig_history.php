<?php
    require __DIR__.'/vendor/autoload.php';

    use Kreait\Firebase\Factory;
    use Kreait\Firebase\ServiceAccount;

    $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/hydrotoring-firebase-adminsdk-7s66q-c844da80c9.json');
    $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://hydrotoring.firebaseio.com')
        ->create();

    $database = $firebase->getDatabase();
?>