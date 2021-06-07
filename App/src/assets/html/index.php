<?php

use App\models\Page;

if ($page instanceof Page) :

?>
    <!DOCTYPE html>
    <html lang="en">

    <!-- 
        Souviens toi !
        Souviens toi de ce 5 de novembre.
        De ses poudres et de sa conspiration. 
        Souviens toi de ce jour, souviens t'en !  
        À l'oubli je ne peux me résoudre.
    -->

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Me-transfert</title>

        <link rel="stylesheet" href="<?= ASSETS ?>/css/style.css">

    </head>

    <body>
        <header>
            <div class="core">
                <h1> <?= $page->title; ?></h1>
                <p>Programme pour partager des fichier...</p>
            </div>
        </header>
        <nav>
            <div class="core">
                <!-- <a href="<?= RELPATH ?>">accueil</a> -->
                <?php
                foreach (Page::list() as $file) {
                    $file = substr(basename($file), 0, -5);
                    if (!strpos(URL, $file)) {

                ?>
                        <a href="<?= RELPATH . '/page/' . $file ?>"><?= substr($file, 0, -5); ?></a>
                <?php
                    }
                }
                ?>
            </div>
        </nav>
        <main>
            <div class="core">
                <?php
                if ('' != $page->include)
                    include $page->include;
                else
                    echo $page->content;
                ?>

            </div>
        </main>

        <footer>
            <div class="core">
                <div>
                    <form action="">
                        <input type="text">
                        <input type="submit" value="Chercher">
                    </form>
                </div>
                <div>
                    <h4>
                        Boilley Adrien © 2021
                    </h4>
                    <p>
                        Touts droits réservés.
                    </p>
                </div>
                <div>
                    <ul>
                        <li>
                            <a href="http://"> <img src="" alt="Facebook"></a>
                        </li>
                        <li>
                            <a href="http://"> <img src="" alt="Twitter"></a>
                        </li>
                        <li>
                            <a href="http://"> <img src="" alt="LinkedIn"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>

    </body>

    </html>

<?php
endif;
