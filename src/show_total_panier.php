<?php
    $db = mysqli_connect('localhost','vente_en_ligne','IsImA_2021/%','vente_en_ligne',3307);
    $db -> query('SET NAMES UTF8');
    $affichage_sql = "SELECT * FROM panier_article pa JOIN article a ON a.id = pa.id_article;";
    $affichage_result = $db -> query($affichage_sql) or die('Erreur SQL : '.mysqli_error($db));

    /* les quatre lignes ci-dessus permettent respectivement de :
    1) se connecter à la base de données
    2) autoriser les caractères spéciaux
    3) créer la commande SQL permettant de récupérer l'ensemble des produits dans le panier
    4) exécuter la commande */

    if (mysqli_num_rows($affichage_result) != 0)    /*s'il y a des produits dans le panier i.e au moins 1 article */
    {
    
        $total = 0;      /* nous initialisons le total à payer à 0 */
        while($data = mysqli_fetch_array($affichage_result)) $total += $data['quantite'] * $data['prix_ttc'];
        /* pour chaque produit nous ajoutons au total le prix du produit en question multiplié par sa quantité dans le panier */

        /* nous reconstruisons l'URL courante afin d'assurer une continuité au niveau de l'affichage 
        sur le site (notamment dans la partie "Contenu") lorsque nous réalisons une tâche au niveau du panier*/
        $urlCourant = "index.php?";   /*ceci est le suffixe de l'URL i.e ce qui précède les paramètres GET */
        if (!empty($_GET))   /* s'il y a des paramètres GET alors on ajoute à l'URL la chaîne <clé_GET> = <valeur_GET>*/
        {
            foreach($_GET as $i) $urlCourant = $urlCourant.array_search($i,$_GET)."=".$i."&";
            /* array_search($val,$tab) renvoie la clé (si elle existe) correspondante $ la valeur $val dans l'array $tab
             : ici il s'agira donc du nom du paramètre (ex : empty, add ...)
             NB : après chaque paramètre on oublie pas de mettre "&" afin de les chaîner*/

        }

        echo '<p style="text-align:right;">TOTAL : '.number_format($total,2).' €</p>';
        echo '<br>';
        echo '<div id="boutons">';
        echo '  <a href="'.$urlCourant.'empty"><button class="myButton">vider panier</button></a>';
        /* on fixe la destination (href) à l'URL courante (ce qui assure la continuité dans toutes les autres 
        parties de la page) + le paramètre "empty" qui permet donc de vider la panier */
        echo '<button class="myButton">commander</button>';
        echo '</div>';
    }
    else echo '<p id="vide" style="color:#717171;">Votre panier est vide</p>';
    /* si le nombre de colonnes dans le résultat SQL est nul, alors il n'y a rien dans le panier et donc on affiche
    le message adéquat */
?>