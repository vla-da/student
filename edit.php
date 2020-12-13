<?require_once 'engine/page/title.php';?>
<?require_once 'engine/connection/connectionStart.php';?>
<html>
    <body>
		<?
            if((isset($_GET['id']))&&(isset($_GET['query']))){
                $id = htmlentities(mysqli_real_escape_string($link, $_GET['id']));
                $index = htmlentities(mysqli_real_escape_string($link, $_GET['query']));
                switch($index){
                    case "stud":
                        $array = array("№", "fio", "fac", "gruppa", "nz", "num");
                        $arrayT = array("№", "ФИО", "факультет", "группу", "номер зачетки", "телефон");
                        $query = "SELECT * FROM $database.$index WHERE id='$id'";
                        $result = mysqli_query($link, $query) or die ("Ошибка в запросе");
                        $rows = array();
                        echo("<fieldset><legend>Изменить студента</legend>");
                        echo("<form id='form' method='post' action='save_edit.php'>");
                        while ($row=mysqli_fetch_array($result)){
                            for($i = 0; $i < count($row)/2; $i++){
                                if($i == 0){
                                    echo("<input type='hidden' name='id' value='$id'> <br>");
                                } else {
                                    $ar =  $row[$i];
                                    echo("Изменить $arrayT[$i]: <input name='$array[$i]' size='50' type='text' value='$ar'> <br>");
                                }
                            }
                        }
                        echo("<input type='hidden' name='index' value='$index'> <br>");
                        echo("<input type='submit' value='Сохранить'/> <br>");
                        echo("</form>");
                        echo("</fieldset>");
                    break;
                    case "pred":
                        $array = array("№", "name", "fio");
                        $arrayT = array("№", "название предмета", "ФИО преподавателя");
                        $query = "SELECT * FROM $database.$index WHERE id='$id'";
                        $result = mysqli_query($link, $query) or die ("Ошибка в запросе");
                        $rows = array();
                        echo("<fieldset><legend>Изменить предмет</legend>");
                        echo("<form id='form' method='post' action='save_edit.php'>");
                        while ($row=mysqli_fetch_array($result)){
                            for($i = 0; $i < count($row)/2; $i++){
                                if($i == 0){
                                    echo("<input type='hidden' name='id' value='$id'> <br>");
                                } else {
                                $ar =  $row[$i];
                                    echo("Изменить $arrayT[$i]: <input name='$array[$i]' size='50' type='text' value='$ar'> <br>");
                                }
                            }
                        }
                    echo("<input type='hidden' name='index' value='$index'> <br>");
                    echo("<input type='submit' value='Сохранить'/> <br>");
                    echo("</form>");
                    echo("</fieldset>");
                    break;
                    case "vedm_info":
                        $query_2 = "SELECT * FROM $database.$index WHERE id='$id'";
                        $index = "vedm";
                        $queryTab_0 = "stud";
                        $queryTab_1 = "pred";
                         $query_0 = "SELECT * FROM $database.$queryTab_0 ORDER BY $database.$queryTab_0.id ASC";
                        $query_1 = "SELECT * FROM $database.$queryTab_1 ORDER BY $database.$queryTab_1.id ASC";
                        $result_0 = mysqli_query($link, $query_0) or die("Не могу выполнить запрос!");
                        $result_1 = mysqli_query($link, $query_1) or die("Не могу выполнить запрос!");
                        $result_2 = mysqli_query($link, $query_2) or die("Не могу выполнить запрос!");
                        $query = "SELECT * FROM $database.$index WHERE id='$id'";
                        $result = mysqli_query($link, $query) or die ("Ошибка в запросе");
                    
                        $rows = array();
                        while ($row=mysqli_fetch_array($result)){
                            $rows = $row;
                        }
                    
                        $rws = array();
                        while ($row=mysqli_fetch_array($result_2)){
                            $rws = $row;
                        }
                        
                        
                        
                        echo("<fieldset><legend>Изменить</legend>");
                        echo("<form id='form' method='post' action='save_edit.php'>");
                        echo("<input type='hidden' name='id' value='$id'>");
                        echo("Введите дату: <input id='date' type='date' name='date' value='".$rows[1]."'><br>");
                        echo("Введите оценку: <input id='date' type='number' name='ocenka' min='2' max='5' value='".$rows[4]."'><br>");
                        
                        $id_0 = "stud_select";
                        echo("<label for='$id_0'>Список разрешенных характеристик: </label>");
                        echo("<select id='$id_0' name='$id_0'>");
                        echo("<option value=''>--Please choose an option--</option>");
                        while ($row=mysqli_fetch_array($result_0)){
                            if($rws[2]==$row[1]){
                                echo("<option value='$row[0]' selected> №$row[0]|ФИО: $row[1]</option>");
                            } else{
                                echo("<option value='$row[0]'> №$row[0]|ФИО: $row[1]</option>");
                            }
                            
                        }
                        echo("</select><br>");
                        $id_1 = "pred_select";
                        echo("<label for='$id_1'>Список соответствующих значений: </label>");
                        echo("<select id='$id_1' name='$id_1'>");
                        echo("<option value=''>--Please choose an option--</option>");
                    
                        while ($row=mysqli_fetch_array($result_1)){
                            if($rws[3]==$row[1]){
                                echo("<option value='$row[0]' selected> №$row[0]|Предмет: $row[1]|ФИО: $row[2]</option>");
                            } else{
                                echo("<option value='$row[0]'> №$row[0]|Предмет: $row[1]|ФИО: $row[2]</option>");
                            }
                                
                        }
                        echo("</select><br>");
                        echo("<input type='hidden' name='index' value='$index'> <br>");
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