<?php
    $db = mysqli_connect('localhost','vente_en_ligne','IsImA_2021/%','vente_en_ligne',3307);   
    /* ici nous nous connectons à la base de données*/
    $db -> query('SET NAMES UTF8');      
    /* ceci permet d'avoir des caractères spéciaux par exemple avec des accents */

    if (isset($_GET['add'])) /* si la variable "add" est définie, alors il faut ajouter au panier l'article ayant pour identifiant la valeur de "add" */
    {
        $check_query = "SELECT DISTINCT 1 as row_exists FROM panier_article WHERE id_article =".$_GET['add'].";";   
        /* nous donne 1 si le panier contient déjà ce produit */
        $check_result = $db -> query($check_query) or die('Erreur SQL : '.mysqli_error($db));   
        /*exécution de la commande */

        if (mysqli_fetch_array($check_result)['row_exists'] == 1)   /*si la panier contient le produit */
        {
            $sql = "UPDATE panier_article SET quantite = quantite + 1 WHERE id_article =".$_GET['add'].";";   
            /*nous incrémentons tout simplement la quantité */
        }
        else $sql = "INSERT INTO panier_article VALUES (1,".$_GET['add'].",1,1.50,7.50,9.80);";   
        /*sinon nous devons créer une nouvelle ligne pour le produit à ajouter avec, forcément, une quantité de 1 */
        $result = $db -> query($sql) or die('Erreur SQL : '.mysqli_error($db));   /*exécution */
    }

    if(isset($_GET['empty'])) /* si la variable "empty" est définie, ceci indique qu'il s'agit de vider le panier */
    {
        $sql = "DELETE FROM panier_article;";  /* commande SQL pour supprimer toutes les entrées de la table du panier */
        $result = $db -> query($sql) or die('Erreur SQL : '.mysqli_error($db));   /* exécution */
    }

    $affichage_sql = "SELECT * FROM panier_article pa JOIN article a ON a.id = pa.id_article;";   
    /*quoi qu'on ait fait précedemment (ajout ou suppression), il faut afficher sur le site le nouveau panier */
    $affichage_result = $db -> query($affichage_sql) or die('Erreur SQL : '.mysqli_error($db));
    /* exécution du SQL */

    while($data = mysqli_fetch_array($affichage_result))  
    /*on affiche l'ensemble des items du panier à afficher (il est possible qu'il n'y ait rien à afficher d'ailleurs) */
    {
        echo '<div class="affichage_libelle">';
        echo '  <p style="color:#717171;">'.$data['libelle'].'</p>';
        echo '  <p style="text-align:right; color:#ffffff" >'.$data['quantite'].' x '.$data['prix_ttc'].' = '.number_format($data['quantite']*$data['prix_ttc'],2).' €</p>';
        echo '</div>';
    }

    mysqli_close($db);   /* fermeture de la connexion avec la base de données */
?>