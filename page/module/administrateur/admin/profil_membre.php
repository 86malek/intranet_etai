<?php session_start();


if (empty($page)) {
    $page = "function";
    // On limite l'inclusion aux fichiers.php en ajoutant dynamiquement l'extension
    // On supprime également d'éventuels espaces
    $page = trim($page . ".php");
}

// On évite les caractères qui permettent de naviguer dans les répertoires
$page = str_replace("../", "protect", $page);
$page = str_replace(";", "protect", $page);
$page = str_replace("%", "protect", $page);

// On interdit l'inclusion de dossiers protégés par htaccess
if (preg_match("/config/", $page)) {
    echo $page;
} else {
    // On vérifie que la page est bien sur le serveur
    if (file_exists("../../../config/" . $page) && $page != 'index.php') {
        include "../../../config/" . $page;
    } else {
        echo "Page inexistante !";
    }
}
include('menu.php');
switch(Membre::info($_GET['id'], 'niveau')) {
	case 1 : 
	$Niveau = 'Membre';
	break;
			
	case 2 : 
	$Niveau = 'Mod&eacute;rateur';
	break;
			
	case 3 : 
	$Niveau = 'Administrateur';
	break;
	
	case 4 : 
	$Niveau = 'Cr&eacute;ateur';
	break;
			
	case 5 :
	$Niveau = 'Banni';
	break;
}
echo '<div id="principal">
<div id="titre_principal">Profil de '.Membre::info($_GET['id'], 'pseudo').', qui est '. $Niveau.'</div>
<br />
<table width="70%" align="center">
<tr>
<td align="right">
</td>
</tr>
</table>
<table width="70%" align="center">
<tr>
<td width="140px" rowspan="14" valign="top">
<img src="'.URLSITE.'/'.Avatar::membre(Membre::info($_GET['id'], 'id_avatar')).'" width="120" height="120" alt="Avatar" title="Avatar">
</td>
</tr>
<tr>
<td align="right" class="titre_form" width="150px">Date de Naissance : </td>
<td>'.Membre::info($_GET['id'], 'naissance').'</td>
</tr>
<tr>
<td align="right" class="titre_form">Genre : </td>
<td>'; 
if(Membre::info($_GET['id'], 'genre')=='3') { 
	echo 'Femme'; 
} 
else { 
	echo 'Homme'; 
} 
echo '</td>
</tr>
<tr>
<td align="right" class="titre_form">Nom : </td>
<td>'.Membre::info($_GET['id'], 'nom').'</td>
</tr>
<tr>
<td align="right" class="titre_form">Pr&eacute;nom :</td>
<td>'.Membre::info($_GET['id'], 'prenom').'</td>
</tr>
<tr>
<td align="right" class="titre_form">Email : </td>
<td>'.Membre::info($_GET['id'], 'email').'</td>
</tr>
<tr>
<td align="right" class="titre_form">Pseudo Facebook : </td>
<td>'.Membre::info($_GET['id'], 'facebook').'</td>
</tr>
<tr>
<td align="right" class="titre_form">Pseudo Twister : </td>
<td>'.Membre::info($_GET['id'], 'twister').'</td>
</tr>
<tr>
<td align="right" class="titre_form">Site internet : </td>
<td>'.Membre::info($_GET['id'], 'site').'</td>
</tr>
<tr>
<td align="right" class="titre_form">N&deg; de tel : </td>
<td>'.Membre::info($_GET['id'], 'tel').'</td>
</tr>
<tr>
<td align="right" class="titre_form">Adresse : </td>
<td>'.Membre::info($_GET['id'], 'adresse').'</td>
</tr>
<tr>
<td align="right" class="titre_form">Code Postal : </td>
<td>'.Membre::info($_GET['id'], 'cp').'</td>
</tr>
<tr>
<td align="right" class="titre_form">Ville : </td>
<td>'.Membre::info($_GET['id'], 'ville').'</td>
</tr>
<tr>
<td colspan="3"><p>&nbsp;</p></td>
</tr>
<tr>
<td colspan="3" align="center" class="titre_form">Description :</td>
</tr>
<tr>
<td colspan="3">'.str_replace('<br />', "\n",Membre::info($_GET['id'], 'description')).'
</td>
</tr>
</table>
</div>';
include('footer.php');
?>
