<?
if(isset($_POST['stato']) && !empty($_POST['stato']))
{
	$stato = $_POST['stato'];
}else $stato = 0;
if($stato == 0)
{
	$url = "https://api.foursquare.com/v2/venues/search?v=20161016&near=bergamo&query=pizzeria&intent=checkin&client_id=2BQU5RNR31YWW5UXL0UQ3BGDT04ZRZOOLH5Z454K5NJOMFNX&client_secret=2YKLYMCCYNYTIW4JLD3TJYE2LDB2YHRBKXDQR45GK5PYOCCB&limit=50";
	$tipo = "Pizzeria";
	$citta = "Bergamo";
	$numero = 50;
}else
{
	$url = "https://api.foursquare.com/v2/venues/search?v=20161016&near=".urlencode($_POST['citta'])."&query=".urlencode($_POST['tipo'])."&intent=checkin&client_id=2BQU5RNR31YWW5UXL0UQ3BGDT04ZRZOOLH5Z454K5NJOMFNX&client_secret=2YKLYMCCYNYTIW4JLD3TJYE2LDB2YHRBKXDQR45GK5PYOCCB&limit=".urlencode($_POST['numero']);
	$tipo = $_POST['tipo'];
	$citta = $_POST['citta'];
	$numero = $_POST['numero'];
}
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
$content  = curl_exec($ch) or die(curl_error());
curl_close($ch);
$resArray = array();
$resArray = json_decode($content,true);
//print_r($resArray['response']['venues']);
echo '<head><meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script></head>';
?>
<style>
    html, body {
  font-family: 'Roboto', 'Helvetica', sans-serif;
}        
</style>


<script>
function individua_tasto(e)
{
    e = e || window.event;
    if (e.keyCode == 13)
    {
        document.getElementById('aggiorna_btn').click();
        return false;
    }
    return true;
}
</script>

<body onkeypress='individua_tasto(event);'>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
          <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
              <!-- Title -->
              <span class="mdl-layout-title" id='titolo'>Ricerca luoghi</span>
              <!-- Add spacer, to align navigation to the right -->
              <div class="mdl-layout-spacer"></div>
              
            </div>
        </header>
        <main class="mdl-layout__content">
        <div class="page-content" >



                
 <style>
.demo-card-wide.mdl-card {
  margin:auto;
  margin-bottom:20px;
  margin-top:20px;
}
.demo-card-wide > .mdl-card__title {
  color: #757575;
  height: 60px;
  background-color: white/* url('../assets/demos/welcome_card.jpg') center / cover*/;
}
.demo-card-wide > .mdl-card__menu {
  color: #fff;
}
</style>         
                
<script>                
	
function controlla()
{
	var tipo = document.getElementById('titolo').value;
	var citta = document.getElementById('citta').value;
	var numero = parseInt(document.getElementById('numero').value);
	
	if(tipo != "" && citta != "" && numero != "")
	{
		if(numero>0 && numero <= 50)
		{
			document.getElementById('forma').submit();
		}else alert("Immettere un valore compreso tra 1 e 50");
	}else alert("Compilare tutti i campi");
	
	
}
</script>             
		
<div class="mdl-grid">         
<div class="mdl-cell mdl-cell--6-col">
<div class="demo-card-wide mdl-card mdl-shadow--2dp" id="card">
          <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Cosa stai cercando?</h2>
          </div>
          <div class="mdl-card__supporting-text">



                <form name='forma' id='forma' method='post'>
                  <input type='hidden' name='stato' id='stato' value='1'>

                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <? echo '<input class="mdl-textfield__input" type="text" id="tipo" name="tipo" value="'.$tipo.'">'; ?>
                    <label class="mdl-textfield__label" for="utente">Cosa stai cercando?</label>
                    <span class="mdl-textfield__error">Massimo 10 caratteri!</span>
                  </div>

                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <? echo '<input class="mdl-textfield__input" type="text" name="citta" id="citta" value="'.$citta.'">'; ?>
                    <label class="mdl-textfield__label" for="password">Citt&agrave</label>
                  </div>

                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <? echo '<input class="mdl-textfield__input" type="number" name="numero" id="numero" value="'.$numero.'">'; ?>
                    <label class="mdl-textfield__label" for="password">Numero di risultati</label>
                    <span class="mdl-textfield__error">Massimo 50!</span>
                  </div>
                        
                </form>


          </div>
          <div class="mdl-card__actions mdl-card--border">
            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" onclick="controlla();" id="aggiorna_btn">
              Aggiorna
            </a>
          </div>
        <div class="mdl-card__menu">
			<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
				<i class="material-icons">share</i>
			</button>
        </div>

</div>
</div>
<style>
@media only screen and (max-width: 480px) {
  table, thead, tbody, th, td, tr {
      display: block;
  }
  thead {
    display: none;
  }
  // mdl specifics
  .mdl-data-table tbody tr {
    height: auto;
  }
  
  .mdl-data-table tbody tr:nth-child(even) {
    background-color: #eee;
  }
  .mdl-data-table td,
  .mdl-data-table td:first-of-type {
    padding-left: 50%;
  }
  .mdl-data-table td:before {
    position: absolute;
    top: 6px;
    left: 6px;
    width: 45%;
    padding: 6px 18px 0;
    white-space: nowrap;
    content: attr(data-label);
    text-align: left;
    color: rgba(0, 0, 0, 0.541176);
    font-weight: bold;
    font-family: Helvetica, Arial, sans-serif;
    font-size: 12px;
  }
  
  .mdl-data-table td:last-of-type {
    padding-right: 18px;
  }
  
}</style>
    
<?
echo '<div class="mdl-cell mdl-cell--6-col">';
if($resArray['meta']['code'] == 200)
{	
	echo "<table id='tabella' class='mdl-data-table mdl-js-data-table mdl-shadow--2dp' style='margin:auto; margin-bottom:20px; margin-top:20px;'>";
	echo "<thead>";
	echo "<tr><th class='mdl-data-table__cell--non-numeric'>Nome</th><th class='mdl-data-table__cell--non-numeric'>Latitudine</th><th class='mdl-data-table__cell--non-numeric'>Longitudine</th></tr>";
	echo "</thead>";
	echo "<tbody>";
	foreach($resArray['response']['venues'] as $key => $value)
	{    
	   echo "<tr>";
			echo "<td data-label='Nome'  class='mdl-data-table__cell--non-numeric'>".$value['name']."</td>";
			echo "<td data-label='Latitudine' class='mdl-data-table__cell--non-numeric'>".$value['location']['lat']."</td>";
			echo "<td data-label='Longitudine' class='mdl-data-table__cell--non-numeric'>".$value['location']['lng']."</td>";
	   echo "</tr>";
	   //echo $value['name'].", latitudine: ".$value['location']['lat'].", longitudine: ".$value['location']['lng']."<br>";
	}
	echo "</tbody>";
	echo "</table>";
}else{
	echo '<div class="mdl-card mdl-shadow--2dp" style="margin:auto; margin-top:20px;">';
		echo '<div class="mdl-card__title mdl-card--expand">';
    			echo '<h2 class="mdl-card__title-text">Attenzione!</h2></div>';
		echo '<div class="mdl-card__supporting-text">Si &egrave verificato un errore...<br>Controlla che i parametri inseriti siano corretti</div>';
	echo '</div>';
}
echo "</div></div></div></body>";
?>
