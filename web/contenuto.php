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


echo '<head><link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script></head>';

?>
<style>
    html, body {
  font-family: 'Roboto', 'Helvetica', sans-serif;
}        
</style>

<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
          <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
              <!-- Title -->
              <span class="mdl-layout-title" id='titolo'>Pannello di controllo</span>
              <!-- Add spacer, to align navigation to the right -->
              <div class="mdl-layout-spacer"></div>
              <!-- Navigation. We hide it in small screens. -->
              <nav class="mdl-navigation mdl-layout--large-screen-only">
                <!--      
                <div class="mdl-navigation__link" onclick="passa_a(1);" style="cursor:pointer" id="home_btn"><i class="material-icons">home</i></div>
                        <div class="mdl-tooltip mdl-tooltip--bottom" data-mdl-for="home_btn">
                                        Home
                                </div>
                <div class="mdl-navigation__link" onclick="passa_a(-2);"  style="cursor:pointer"><i class="material-icons" id="logout_btn">exit_to_app</i></div>
                        <div class="mdl-tooltip mdl-tooltip--bottom" data-mdl-for="logout_btn">
                                        Logout
                                </div>
                        
                <!--<a class="mdl-navigation__link" href="">Link</a>
                <a class="mdl-navigation__link" href="">Link</a>
                <a class="mdl-navigation__link" href="">Link</a>-->
              </nav>
            </div>
        </header>
        <main class="mdl-layout__content">
        <div class="page-content" >



<?



echo "<table class='mdl-data-table mdl-js-data-table mdl-shadow--2dp' style='margin:auto;'>";
echo "<thead>";
echo "<tr><th class='mdl-data-table__cell--non-numeric'>Nome</th><th>Latitudine</th><th>Longitudine</th></tr>";
echo "</thead>";
foreach($resArray['response']['venues'] as $key => $value)
{    
   echo "<tr>";
        echo "<td class='mdl-data-table__cell--non-numeric'>".$value['name']."</td>";
        echo "<td>".$value['location']['lat']."</td>";
        echo "<td>".$value['location']['lng']."</td>";
        
   echo "</tr>";
   //echo $value['name'].", latitudine: ".$value['location']['lat'].", longitudine: ".$value['location']['lng']."<br>";
    
}
echo "</table>";
echo "</div></body>";
?>
