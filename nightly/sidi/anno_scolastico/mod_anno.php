<?php session_start();

/*
Copyright (C) 2016 Antonio Faccioli - antonio.faccioli@soluzioniopen.com
Questo programma è un software libero; potete redistribuirlo e/o modificarlo secondo i termini della 
GNU Affero General Public License come pubblicata 
dalla Free Software Foundation; sia la versione 3, 
sia (a vostra scelta) ogni versione successiva.

Questo programma è distribuito nella speranza che sia utile 
ma SENZA ALCUNA GARANZIA; senza anche l'implicita garanzia di 
POTER ESSERE VENDUTO o di IDONEITA' A UN PROPOSITO PARTICOLARE. 
Vedere la GNU Affero General Public License per ulteriori dettagli.

Dovreste aver ricevuto una copia della GNU Affero General Public License
in questo programma; se non l'avete ricevuta, vedete http://www.gnu.org/licenses/
*/

// Modifica dell'anno scolastico per sistema SIDI

require_once '../php-ini'.$_SESSION['suffisso'].'.php';
require_once '../lib/funzioni.php';
$con=mysqli_connect($db_server,$db_user,$db_password,$db_nome) or die ("Errore durante la connessione: ".mysqli_error($con));
    
 
//require_once '../lib/ db/query.php';

//$lQuery = LQuery::getIstanza();

// istruzioni per tornare alla pagina di login 
////session_start();
$tipoutente = $_SESSION["tipoutente"]; //prende la variabile presente nella sessione

if ($tipoutente == "")
{
    header("location: ../login/login.php?suffisso=".$_SESSION['suffisso']); 
    die;
}	
	
$titolo = "Modifica anno scolastico";
$script = ""; 
stampa_head($titolo,"",$script,"SDMAP");
stampa_testata("<a href='../login/ele_ges.php'>PAGINA PRINCIPALE</a> - <a href='vis_anno.php'>Visualizza anno scolastico</a> - $titolo", "", "$nome_scuola", "$comune_scuola");
 
print("<br/><br/>"); 

//Esecuzione query
$anno = stringa_html('anno_scolastico');
$rs = mysqli_query($con,inspref("select * from tbl_anno_scolastico_sidi where anno_scolastico=$anno"));

if ($rs) {
    $row=mysqli_fetch_array($rs);
    print "<form action='agg_anno.php' method='POST'>";
    print "<input type='hidden' name='anno_scolastico' value='".$row['anno_scolastico']."'>";
    print "<CENTER><table border='0'>";
    print "<tr><td ALIGN='CENTER'> Anno scolastico </td> <td ALIGN='CENTER'>".$row['anno_scolastico']."'></td>";
    print "<td ALIGN='CENTER'> Inizio </td> <td ALIGN='CENTER'> ";
    print "<input type='text' name='inizio' value='".$row['inizio']."'></td>";
    print "<td ALIGN='CENTER'> Fine </td> <td ALIGN='CENTER'> ";
    print "<input type='text' name='fine' value='".$row['fine']."'></td>";
    print "<td ALIGN='CENTER'> Ordine scuola </td> <td ALIGN='CENTER'> ";
    print "<select name='ordine_scuola' size=4>";
    if ($row['ordine_scuola']=='AA') {print "<option value='AA' selected >AA";} else {"<option value='AA'>AA";}
    if ($row['ordine_scuola']=='EE') {print "<option value='EE' selected >EE";} else {"<option value='EE'>EE";}
    if ($row['ordine_scuola']=='MM') {print "<option value='MM' selected >MM";} else {"<option value='MM'>MM";}
    if ($row['ordine_scuola']=='SS') {print "<option value='SS' selected >SS";} else {"<option value='SS'>SS";}
    print "</select>";
    print "</td></tr>";

    print "<tr>";
    print "<td COLSPAN='2' ALIGN='CENTER'><br/><input type='submit' value='Aggiorna'></td>";
    print "</tr>";

    print "</table></CENTER>";
    print "</form>";
} else {
    print("\n<h1> Query fallita </h1>");
}
mysqli_close($con);
stampa_piede("");

