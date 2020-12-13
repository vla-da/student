<?require_once 'engine/page/title.php';?>
<?require_once 'engine/connection/connectionStart.php';?>
<?ob_end_clean();ob_clean();?>
<?require_once 'engine/library/tcpdf/tcpdf.php';?>
<?
    $array = array("№ п/п", "ФИО студента", "Факультет", "Группа", "Номер зачетки", "Дата сдачи зачета", "Название предмета", "Оценка", "ФИО Преподавателя");
    ob_clean();
    error_reporting(E_ALL);
    ob_start();
    $pdf = new TCPDF('L', 'mm', 'A3', true, 'UTF-8');
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetAuthor('Федорова Влада');
    $pdf->SetTitle('Студенты. Зачетная ведомость');
    $pdf->SetMargins(10, 1, 10);
    $pdf->SetFont('arial', '', 10, '', true);
    $pdf->AddPage();
    $pdf->SetXY(10, 10);
    $pdf->SetDrawColor(100, 100, 0);
    $pdf->SetTextColor(000, 0, 0);

    $html = '<h1>Студенты. Зачетная ведомость. </h1><br>';
    $html .= "<table border='1' width='10%'>";
    $html .= "<tr>";
    for($i = 0; $i < count($array); $i++){
        $html .= "<th width='10%'>$array[$i]</th>";
    }
    $html .= "</tr>";
    $queryTab = "adv_vedm_info";
    $query = "SELECT * FROM $database.$queryTab  ORDER BY $database.$queryTab.id ASC";
    $result = mysqli_query($link, $query) or die("Не могу выполнить запрос!");
    while ($row=mysqli_fetch_array($result)){
         $html .= "<tr align='center'>";
        for($i = 0; $i < count($row)/2; $i++){
            $text = $row[$i];
             $html .= "<td>$text</td>";
        }
		 $html .= "</tr>";
    }
    
    $html .= "";
    $html .= "";
    $html .= "</table>";
    
    
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    $pdf->Output('Stud.pdf', 'I');
?>
<?require_once 'engine/connection/connectionEnd.php';?>