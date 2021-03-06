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

// Visualizza l'elenco dei flussi SIDI.

require_once '../php-ini'.$_SESSION['suffisso'].'.php';
require_once '../lib/funzioni.php';
// require_once '../lib/ db / query.php';
$con=mysqli_connect($db_server,$db_user,$db_password,$db_nome) or die ("Errore durante la connessione: ".mysqli_error($con));
    
 
// $lQuery = LQuery::getIstanza();

// istruzioni per tornare alla pagina di login 
////session_start();
$tipoutente = $_SESSION["tipoutente"]; //prende la variabile presente nella sessione

if ($tipoutente == "")
{
    header("location: ../login/login.php?suffisso=".$_SESSION['suffisso']); 
    die;
}	
	
$titolo = "SIDI";
$script = ""; 
stampa_head($titolo,"",$script,"SDMAP");
stampa_testata("<a href='../login/ele_ges.php'>PAGINA PRINCIPALE</a> - $titolo", "", "$nome_scuola", "$comune_scuola");

$rs = mysqli_query($con,inspref("select * from tbl_flussi_sidi order by id_flussi_sidi"));

print "<h3 align='center'>Flussi SIDI</h1>";

if ($rs) {
    print "<CENTER><TABLE BORDER='1'>";	
    print "<TR class='prima' border=1><TD ALIGN='CENTER'><B>Descrizione flusso</B></TD><TD ALIGN='CENTER'><B>Codice Versione</B></TD></TR>";
    
    //foreach ($rs as $row) {
    while ($row=mysqli_fetch_array($rs)){
        print "<TR class='oddeven'>";
        print "<TD><A HREF='#'". $row['descrizione_flusso']."</TD>";
        print "<TD>".$row['codice_versione_flusso'];
        print "</TD>";
        print "</TR>";	
    }
    print "</TABLE></CENTER>";
} else {
    print "Query fallita";
}

print "<h3 align='center'>Tabelle SIDI</h1>";
print "<ul>";
print "<li><a href='anno_scolastico/vis_anno.php'>Anno scolastico</a></li>";
print "<li><a href='#'>Corsi e indirizzi</a></li>";
print "<li><a href='#'>Decodifica anno scolastico</a></li>";
print "<li><a href='#'>Decodifica voto</a></li>";
print "<li><a href='#'>Frazioni temporali</a></li>";
print "<li><a href='#'>Scuola</a></li>";
print "<li><a href='#'>Sede</a></li>";
print "<li><a href='#'>Tipi esiti</a></li>";
print "<li><a href='#'>Trascodifica comune</a></li>";
print "<li><a href='#'>Trascodifica stato</a></li>";
print "</ul>";
  
mysqli_close($con);
stampa_piede("");

