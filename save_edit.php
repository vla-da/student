<?require_once 'engine/page/title.php';?>
<?require_once 'engine/connection/connectionStart.php';?>
<html>
    <body>
        <?
            if((isset($_POST['id']))&&(isset($_POST['index']))){
                $id = htmlentities(mysqli_real_escape_string($link, $_POST['id']));
                $index = htmlentities(mysqli_real_escape_string($link, $_POST['index']));
                switch($index){
                    case "stud":
                        if((isset($_POST['fio']))&&(isset($_POST['fac']))&&(isset($_POST['gruppa']))&&(isset($_POST['nz']))&&(isset($_POST['num']))){
                            $fio = htmlentities(mysqli_real_escape_string($link, $_POST['fio']));
                            $fac = htmlentities(mysqli_real_escape_string($link, $_POST['fac']));
                            $gruppa = htmlentities(mysqli_real_escape_string($link, $_POST['gruppa']));
                            $nz = htmlentities(mysqli_real_escape_string($link, $_POST['nz']));
                            $num = htmlentities(mysqli_real_escape_string($link, $_POST['num']));
                            if((strlen($fio)==0)||(strlen($fac)==0)||(strlen($gruppa)==0)||(strlen($nz)==0)||(strlen($num)==0)){
                                die("Ошибка значения пусты");
                            }
                            $query = "UPDATE $database.$index SET fio = '$fio', fac = '$fac', gruppa = '$gruppa', nz = '$nz', num = '$num' WHERE $database.$index.id = '$id'";
                            mysqli_query($link, $query) or die("Не могу выполнить запрос!");
                            if(mysqli_affected_rows($link)>0){
                                echo("<p>Thanks! You added $index.");
                                echo "<p><a href=\"index.php\"> Return</a>"; 
                            } else { 
                                echo("Saving error. <a href=\"index.php\"> Return</a>");
                            }
                        }
                    break;
                    case "pred":
                        if((isset($_POST['name']))&&(isset($_POST['fio']))){
                            $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
                            $fio = htmlentities(mysqli_real_escape_string($link, $_POST['fio']));
                            if((strlen($fio)==0)||(strlen($name)==0)){
                                die("Ошибка значения пусты");
                            }
                            $query = "UPDATE $database.$index SET name = '$name', fio = '$fio' WHERE $database.$index.id = '$id'";
                            mysqli_query($link, $query) or die("Не могу выполнить запрос!");
                            if(mysqli_affected_rows($link)>0){
                                echo("<p>Thanks! You added $index.");
                                echo "<p><a href=\"index.php\"> Return</a>"; 
                            } else { 
                                echo("Saving error. <a href=\"index.php\"> Return</a>");
                            }
                        }
                    break;
                    case "vedm":
                        if((isset($_POST['ocenka']))&&(isset($_POST['date']))&&(isset($_POST['stud_select']))&&(isset($_POST['pred_select']))){
                            $date = htmlentities(mysqli_real_escape_string($link, $_POST['date']));
                            $ocenka = htmlentities(mysqli_real_escape_string($link, $_POST['ocenka']));
                            $stud_select = htmlentities(mysqli_real_escape_string($link, $_POST['stud_select']));
                            $pred_select = htmlentities(mysqli_real_escape_string($link, $_POST['pred_select']));
                            if(($stud_select=="")||($pred_select=="")){
                                die("Ошибка значения пусты");
                            }
                            $query = "UPDATE $database.$index SET date = '$date', stud = '$stud_select', pred = '$pred_select', ocenka = '$ocenka' WHERE $database.$index.id = '$id'";
                            mysqli_query($link, $query) or die("Не могу выполнить запрос!");
                            if(mysqli_affected_rows($link)>0){
                                echo("<p>Thanks! You added $index.");
                                echo "<p><a href=\"index.php\"> Return</a>"; 
                            } else { 
                                echo("Saving error. <a href=\"index.php\"> Return</a>");
                            }
                        }
                    break;
                }
            }
        ?>
	</body>
</html>
<?require_once 'engine/connection/connectionEnd.php';?>