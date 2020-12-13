<?require_once 'engine/page/title.php';?>
<?require_once 'engine/connection/connectionStart.php';?>
<?require_once 'engine/class/table.php';?>
<html>
    <body>
        <?
            echo("<div>");
            $queryTab = "stud";
            $headText = "Таблица студентов";
            $arrayTitle = array("№", "ФИО", "Факультет", "Группа", "Номер зачетки", "Телефон", "Изменить", "Добавить");
            $query = "SELECT * FROM $database.$queryTab  ORDER BY $database.$queryTab.id ASC";
            $result = mysqli_query($link, $query) or die("Не могу выполнить запрос!");
            echo("<div>");
            $a = new Table($headText, $arrayTitle, $result, $queryTab, true);
            echo("</div>");
            echo("<div> <a href='/lab5/new.php?Index="."stud"."'> Добавить нового студента</a> </div>");
            $queryTab = "pred";
            $headText = "Таблица предметов";
            $arrayTitle = array("№", "Название предмета", "ФИО преподавателя", "Изменить", "Добавить");
            $query = "SELECT * FROM $database.$queryTab  ORDER BY $database.$queryTab.id ASC";
            $result = mysqli_query($link, $query) or die("Не могу выполнить запрос!");
            echo("<div>");
            $a = new Table($headText, $arrayTitle, $result, $queryTab, true);
            echo("</div>");
            echo("<div> <a href='/lab5/new.php?Index="."pred"."'> Добавить новый предмет</a> </div>");
            $queryTab = "vedm_info";
            $headText = "Таблица зачетная ведомость";
            $arrayTitle = array("№", "Дата сдачи зачета", "ФИО студента", "Название предмета", "Оценка", "Изменить", "Добавить");
            $query = "SELECT * FROM $database.$queryTab  ORDER BY $database.$queryTab.id ASC";
            $result = mysqli_query($link, $query) or die("Не могу выполнить запрос!");
            echo("<div>");
            $a = new Table($headText, $arrayTitle, $result, $queryTab, true);
            echo("</div>");
            echo("<div> <a href='/lab5/new.php?Index="."vedm"."'> Добавить новую зачетную ведомость</a> </div>");
            echo("</div>");
            
            echo("<div>");
            echo("<div>");
            
            
            
            echo("</div>");
            echo("<div><br></div>");
            echo("<div>");
            echo("<div> <a href='/lab5/gen_pdf.php'> Открыть PDF - файл </a> </div>");
            echo("<div> <a href='/lab5/gen_xls.php'> Загрузить XLS - файл </a> </div>");
            echo("</div>");
            echo("</div>");
        ?>
    </body>
</html>
<?require_once 'engine/connection/connectionEnd.php';?>