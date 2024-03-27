<?php
define('BASE', 'upload/');
 
function renommerFichier($repertoire, $nomFichier) {

    $nouvNom="";
    if ( preg_match('[…]', $nomFichier) == 1 ) $nouvNom = str_replace('…', '', $nomFichier);
    else if(preg_match('([.]{6})', $nomFichier) == 1 ) $nouvNom = str_replace('......', '.', $nomFichier);
    else if(preg_match('([.]{5})', $nomFichier) == 1 ) $nouvNom = str_replace('.....', '.', $nomFichier);
    else if(preg_match('([.]{4})', $nomFichier) == 1 ) $nouvNom = str_replace('....', '.', $nomFichier);
    else if(preg_match('([.]{3})', $nomFichier) == 1 ) $nouvNom = str_replace('...', '.', $nomFichier);
    else if(preg_match('([.]{2})', $nomFichier) == 1 ) $nouvNom = str_replace('..', '.', $nomFichier);

    
    echo " ancien nom de fichier (".$nomFichier.") nouveau nom de fichier (".$nouvNom.")</br></br>";

	rename($repertoire . $nomFichier, $repertoire . $nouvNom);
}
 
function parcourirArborescence($repertoire) {
   /* if (!preg_match('/$', $repertoire)) {
        $repertoire .= '/';
    }*/
    if (@ $dh = opendir($repertoire)) {
        
        echo "je suis dans le repertoire : (".$repertoire.")</br>";

        while (($fichier = readdir($dh)) != FALSE) {
            
        //echo "je suis dans le fichier : (".$fichier.")</br>";
            if ($fichier == '.') {           
                //echo "je suis a skip .(".$fichier.")</br>";
                continue; // Skip it     
            }
            else if ($fichier == '..') {         
                //echo "je suis a skip ..(".$fichier.")</br>";
                continue; // Skip it
            }
            else {         
                //echo "pas de fichier skip </br>";
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
            $points_cole=preg_match('[…]', $fichier);
            //$points_separe=preg_match('[a{3}]', $fichier);
            //$points_separe=preg_match('([.]{3})', $fichier);
            $points_separe=preg_match('([.]{2})', $fichier);
            //echo "point colle = (".$points_cole.") point separe = (".$points_separe.")";

            if ($points_cole == 1 || $points_separe == 1 ) {
                //echo "le fichier contient .. car (".$fichier.")</br>";
				renommerFichier($repertoire, $fichier);
            }
            else{
                echo "nom de fichier normale (".$fichier.")</br></br>";
            }
        }
        @ closedir($dh);
    }
} 

 
parcourirArborescence(BASE);
?>