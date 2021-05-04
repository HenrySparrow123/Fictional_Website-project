<?php
    
    /* Dans ce code, les fonction mysqli sont les fonctions qui permettent la manipulation de données et de communiquer
    avec la base de données du projet*/
    
    $db = mysqli_connect('localhost','vente_en_ligne','IsImA_2021/%','vente_en_ligne',3307);    /* ici nous nous connectons à la base de données*/
    $db -> query('SET NAMES UTF8');        /* ceci permet d'avoir des caractères spéciaux par exemple avec des accents */

    if (isset($_GET['famille'])) $sql = "SELECT * FROM article WHERE id_famille = ".$_GET['famille'].";";    /* si "famille" est défini, nous sélectionons l'ensemble des produits de cette famille*/
    else $sql = "SELECT * FROM famille;";   /* sinon nous prenons toutes les familles */

    $result = $db -> query($sql) or die('Erreur SQL : '.mysqli_error($db));    /*nous exécutons la commande*/

    if (isset($_GET['famille']))     /* si une variable "famille" est définie, ceci implique qu'il faut afficher les produits de cette famille*/
    {
        echo '<a href="index.php">';        /* ainsi en cliquant sur le bouton, nous reviendrons à la page principale qui affiche les familles */
        echo '  <button class="myButton">Retour</button>';
        echo '</a>';

        echo '<br>';

        while($data = mysqli_fetch_array($result))
        {
            /* le code dans ce "while" permet de créer le "bloc" d'un produit */

            echo '<div class="affichage_articles">';
            echo '  <table>';
            echo '      <tr>';
            echo '          <td><img src="/img_articles/'.$data['image'].'" height="80" width="100"></td>';
            echo '          <td>';
            echo                $data['libelle'].'</br>';
            echo '              <div style="color:rgb(144,144,144);">'.$data['detail'].'</div>';
            echo '              <div style="margin: 0px; color: #861825; font-weight: bold; text-indent: 20px;">';
            echo                    $data['prix_ttc'].' €';
            echo '                  <a href="index.php?famille='.$data['id_famille'].'&add='.$data['id'].'">';
            echo '                      <button class="myButton" style="margin-left: 20px;" href="index.php?famille='.$data['id'].'&add='.$data['id'].'">commander</button>';
            echo '                  </a>';
            echo '              </div>';
            echo '          </td>';
            echo '      </tr>';
            echo '  </table>';
            echo '</div>';
        }
    }
    else       /* si la variable "famille" n'est pas définie, alors ceci veut dire qu'il faut justement afficher les familles */
    {
        while($data = mysqli_fetch_array($result))
        {
            echo '<a href="index.php?famille='.$data['id'].'">';
            echo '  <div class="affichage_familles">';
            echo '      <p style="text-align: center;"><img src="/img_familles/'.$data['image'].'" height="100" width="100">';
            echo '      '.$data['libelle'].'</p>';
            echo '  </div>';
            echo '</a>';
        }
    } 
    mysqli_close($db);  /* nous fermons la connexion à la base de données */
?>