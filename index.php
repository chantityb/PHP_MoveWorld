
<?php

require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$api_key = $_ENV['OMDB_API_KEY'];

// API Call to OMDB API

        // create a new cURL resource
        $curl = curl_init();

        // set URL
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.omdbapi.com/?apikey=' . $api_key . '&s=title',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        // grab URL and pass it to the browser
        $response = curl_exec($curl);

        // check for any errors
        $http_status = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

        // close cURL resource 
        curl_close($curl);

        // condition to check if API call was successful or not
        if ($http_status == 200) {
            echo "<h4 class='alert alert-success text-center'>API Call Successful</h4>";
        } else {
            echo "<h4 class='alert alert-danger text-center'>API Call Failed with status code: " . $http_status . "</h4>";
        }
        
        //echo $response;
        $result = json_decode($response, true);
        
        //var_dump($result);

       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Movie World (API Call)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body class="container">
  <div>  
    <h1 class="text-center" style="font-weight: bold;">Movie World in PHP</h1>
    <br>
  </div>

  

<!-- API Data displayed in cards -->

<div class="container d-flex flex-wrap align-items-center">    
    <div class="row mt-5 mx-auto">
        <?php foreach($result['Search'] as $value): ?>
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="card">
                    <img height="200px" width="160px" class="card-img-top" src="<?php echo $value['Poster']; ?>">
                    <div class="card-body" >
                        <h5 class="d-inline"><b><?php echo $value['Title']; ?></b> </h5>
                        <p><?php echo $value['Year']; ?></p>     
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
