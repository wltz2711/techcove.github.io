<?php
echo "<table border='1'><tr><th>Course Name</th><th>Course Date</th><th>Paid</th><th>Unpaid</th></tr>";


$courses = array('2017-12-02'=>'Beginner Coding Bootcamp', 
  '2017-12-09'=>'Web Design and Creation', 
  '2017-12-11'=>'Facebook Effective Advertising', 
  '2017-12-18'=>'Beginner Coding Bootcamp',
  '2017-12-30'=>'Facebook Effective Advertising',
  '2018-01-06'=>'Beginner Coding Bootcamp',
  '2018-01-12'=>'Facebook Effective Advertising',
  '2018-01-13'=>'Web Design and Creation',
  '2018-01-18'=>'Facebook Effective Advertising');
  

foreach($courses as $courseDate => $courseName) {
  $url = 'https://techcove.api-us1.com';


  $params = array(


    'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

    'api_action' => 'contact_list',

    'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
    'filters[tagname]' => 'paid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
    'filters[fields][%COURSE_DATE%]' => $courseDate,

    'full' => 0,


    );

  $month = substr($courseDate,5,2);
  echo "$month";
// This section takes the input fields and converts them to the proper format
  $query = "";
  foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
  $query = rtrim($query, '& ');

// clean up the url
  $url = rtrim($url, '/ ');


// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
  if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
  if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
  }

// define a final API request - GET
  $api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
  die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);

echo "<tr><td>$courseName</td><td>$courseDate</td><td>";

echo(count($result) - 3 );
echo "</td>";


$params = array(


  'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

  'api_action' => 'contact_list',

  'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
  'filters[tagname]' => 'unpaid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
  'filters[fields][%COURSE_DATE%]' => $courseDate,
  
  'full' => 0,


  );

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
  die('JSON not supported. (introduced in PHP 5.2.0)');
}
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); 
curl_setopt($request, CURLOPT_HEADER, 0); 
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); 
curl_close($request); 

if ( !$response ) {
  die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

$result = unserialize($response);


echo "<td>";
echo(count($result) - 3);
echo "</td></tr>";



}
echo "</table>"
?>








