<?php
define('BASE', 'upload/');
 
function renommerFichier($repertoire, $nomFichier) {
	/*$nouvNom = preg_replace('[éèë]', 'e', $nomFichier);
	$nouvNom = preg_replace('[àä]', 'a', $nouvNom);
	$nouvNom = preg_replace('[ùü]', 'u', $nouvNom);*/

    /*
	if (preg_match('/*.{5,}/', $nomFichier)) {$nouvNom = str_replace('.....', '.', $nomFichier); echo "cinq points (".$nouvNom.")</br>";}
	elseif (preg_match('/*.{4,}/', $nomFichier))  {$nouvNom = str_replace('....', '.', $nomFichier); echo "quatre points(".$nouvNom.")</br>";}
	elseif (preg_match('/*.{3,}/', $nomFichier))   {$nouvNom = str_replace('...', '.', $nomFichier); echo "trois points(".$nouvNom.")</br>";}
	elseif (preg_match('/*.{2,}/', $nomFichier))    {$nouvNom = str_replace('..', '.', $nomFichier); echo "deux points(".$nouvNom.")</br>";}
    */

    $nouvNom = str_replace('…', '', $nomFichier);
    //$nouvNom = str_replace('....', '.', $nomFichier);

    
    echo "ancien nom de fichier (".$nomFichier.") nouveau nom de fichier (".$nouvNom.")</br>";

	rename($repertoire . $nomFichier, $repertoire . $nouvNom);
}
 
function parcourirArborescence($repertoire) {
   /* if (!preg_match('/$', $repertoire)) {
        $repertoire .= '/';
    }*/
    if (@ $dh = opendir($repertoire)) {
        
        echo "je suis dans le repertoire : (".$repertoire.")</br>";

        while (($fichier = readdir($dh)) != FALSE) {
            
        echo "je suis dans le fichier : (".$fichier.")</br>";
            if ($fichier == '.') {           
                echo "je suis a skip .(".$fichier.")</br>";
                continue; // Skip it     
            }
            if ($fichier == '..') {         
                echo "je suis a skip ..(".$fichier.")</br>";
                continue; // Skip it
            }
            /*
            if (is_dir($repertoire . $fichier)) {                     
                echo "je suis a recursivité"."</br>";
                parcourirArborescence($repertoire . $fichier); // Récursivité      
            } elseif (preg_match('[éèëàäùü..]', $fichier)) {
                echo "nom de fichier renomé avec succes(".$fichier.")</br>";
				renommerFichier($repertoire, $fichier);
            }
            */
            if (preg_match('[..]', $fichier)) {
                echo "le fichier contient .. car (".$fichier.")</br>";
				renommerFichier($repertoire, $fichier);
            }
            else{
                echo "nom de fichier normale (".$fichier.")</br>";
            }
        }
        @ closedir($dh);
    }
} 
/*
function renommerFichier($repertoire, $nomFichier) {
	$nouvNom = ereg_replace('[éèë]', 'e', $nomFichier);
	$nouvNom = ereg_replace('[àä]', 'a', $nouvNom);
	$nouvNom = ereg_replace('[ùü]', 'u', $nouvNom);
	rename($repertoire . $nomFichier, $repertoire . $nouvNom);
}

function parcourirArborescence($repertoire) {
    if (!ereg('/$', $repertoire)) {
        $repertoire .= '/';
    }
    if (@ $dh = opendir($repertoire)) {
        while (($fichier = readdir($dh)) != FALSE) {
            if ($fichier == '.') {
                continue; // Skip it
            }
            if ($fichier == '..') {
                continue; // Skip it
            }
            if (is_dir($repertoire . $fichier)) {
                parcourirArborescence($repertoire . $fichier); // Récursivité
            } elseif (ereg('[éèëàäùü]', $fichier)) {
				renommerFichier($repertoire, $fichier);
            }
        }
        @ closedir($dh);
    }
}
*/
 
parcourirArborescence(BASE);
?>