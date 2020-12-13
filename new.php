<?require_once 'engine/page/title.php';?>
<?require_once 'engine/connection/connectionStart.php';?>
<html>
    <body>
		<?
            if(isset($_GET['Index'])){
                $index = htmlentities(mysqli_real_escape_string($link, $_GET['Index']));
                switch($index){
                    case "stud":
                        echo("<fieldset><legend>Добавить нового студента</legend>");
                        echo("<form id='form' method='post' action='save_new.php'>");
                        echo("Введите ФИО: <input name='fio' type='text'/> <br>");
                        echo("Введите Факультет: <input name='fac' type='text'/> <br>");
                        echo("Введите Группу: <input name='gruppa' type='text'/> <br>");
                        echo("Введите Номер зачетки: <input name='nz' type='text'/> <br>");
                        echo("Введите Телефон: <input name='num' type='text'/> <br>");
                        echo("<input type='hidden' name='index' value='".$index."'> <br>");
                        echo("<input type='submit' value='Добавить'/> <br>");
                        echo("</form>");
                        echo("</fieldset>");
                    break;
                    case "pred":
                        echo("<fieldset><legend>Добавить новый предмет</legend>");
                        echo("<form id='form' method='post' action='save_new.php'>");
                        echo("Введите название предмета: <input name='name' type='text'/> <br>");
                        echo("Введите ФИО преподавателя: <input name='fio' type='text'/> <br>");
                        echo("<input type='hidden' name='index' value='".$index."'> <br>");
                        echo("<input type='submit' value='Добавить'/> <br>");
                        echo("</form>");
                        echo("</fieldset>");
                    break;
                    case "vedm":
                        $queryTab_0 = "stud";
                        $queryTab_1 = "pred";
                        $query_0 = "SELECT * FROM $database.$queryTab_0 ORDER BY $database.$queryTab_0.id ASC";
                        $query_1 = "SELECT * FROM $database.$queryTab_1 ORDER BY $database.$queryTab_1.id ASC";
                        $result_0 = mysqli_query($link, $query_0) or die("Не могу выполнить запрос!");
                        $result_1 = mysqli_query($link, $query_1) or die("Не могу выполнить запрос!");
                        echo("<fieldset><legend>Добавить новую зачетную ведомость</legend>");
                        echo("<form id='form' method='post' action='save_new.php'>");
                        echo("Введите дату: <input id='date' type='date' name='date' value='01.01.2020'><br>");
                        
                        $id_0 = "stud_select";
                        echo("<label for='$id_0'>Список студентов: </label>");
                        echo("<select id='$id_0' name='$id_0'>");
                        echo("<option value=''>--Please choose an option--</option>");
                        while ($row=mysqli_fetch_array($result_0)){
                            echo("<option value='$row[0]'> №$row[0]|ФИО: $row[1]</option>");
                        }
                        echo("</select><br>");
                        $id_1 = "pred_select";
                        echo("<label for='$id_1'>Список предметов: </label>");
                        echo("<select id='$id_1' name='$id_1'>");
                        echo("<option value=''>--Please choose an option--</option>");
                        while ($row=mysqli_fetch_array($result_1)){
                            echo("<option value='$row[0]'> №$row[0]|Предмет: $row[1]|ФИО: $row[2]</option>");
                        }
                        echo("</select><br>");
                        
                        echo("Введите оценку: <input id='date' type='number' name='ocenka' min='2' max='5' value='5'><br>");
                        echo("<input type='hidden' name='index' value='".$index."'> <br>");
                        echo("<input type='submit' value='Добавить'/> <br>");
                        echo("</form>");
                        echo("</fieldset>");
                    break;
                }
            }
            
		?>
	</body>
</html>
<?require_once 'engine/connection/connectionEnd.php';?>