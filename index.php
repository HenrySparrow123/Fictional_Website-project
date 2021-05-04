<html>

<head>
    <link rel="stylesheet" type="text/css" href="/styles.css">
    <!-- cette ligne permet de relier notre fichier de styles .css à notre page web : très important -->
</head>

<body style="background-color:#474747; margin: 0;">
    <div id="page">
    <!-- dans notre page web, nous avons 5 parties :
    1) la partie "Titre" qui contient le nom du magasin et son logo
    2) la partie "Authentification"  qui permettrait aux utilisateurs ayant un compte de se connecter
    3) la partie "Contenu" qui affiche l'ensemble des familles ou des produts disponibles dans le magasin
    4) la partie "Panier" qui contient l'ensemble de produits que le client a choisi de retenir en vue 
    d'acheter ("commander"), ou pas ("vider panier")
    5) la partie "Pied de page" qui contient des informations sur le magasin à savoir son adresse ainsi que 
    quelques informations de société 
    
    Ces cinq parties sont implémentées dans l'ordre présenté à travers les cinq divs suivants -->
    
    <!--Certaines parties, notamment le contenu et la panier sont complexes car ils nécessitent l'appel à notre base de données
    et ont un comportement délicat : ainsi, nous avons inclu un dossier src à ce projet qui contient des scripts PHP qui
    implémentent ces parties plus compliquées  -->


        <div id="titre">
            <table>
                <tr>
                    <th><img id="image" src="/img/logo_200px.gif"></th>
                    <th><span class="titletext">le leader du modélisme en ligne</span></th>
                </tr>
            </table>
        </div>

        <div id="authentification">
        <!-- Ici nous créons un form pour relever l'ensemble des informations d'identification de l'utilisateur :
        ce form, bien que nous ne le faisons pas ici, permettrait d'envoyer les informations vers un serveur extérieur 
        afin de les vérifier et permettre - ou pas - la connexion -->
            <form action="" method="get" class="form-example">
                <label for="address">adresse mail</label><br>
                <input type="text" id="address"><br>
                <label for="mdp">mot de passe</label><br>
                <input type="password" id="mdp"><br>     <!-- le type "password" permet d'avoir les petits ronds qui cachent
                                                        le mot de passe -->
            </form>
            <button class="myButton">se connecter</button>
            <button class="myButton">créer un compte</button>
        </div>

        <div id="contenu">
            <?php require "src/show_contenu.php"; ?>    <!-- dû à la complexité de l'affichage du contenu, son code se fait à part entière
                                                        dans un scrit .php extérieur. La complexité est dû au fait qu'il y ait plusieurs familles
                                                        et plusieurs articles par famille. La gestion de ces complexités se fait notamment grâce
                                                        à l'URL du site (cf. show_contenu.php) -->
        </div>

        <div id="panier">
            <div id="panierheader">
                <div id="titrepanier" style="font-size: 20px;"><img src="/img/panier.gif" height="30" width="30">votre panier</div>
            </div>
            <div id="panierobjets"> <?php require "src/show_panier.php"; ?> </div>
            <div id="paniertotal"> <?php require "src/show_total_panier.php" ?> </div>
            <!-- comme pour la partie "Contenu", la complexité de ces deux sections (la liste du panier et la partie où figure le total),
            des scripts .php extérieurs ont dûs être codés -->
        </div>

        <div id="pied_de_page">
            TOPModelisme.com est enregistre au R.C.S sous le numero 1234567890<br>
            13 avenue du Pre La Reine - 75007 Paris
        </div>
    </div>
</body>

</html>