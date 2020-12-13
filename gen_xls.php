<?require_once 'engine/connection/connectionStart.php';?>
<?require_once 'engine/library/PHPExcel/PHPExcel.php';?>
<?require_once 'engine/library/PHPExcel/PHPExcel/Writer/Excel5.php';?>
<?require_once 'engine/library/PHPExcel/PHPExcel/IOFactory.php'?>
<?
ob_end_clean();
$title = 'Таблица';
$array = array("№ п/п", "ФИО студента", "Факультет", "Группа", "Номер зачетки", "Дата сдачи зачета", "Название предмета", "Оценка", "ФИО Преподавателя");
$xls = new PHPExcel();
$xls->getProperties()->setTitle("Студенты. Зачетная ведомость");
$xls->getProperties()->setSubject("lab5");
$xls->getProperties()->setCreator("Федорова Влада");
$xls->getProperties()->setCompany("USATU");
$xls->getProperties()->setKeywords("Студенты");
$xls->getProperties()->setCreated("1.04.2200");

$xls->setActiveSheetIndex(0);
$sheet = $xls->getActiveSheet();
$sheet->setTitle('Студенты');
$sheet->getPageSetup()->SetPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
$sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$sheet->getPageMargins()->setTop(1);
$sheet->getPageMargins()->setRight(0.75);
$sheet->getPageMargins()->setLeft(0.75);
$sheet->getPageMargins()->setBottom(1);

$sheet->setCellValueExplicit('A1', 'Студенты. Зачетная ведомость.', PHPExcel_Cell_DataType::TYPE_STRING);
$sheet->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('A1:H1');
$sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
for($i = 0; $i < count($array); $i++){
    $sheet->setCellValueByColumnAndRow($i, 2, $array[$i]);
    $sheet->getStyleByColumnAndRow($i, 2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}
$j=3;
$queryTab = "adv_vedm_info";
$query = "SELECT * FROM $database.$queryTab  ORDER BY $database.$queryTab.id ASC";
$result = mysqli_query($link, $query) or die("Не могу выполнить запрос!");
while ($row=mysqli_fetch_array($result)){
    for($i = 0; $i < count($row)/2; $i++){
        $text = $row[$i];
        $sheet->setCellValueByColumnAndRow($i, $j, $text);
        $sheet->getStyleByColumnAndRow($i, $j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);        
    }
$j++;
}
ob_end_clean();
header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
ob_end_clean();
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Студенты.xls");

$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
$objWriter->save('php://output');
ob_end_clean();
?>
<?require_once 'engine/connection/connectionEnd.php';?>