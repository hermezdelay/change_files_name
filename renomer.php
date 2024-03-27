<?php
define('BASE', 'upload/');
 
function renommerFichier($repertoire, $nomFichier) {


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

 
parcourirArborescence(BASE);
?>