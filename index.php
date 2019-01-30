<?php
require_once 'class/Pendu.php';

session_start();

$handle = @fopen("mots/motspendu.txt", "r");
$buffers="";
if ($handle) {
    while (($buffer = fgets($handle, 100000)) !== false) {
        $buffers .= $buffer." ";
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}


$tab=explode(" ",$buffers);
$i=count($tab);
$j=rand(0,$i-1);
$mot=str_replace(" ","", $tab[$j]);
$mot=str_replace("\n","", $mot);
$mot=str_replace("\r","", $mot);



if(isset($_GET['reset'])){
    unset($_SESSION['jeu']);
}

if(!isset($_SESSION['jeu'])){
    $_SESSION['jeu'] = new Pendu($mot);
}

$jeu = $_SESSION['jeu'];

if(isset($_POST['lettre']) and $_POST['lettre'] != "" and !$jeu->gagner() and !$jeu->Perdre()){
    $jeu->check($_POST['lettre']);
}

if(!$jeu->gagner()){$img = $jeu->getNbEssai();}   else{$img = 0;};

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="KNACSS/css/knacss.css">
    <link rel="stylesheet" href="css/stylesheet.css?v=<?=time()?>">
    <title>Pendu</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/monfichier.js"></script>

</head>
<body>
    <h1 id="titre">JEU DU PENDU</h1>

    <a id="reset" href="?reset">RESET</a>
    <div id="msg"><p><?php echo $jeu->getMsg();  ?></p></div>
    <form id="formulaire" action="index.php" method="post">
        <input type="text" maxlength="1" id="champ" name="lettre" onkeyup="onlyNumber();" autofocus />
        <input id="envoyer" type="submit" value="Vérifier">
    </form>
    <div id="img">
        <img src="images/pendu<?=$img ?>" alt="pendu">
    </div>
    <h2 id="mot">
        <?php
        if($jeu->gagner()){echo "BRAVO !!<br/>";}
        elseif ($jeu->Perdre()){
            echo "perdu <br/>".$jeu->getMot();
        }
        else{
            foreach ($jeu->getMotCache() as $key => $lettre){
                echo $lettre;
            };
        }
        ?>
    </h2>

    <script>
        // $( "#formulaire" ).submit(function( event ) {
        //     event.preventDefault();
        //
        // });

    </script>
</body>
</html>





