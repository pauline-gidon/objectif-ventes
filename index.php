<?php 
include 'vendor.php';

//je verifie s'il y a bien une methode post
if(isset($_POST["go"])) {
    
    //captcha spam
    if(empty($_POST['recaptcha-response'])){
        header('location: index.php');
    }else{
        // url de verif pour le captcha
        $url_verif = "https://www.google.com/recaptcha/api/siteverify?secret=".CAPTCHA_SITE_KEY_SECRET."&response={$_POST['recaptcha-response']}";
            
            // je regarde si curl est installé
            if(function_exists('curl_version')) {

                $curl = curl_init($url_verif);
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_TIMEOUT, 1);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($curl);
                
            }else{
                $response = file_get_contents($url_verif);
            }
            
            // je verifie la reponse
            if(empty($response) || is_null($response)){
                header('location: index.php');
            }else{
               
                $data = json_decode($response);
                if($data->success){
             
                    // si tous est ok je traite mon formulaire
                    //-------------------------------------------------------------------
                    //JE VENTILE LES DATAS EN EFFECTUANT
                    //UN PREMIER NETTOYAGE
                    //--------------------------------------------------------------------
                    $nom  = htmlspecialchars(strip_tags(trim($_POST["nom"])));
                    $sujet   = htmlspecialchars(strip_tags(trim($_POST["sujet"])));
                    $email    = htmlspecialchars(strip_tags(trim($_POST["email"])));
                    $message    = htmlspecialchars(strip_tags(trim($_POST["message"])));
                    $ok      = true;
                    // --------------------------------------------------------------------
                    //JE VERIFIE ET MESSAGE D'ERREURS
                    //---------------------------------------------------------------------
                    $blacklist = array(
                        'CLICK HERE',
                        'FREE',
                    );
                    $spam = false;

                    foreach ( $blacklist as $pattern ) {

                        if ( preg_match( $pattern, $message ) ) {
                            $spam = true;
                        }
                    }

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
                    if(!isset($_POST["rgpd"])){
                        $error5 = "Vous devez accepter les conditions pour être recontacté"; 
                    $ok = false;
                    }
                    // --------------------------------------------------------------------
                    //SI PAS D'ERREUR, ALORS TRAITEMENT FINAL...
                    //---------------------------------------------------------------------
                    if($ok) {
                    //ON VA ENVISAGER UN TRAITEMENT FINAL
                    //AVEC UN DERNIER NETTOYAGE SPECIFIQUE AU TRAITEMENT
                    //-Insert BDD, nettoyage avant les insertions en BDD
                    //-Envoyer à une adresse mail, nettoyage specifique avant envoi
                    //-...
                    // var_dump("plus d'erreur, traitement final possible");
                    // die();
                        $expediteur = 'no-reply@objectif-vente.com';
                        $destinataire = 'romain@objectif-vente.com';

                        $entetes 	=	"From:".$expediteur."\n";
                        $entetes 	.=	"Reply-To:".$email."\n";
                        $entetes 	.=	"MIME-Version: 1.0\r\n";
                        $entetes 	.=	"Content-Type: text/html; charset=utf-8\r\n";
                        $entetes 	.=	"Content-Transfert-Encoding: 8bit\r\n";
                        $entetes 	.=	"Object:".$sujet;
                            
                        $contenue_message = utf8_decode($message)."\r\n";
                        $contenue_message = "<div><hr><strong>De : ".$email."</strong><br><strong>Sujet : </strong> ".$sujet.",<br><hr><br> <strong>message : </strong>".$contenue_message."</div>";
                        if($spam == false){
                            $success = mail($destinataire,$sujet,$contenue_message,$entetes);
                        }
                     
                        if($success && $spam){

                            $resultEnvoieMail = "<span class=\"mailOK\">Votre message a bien été envoyé</span>";
                            unset($nom,$message,$sujet,$email,$contenue_message);
                        
                        }else{
                            $resultEnvoieMail = "<span class=\"mailNotOK\">Un problème est survenue votre message n'a pas été envoyé</span>";
                            unset($nom,$message,$sujet,$email,$contenue_message);
                        }
                    }//traitement final envoie du mail
                }// captcha success
            }// reponse captcha vide ou null
    }//Captcha value vide
}//if go 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Mon objectif : vous former aux meilleures techniques de vente pour que vos produits et services trouvent leur public">
    <meta name="robots" content="noindex,nofollow"/>
    <title>Objectif vente</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/responsive.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shippori+Antique+B1&display=swap" rel="stylesheet"> 
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet"> 
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/9e45878e2c.js" crossorigin="anonymous"></script>
    <!-- allIcone -->
    <link rel="stylesheet" href="public/css/icofont/icofont.min.css">
    <!-- lien jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- cookies -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />







</head>
<body>
<header >
        <input type="checkbox" id="burger">
		<label for="burger">menu</label>
        <nav class="wrap">
            <ul class="fc">
                <li><a href="#former" title="Former">Former</a></li>
                <li><a href="#accompagner" title="Accompagner">Accompagner</a></li>
                <li><a href="#pack" title="Pack de formations">Former & Accompagner</a></li>
                <li class="mla"><a href="#me" title="A propos">A propos</a></li>
                <li id="contact"><a href="#" title="Contact">Contact</a></li>
            </ul>

        </nav>
    </header>
    <main>
        <div class="area">

            <?php
                if(isset($resultEnvoieMail)) {
                    echo $resultEnvoieMail;
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
            
            <h1>Objectif <strong>Vente</strong></h1>
        </div>
        <div class="wrap titleDescritpiton">
            <p class="tc">Je vous propose mon expertise et mon savoir-faire en <strong>vente</strong> grâce à mes trois modules de formation qui sont adaptables à chaque situation et contexte.</p> 
            <p class="tc">Venez découvrir sans attendre mes formations pour vendre vos produits et services.</p>
            <br>
            <p class="tc">Elles sont faites pour vous&nbsp;!</p>
        </div>
        <!-- FORMER -->
        <section id="former">
            <!-- header section former -->
            <div class="containerHeaderSection">
                <div class="headerSection wrap">
                    <div class="col1">
                        <img src="public/images/se-former.svg" alt="se former dans la vente">
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
                                <img src="public/images/essentiel.svg" alt="les points essentiels dans la vente">

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
                                <img src="public/images/fondamentaux.svg" alt="fondamentaux dans la vente">


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
                                <img src="public/images/reussite.svg" alt="la reussite dans la vente">


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
                        <img src="public/images/accompagner.svg" alt="l'accompagnement dans la vente">
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
                <h4 class="fc jc-c ai-c">Etre accompagné</h4>

                <div class="fc fw jc-sb">
                    <!-- card accompagner -->
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-front">
                                <p class="motcle">Observation</p>
                                <img src="public/images/observation.svg" alt="observation de vent">

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
                                <img src="public/images/conseil.svg" alt="conseil de vente">

                            </div>
                            <div class="card-back">
                                <p>Bien réaliser ses rendez-vous ainsi que son activité sont importants pour le développement de sa profession.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-inner">
                            <div class="card-front">
                                <p class="motcle">Expertise</p>
                                <img src="public/images/expertise.svg" alt="expertise de vente">

                            </div>
                            <div class="card-back">
                                                       
                                <p>Suite à mon observation après vous avoir accompagné lors de votre activité, je vous apporterai mon expertise professionnelle.</p>
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
                        <img src="public/images/former-accompagner.svg" alt="former-accompagner dans la vente">
                    </div>
                    <div class="col2">
                        <h2>Le meilleur moyen de réussir de belles <strong>ventes</strong></h2>
                        <h3 clas="animeTitleSection">Former & Accompagner</h3>
                    </div>

                </div>
            </div>
             <!-- FIN header section former/accompagner -->
                       
            <div class="descriptif wrap">
                <h4 class="fc jc-c ai-c">La clé de la réussite</h4>

                <div class="fc fw jc-sb">

                    <!-- card pack complet -->
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-front">
                                <p class="motcle">Comprendre</p>
                                <img src="public/images/comprendre.svg" alt="comprendre la vente">


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
                                <img src="public/images/applicquer.svg" alt="applicquer les techniques de vente">

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
                                <img src="public/images/aboutir.svg" alt="aboutir toute ses ventes">

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
                                <p>Ayant la fibre commerciale et relationnelle depuis toujours, c'est tout naturellement que je m'oriente vers un parcours commercial en <strong>ventes</strong> commencé il y a maintenant deux décennies.</p>
                                <p>Au fil des années, j'ai appris et acquis un bon nombre de techniques commerciales que j'ai su mettre en application et qui ont porté leurs fruits.</p>
                                <p>Aujourd'hui, je vous propose de vous les transmettre avec passion et énergie.</p>
                        </div>
                        <div>
                            <img src="public/images/me.svg" alt="image" class="full-img">
                        </div>
                    </div>
                    <div class="signature">
                        <p>A très vite pour une belle aventure ensemble&nbsp;!</p>
                        <p>Romain</p>
                        <p class="fc fw jc-fe">
                            <a href="https://twitter.com/ObjectifVente" target="_blank"><i class="icofont-twitter"></i></a>
                            <a href="https://www.facebook.com/Objectif-Vente-110288224911538" target="_blank"><i class="icofont-facebook"></i></a>
                            <a href="https://www.instagram.com/objectif.vente/?hl=fr" target="_blank"><i class="icofont-instagram"></i></a>

                        </p>
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
          

            <form id="my_form" action="index.php" method="POST" enctype="multipart/form-data">
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
                <!-- SWITCHES -->
                    <div class="switch">
                        <input type="checkbox" id="switch1" class="switch__input" name="rgpd" value=rgpd>
                        <label for="switch1" class="switch__label">En soumettant ce formulaire, j’accepte que les informations saisies soit utilisées pour être recontactées.</label>
                        <?php if(isset($error5)) echo "<span class=\"error\">".$error5."</span>"; ?>
                    </div>

                <p >
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <input type="submit" name="go" value="Envoyer" class="btnGo">
                </p>

                <!-- captcha -->
                <input type="hidden" id="recaptchaResponse" name="recaptcha-response">

                <!-- <button class="g-recaptcha btnGo" 
                    data-sitekey="" 
                    data-callback='onSubmit' 
                    data-action='submit'
                    name="go">Envoyer
                </button> -->
                <script>
                    grecaptcha.ready(function() {
                    grecaptcha.execute('6Lfr1oEeAAAAAGCsE3WOZ0dPVUWmHSf-ct6lnLef', {action: 'homepage'}).then(function(token) {
                    document.getElementById('recaptchaResponse').value = token
                        });
                    });
                </script>
           
            </form>
        </div>
    </div>

    <footer>
            <p><a href="lesMentionLegales.php">Mentions Légales</a></p>
            <p><a href="LesPolitiques.php">Politique de confidentialité</a></p>
    </footer>
<!-- Tout le Javascript -->

<script src="public/js/modaleContact.js" defer></script>
<script src="public/js/feedback.js" defer></script>
<script src="public/js/scollX.js" defer></script>
<!-- cookies -->
<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
<script src="public/js/cookies.js" defer></script>

</body>
</html>