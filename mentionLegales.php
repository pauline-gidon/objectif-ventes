<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Objectif ventes - Mentions légale</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shippori+Antique+B1&display=swap" rel="stylesheet"> 
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">


</head>
<body>
<header >
        <input type="checkbox" id="burger">
		<label for="burger">menu</label>
        <nav class="wrap">
            <ul class="fc">
                <li><a href="index.php#former" title="Former">Former</a></li>
                <li><a href="index.php#accompagner" title="Accompagner">Accompagner</a></li>
                <li><a href="index.php#pack" title="Pack de formations">Pack de formations</a></li>
                <li class="mla"><a href="index.php#me" title="A propos">A propos</a></li>
                <li id="contact"><a href="#" title="Contact">Contact</a></li>
            </ul>

        </nav>
    </header>
    <main class="wrap containnerMentionLegale">
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
        <h1>Mentions legales</h1>

        <h2 class="titleh2MentionLegal">Présentation du site</h2>


        <h3 class="titleh3MentionLegal">Personne morale</h3>
        <p><strong>Propriétaire</strong> : Objectif ventes -- Grenoble<br>
        
        <h3 class="titleh3MentionLegal">Hebergement</h3>
        <strong>Hébergeur</strong> : O2switch – 222 Boulevard Gustave Flaubert 63000 Clermont-Ferrand<br></p>

        <h3 class="titleh3MentionLegal">Image</h3>
        <p><strong>Propriétaire</strong> : <a href="https://storyset.com/business">Business illustrations by Storyset</a></p>

        <p class="linkAccueil"><a href="index.php">Accueil</a>
        </p>


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
<!-- Tout le Javascript -->

<script src="public/js/modaleContact.js" defer></script>
<script src="public/js/styleMention.js" defer></script>
<script src="public/js/feedback.js" defer></script>

</body>
</html>