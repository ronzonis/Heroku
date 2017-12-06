<?
$url = "https://api.foursquare.com/v2/venues/search?v=20161016&near=bergamo&query=pizzeria&intent=checkin&client_id=2BQU5RNR31YWW5UXL0UQ3BGDT04ZRZOOLH5Z454K5NJOMFNX&client_secret=2YKLYMCCYNYTIW4JLD3TJYE2LDB2YHRBKXDQR45GK5PYOCCB&limit=50";


$options = array(
        CURLOPT_RETURNTRANSFER => true,   // return web page
        CURLOPT_HEADER         => false,  // don't return headers
        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
        CURLOPT_ENCODING       => "",     // handle compressed
        CURLOPT_USERAGENT      => "test", // name of client
        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
        CURLOPT_TIMEOUT        => 120,    // time-out on response
    ); 

$ch = curl_init($url);
curl_setopt_array($ch, $options);

$content  = curl_exec($ch);

curl_close($ch);

$resArray = array();
$resArray = json_decode($content,true);

//print_r($resArray['response']['venues']);

echo "<table>";
echo "<thead>";
echo "<tr><td>Nome</td><td>Latitudine</td><td>Longitudine</td></tr>";
echo "</thead>";
foreach($resArray['response']['venues'] as $key => $value)
{    
   echo "<tr>";
        echo "<td>$value['name']</td>";
        echo "<td>$value['location']['lat']</td>";
        echo "<td>$value['location']['lng']</td>";
        
   echo "</tr>";
   //echo $value['name'].", latitudine: ".$value['location']['lat'].", longitudine: ".$value['location']['lng']."<br>";
    
}
echo "</table>";

?>
