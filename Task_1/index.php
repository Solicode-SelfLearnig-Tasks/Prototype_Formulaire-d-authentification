<?php    

  
   $name= "Guest";
   $bg_color = "#FFFFFF";
   $lang = "en";        
   $last_update = "";

   if(isset($_COOKIE["cookie_user"])){
      $name = $_COOKIE["cookie_user"];
   }
   if(isset($_COOKIE["cookie_color"])){
      $bg_color = $_COOKIE["cookie_color"];
   }
   if(isset($_COOKIE["cookie_lang"])){
      $lang = $_COOKIE["cookie_lang"];
   }
   if(isset($_COOKIE["cookie_last_update_date"])){
      $last_update = $_COOKIE["cookie_last_update_date"];
   }


   if($_SERVER["REQUEST_METHOD"] === "POST"){
         
    if(!empty($_POST["f_name"])){
        $name= $_POST["f_name"];
        setcookie("cookie_user" , $name , time() + 3600 * 24 * 30);
    }
    if(!empty($_POST["bg_color"])){
        $bg_color = $_POST["bg_color"];
        setcookie("cookie_color", $bg_color, time() + 3600 * 24 * 30);
    }
    if(!empty($_POST["choose"])){
        $lang = $_POST["choose"];
        setcookie("cookie_lang", $lang, time() + 3600 * 24 * 30);
    }
    $last_update = date('d-m-Y H:i:s');
    setcookie("cookie_last_update_date", $last_update, time() + 3600 * 24 * 30);
   }


    if($_SERVER["REQUEST_METHOD"] === "GET"){

        if(isset($_GET["action"]) && $_GET["action"] == "reset"){
            $name="Guest";
            $bg_color = "#FFFFFF";
            $lang = "en";
            $last_update = "";
            setcookie("cookie_user" , $name , time() - 3600 * 24 * 30);
            setcookie("cookie_color" , "" , time() - 3600 * 24 * 30);
            setcookie("cookie_lang" , "" , time() - 3600 * 24 * 30);
            setcookie("cookie_last_update_date" , "" , time() - 3600 * 24 * 30);
        }
        
    }


    $titleText = ($lang === 'en' ? 'Welcome, ' : 'Bienvenue, ') . htmlspecialchars($name);
    if($last_update !== ''){
        $updateText = ($lang === 'en' ? 'Last update: ' : 'Dernière mise à jour : ') . $last_update;
    } else {
        $updateText = ($lang === 'en' ? 'No previous visit recorded' : 'Aucune visite précédente enregistrée');
    }


$saveButton = ($lang === 'en' ? 'Save choices' : 'Enregistrer mes choix');
$resetLink = ($lang === 'en' ? 'Reset All' : 'Réinitialiser tout');
$selectedEn = $lang === 'en' ? 'selected' : '';
$selectedFr = $lang === 'fr' ? 'selected' : '';

echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        body{
             background-color: {$bg_color};
        }
    </style>
    <div>
          <h1>{$titleText}</h1>
          <h3>{$updateText}</h3>
          <form action="" method="post">
            <label for="name">nom:</label>
            <input type="text" name="f_name" id="name" value="{$name}">
            <br>
            <br>
            <label for="bg_color">couleur de fond :</label>
            <input type="color" name="bg_color" id="bg_color" value="{$bg_color}">
            <br>
            <br>
            <label for="">Langue</label>
            <select name="choose">
                <option value="en" {$selectedEn}>English</option>
                <option value="fr" {$selectedFr}>Francais</option>
            </select>
             <br>
             <br>
            <input type="submit" name="save_your" value="{$saveButton}">
           <br><br>
          <hr>
          </form>
          <a href="index.php?action=reset">{$resetLink}</a>
     </div>
</body>
</html>
HTML;
?>