<?php 
if(isset($_POST["go"])) {
  
    //-------------------------------------------------------------------
    //ETAPE 2 : JE VENTILE LES DATAS EN EFFECTUANT
    //UN PREMIER NETTOYAGE
    //--------------------------------------------------------------------
        $nom  = htmlspecialchars(strip_tags(trim($_POST["nom"])));
        $sujet   = htmlspecialchars(strip_tags(trim($_POST["sujet"])));
        $email    = htmlspecialchars(strip_tags(trim($_POST["email"])));
        $message    = htmlspecialchars(strip_tags(trim($_POST["message"])));
        $ok      = true;
    // --------------------------------------------------------------------
    // ETAPE 3 : JE VERIFIE ET MESSAGE D'ERREURS
    //---------------------------------------------------------------------
    if(empty($nom)){
        $error1 = "Votre Nom ou Prénom est obligatoire"; 
        $ok = false;
    }
    if(empty($sujet)){
        $error2 = "Le sujet est obligatoire"; 
        $ok = false;
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $error3 = "Une adresse mail valide"; 
        $ok = false;
    }
    if(empty($message)){
        $error4 = "Le message est obligatoire"; 
        $ok = false;
    }

    // --------------------------------------------------------------------
    // ETAPE 4 : SI PAS D'ERREUR, ALORS TRAITEMENT FINAL...
    //---------------------------------------------------------------------
    if($ok) {
    //ON VA ENVISAGER UN TRAITEMENT FINAL
    //AVEC UN DERNIER NETTOYAGE SPECIFIQUE AU TRAITEMENT
    //-Insert BDD, nettoyage avant les insertions en BDD
    //-Envoyer à une adresse mail, nettoyage specifique avant envoi
    //-...
    // var_dump("plus d'erreur, traitement final possible");
    // die();
    $expediteur = 'p@picmento.fr';
    $destinataire = 'pauline.gidon@gmail.com';
    
    $entete = "From : ".$expediteur;

    $contenue_message = utf8_decode($message)."\r\n";
    $contenue_message = "De : ".$email.", Sujet : ".$sujet.", ".$contenue_message;
    
    $sucess = mail($destinataire,$sujet,$contenue_message, $entete);
        
        if($sucess){
            $mailenvoyer = "<span class=\"mailOK\">Votre message a bien été envoyer</span>";
            unset($nom,$message,$sujet,$email);
         
        }
    }
    
    
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Objectif ventes</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shippori+Antique+B1&display=swap" rel="stylesheet"> 
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!-- lien jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
<header >
        <input type="checkbox" id="burger">
		<label for="burger">menu</label>
        <nav class="wrap">
            <ul class="fc">
                <li><a href="#former" title="Former">Former</a></li>
                <li><a href="#accompagner" title="Accompagner">Accompagner</a></li>
                <li><a href="#pack" title="Pack de formations">Pack de formations</a></li>
                <li class="mla"><a href="#me" title="A propos">A propos</a></li>
                <li id="contact"><a href="#" title="Contact">Contact</a></li>
            </ul>

        </nav>
    </header>
    <main>
        <div class="area">

            <?php
                if(isset($mailenvoyer)) {
                    echo $mailenvoyer;
                }
            ?>
            <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
            </ul>
            <h1>Objectif Ventes</h1>
        </div>
        <!-- FORMER -->
        <section id="former">
            <!-- header section former -->
            <div class="containerHeaderSection">
                <div class="headerSection wrap">
                    <div class="col1">
                        <img src="public/images/se-former.svg" alt="se former">
                    </div>
                    <div class="col2">
                        <h2>Les techniques de vente sont indispensables à sa réussite</h2>
                        <h3 clas="animeTitleSection">Se former</h3>
                    </div>

                </div>
            </div>
            
            <!-- FIN header section former -->
            <!-- description former -->
            <div class="descriptif wrap">
                <h4 class="fc jc-c ai-c">Back to basics</h4>
                <!-- containner card -->
                <div class="fc fw jc-sb">
                    <!-- card Former -->
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-front">
                                <p class="motcle">Essentiel</p>
                                <img src="public/images/essentiel.svg" alt="les points essentiels">

                            </div>
                            <div class="card-back">
                                <p>Les points essentiels à un bon rendez-vous vous seront communiqués afin de vous transmettre les mots clés , les bonnes postures à avoir avec ses prospects et clients pour la réussite de votre activité, sa croissance ainsi que son développement.</p>


                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-inner">
                            <div class="card-front">
                                <p class="motcle">Fondamentaux</p>
                                <img src="public/images/fondamentaux.svg" alt="fondamentaux dans la ventes">


                            </div>
                            <div class="card-back">
                
                                <p>Les fondamentaux sont efficaces et indispensables, car ils sont le moteur de votre réussite ainsi que votre épanouissement certain dans votre profession.</p>


                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-inner">
                            <div class="card-front">
                                <p class="motcle">Réussite</p>
                                <img src="public/images/reussite.svg" alt="reussite">


                            </div>
                            <div class="card-back">
                                                       
                                <p>Vous aurez ensuite le sentiment de réussir tous vos rendez-vous, même ceux qui ne porteront pas tout de suite leurs fruits, car votre image sera bien installée dans la durée pour vous garantir une belle notoriété.</p>

                            </div>
                        </div>
                    </div>
                
                </div> <!-- fin containner card -->
            </div>
            <!-- FIN description former -->
        </section>
        <!-- ACCOMPAGNER -->
        <section id="accompagner">
            <!-- header section accompagner -->
            <div class="containerHeaderSection">
                <div class="headerSection wrap">
                    <div class="col1">
                        <img src="public/images/accompagner.svg" alt="accompagnement">
                    </div>
                    <div class="col2">
                        <h2>L'accompagnement permet d'observer et de comprendre<br>les bons comportements à adapter</h2>
                        <h3 clas="animeTitleSection">Se faire accompagner</h3>
                    </div>

                </div>
            </div>

            <!-- FIN header section accompagner -->
             <!-- description accompagner -->
              
            <div class="descriptif wrap">
                <h4 class="fc jc-c ai-c">Etre accompagner</h4>

                <div class="fc fw jc-sb">
                    <!-- card accompagner -->
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-front">
                                <p class="motcle">Observation</p>
                                <img src="public/images/observation.svg" alt="observation">

                            </div>
                            <div class="card-back">
                                <p>Je vous propose de vous accompagner pour observer, analyser et corriger les éléments indispensables à la conquête de nouveaux clients et à leur fidélisation.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-inner">
                            <div class="card-front">
                                <p class="motcle">Conseil</p>
                                <img src="public/images/conseil.svg" alt="conseil">

                            </div>
                            <div class="card-back">
                                <p>Bien réalisé ses rendez-vous ainsi que son ... sont important pour le développement de sa profession.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-inner">
                            <div class="card-front">
                                <p class="motcle">Expertise</p>
                                <img src="public/images/expertise.svg" alt="expertise">

                            </div>
                            <div class="card-back">
                                                       
                                <p>Suite à mon observation après vous avoir accompagné lors de votre activité, je vous apporterais mon expertise professionnelle.</p>
                            </div>
                        </div>
                    </div>
                  
                    
                    
                </div>
            </div>
             <!-- FIN description accompagner -->

        </section>
        <!-- pack de formation -->
        <section id="pack">
             <!-- header section former/accompagner -->
             <div class="containerHeaderSection">
                <div class="headerSection wrap">
                    <div class="col1">
                        <img src="public/images/former-accompagner.svg" alt="former-accompagner">
                    </div>
                    <div class="col2">
                        <h2>Le meilleur moyen de réussir de belles ventes</h2>
                        <h3 clas="animeTitleSection">Former & Accompagner</h3>
                    </div>

                </div>
            </div>
             <!-- FIN header section former/accompagner -->
                       
            <div class="descriptif wrap">
                <h4 class="fc jc-c ai-c">La clée de la réussite</h4>

                <div class="fc fw jc-sb">

                    <!-- card pack complet -->
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-front">
                                <p class="motcle">Comprendre</p>
                                <img src="public/images/comprendre.svg" alt="comprendre">


                            </div>
                            <div class="card-back">
                                <p>Associer la formation et l'accompagnement est la meilleure façon de savoir et comprendre pourquoi certains points sont la clé de la réussite.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-inner">
                            <div class="card-front">
                                <p class="motcle">Appliquer</p>
                                <img src="public/images/applicquer.svg" alt="applicquer">

                            </div>
                            <div class="card-back">
                                <p>En vous accompagnant suite à mon programme de formation, je m'assure que les moyens mis en oeuvre sont bien utilisés et exploités lors de vos rendez-vous.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-inner">
                            <div class="card-front">
                                <p class="motcle">Aboutir</p>
                                <img src="public/images/aboutir.svg" alt="aboutir">

                            </div>
                            <div class="card-back">
                                <p>Cette formule va vous redonner confiance en vos capacités avec plus de sérénité et de réussite professionnelle.</p>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
        </section>

        <!-- A PROPO -->
        <section id="me">
            <div class="containnerApropo">
                <div class="contentApropo wrap">
                    <h2>Qui suis-je?</h2>
                    <div class="boxeApropo">
                        
                        <div>
                                <p>Ayant la fibre commerciale et relationnelle depuis toujours, c'est tout naturellement que je m'oriente vers un parcours commercial en ventes commencé il y a maintenant deux décénnies.</p>
                                <p>Au fil des années, j'ai appris et acquis un bon nombre de techniques commerciales qu j'ai su mettre en application et qui ont porté leurs fruits.</p>
                                <p>Aujourd'hui, je vous propose de vous les transmettre avec passion et energie.</p>
                        </div>
                        <div>
                            <img src="public/images/me.svg" alt="" class="full-img">
                        </div>
                    </div>
                    <div class="signature">
                        <p>A très vite pour une belle aventure ensemble&nbsp;!</p>
                        <p>Romain</p>
                    </div>
                </div>

            </div>
            
        </section>
    </main>
    <!-- formulaire -->
    <div id="formContact" class="fc jc-c ai-c">
        <div class="form-box">

            <span id="close" class="fc jc-c ai-c" ><i class="fas fa-times"></i></span>
            <h2>Contact</h2>
          

            <form action="index.php" method="post" enctype="multipart/form-data">
                <div class="content-box">
                    <?php if(isset($error1)) echo "<span class=\"error\">".$error1."</span>"; ?>
                    <input type="text" name="nom" required="" <?php if(isset($nom)) echo "value=\"$nom\"";?>>
                    <label>Nom</label>

                </div>
                <div class="content-box">
                    <?php if(isset($error2)) echo "<span class=\"error\">".$error2."</span>"; ?>
                    <input type="text" name="sujet" required="" <?php if(isset($sujet)) echo "value=\"$sujet\"";?>>
                    <label>Sujet</label>

                </div>
                <div class="content-box">
                    <?php if(isset($error3)) echo "<span class=\"error\">".$error3."</span>"; ?>
                    <input type="email" name="email" required="" <?php if(isset($email)) echo "value=\"$email\"";?>>
                    <label>Votre email</label>
                </div>
                <div class="message fc fw">
                    <?php if(isset($error4)) echo "<span class=\"error\">".$error4."</span>"; ?>


                    <textarea name="message" cols="20" rows="5" placeholder="Votre message..." required=""><?php if(isset($message)) echo $message;?></textarea>
                    
                </div>
                
                <p>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <input type="submit" name="go" value="Envoyer" class="btnGo">
                </p>
            </form>
        </div>
    </div>

    <footer>
            <p><a href="mentionLegales.php">Mentions Légale</a></p>
    </footer>
<!-- Tout le Javascript -->

<script src="public/js/modaleContact.js" defer></script>
<script src="public/js/feedback.js" defer></script>
<script src="public/js/scollX.js" defer></script>

</body>
</html>