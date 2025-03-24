<?php
include_once('tcpdf 6 3_2/tcpdf/tcpdf.php');

$id = $_GET['user_id'];

$inv_mst_query = "SELECT T1.order_id, T1.user_id, T1.invoice_no, T2.fname, T2.contact,
                        T2.username, T3.payment_mode
                        FROM `user_order` T1
                        INNER JOIN `user` T2
                        ON T1.user_id = T2.user_id
                        INNER JOIN `user_payments` T3
                        ON T1.order_id = T3.order_id
                        WHERE T1.user_id = '$id'";

$inv_mst_results = mysqli_query($conn, $inv_mst_query);
$count = mysqli_num_rows($inv_mst_results);

if ($count > 0) {
    $inv_mst_data_row = mysqli_fetch_array($inv_mst_results, MYSQLI_ASSOC);

    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetHeaderData("", "", PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->SetDefaultMonospacedFont('helvetica');
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetAutoPageBreak(TRUE, 10);
    $pdf->SetFont('helvetica', '', 12);
    $pdf->AddPage();

    $content = "";
    $content = '
    <style type="text/css">
    body{
        font-size:12px;
        line-height:24px;
        font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
        color:#000;
    }
    </style>
    <table cellpadding="0" cellspacing="0" style="border: 1px solid #ddd; width: 100%;">
        <table style="width: 100%;">
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr><td colspan="2" align="center"><b>LIFESTYLE ZONE</b></td></tr>
            <tr><td colspan="2" align="center"><b>CONTACT:7972431956</b></td></tr>
            <tr><td colspan="2" align="center"><b>WEBSITE: WWW.LIFESTYLE.COM</b></td></tr>
            <tr><td colspan="2"><b>INVOICE</b></td></tr>
            <tr>
                <td><b>INVOICE No:</b></td>
                <td align="right">' . $inv_mst_data_row['invoice_no'] . '</td>
            </tr>
            <tr>
                <td><b>ORDER ID:</b></td>
                <td align="right">' . $inv_mst_data_row['order_id'] . '</td>
            </tr>
            <tr>
                <td><b>CUSTOMER NAME:</b></td>
                <td align="right">' . $inv_mst_data_row['fname'] . '</td>
            </tr>
            <tr>
                <td><b>CONTACT NO:</b></td>
                <td align="right">' . $inv_mst_data_row['contact'] . '</td>
            </tr>
        </table>
    </table>';

    $inv_det_query = "SELECT T1.*, T2.*
                        FROM `user_order` T1
                        INNER JOIN `user_payments` T2
                        ON T1.order_id = T2.order_id
                        WHERE T1.user_id = '$id'";

    $inv_det_results = mysqli_query($conn, $inv_det_query);
    $inv_det_count = mysqli_num_rows($inv_det_results);
    $total = 0;

    if ($inv_det_count > 0) {
        $content .= '<br><br>
        <table cellpadding="0" cellspacing="0" style="border: 1px solid #ddd; width: 100%;">
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr style="background-color:#ddd;">
                <td><b>PRODUCT NAME</b></td>
                <td align="right"><b>PRICE</b></td>
            </tr>';

        while ($inv_det_data_row = mysqli_fetch_array($inv_det_results, MYSQLI_ASSOC)) {
            $content .= '<tr>
                <td>' . $inv_det_data_row['total_products'] . '</td>
                <td align="right">' . $inv_det_data_row['due_amount'] . '</td>
            </tr>';
            $total = $total + $inv_det_data_row['due_amount'];
        }

        $content .= '<tr class="total">
            <td colspan="2" align="right"></td>
        </tr>
        <tr>
            <td colspan="2" align="right"><b>GRAND&nbsp; TOTAL:&nbsp;' . $total . '</b></td>
        </tr>
        <tr>
            <td colspan="2" align="right">---------------</td>
        </tr>
        <tr>
            <td colspan="2" align="right"><b>PAYMENT MODE: ' . $inv_mst_data_row['payment_mode'] . '</b></td>
        </tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td colspan="2" align="center"><b>THANK YOU! VISIT AGAIN</b></td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
    </table>
    </table>';
    }

    $pdf->writeHTML($content);
    $file_location = "/opt/lampp/htdocs/examples/generate_pdf/uploads/";  //Modify this path as needed
    $datetime = date('dmY_his');
    $file_name = "INV_" . $datetime . ".pdf";
    ob_end_clean();

    if ($_GET['ACTION'] == 'VIEW') {
        $pdf->Output($file_name, 'I'); // I means Inline view
    } else if ($_GET['ACTION'] == 'DOWNLOAD') {
        $pdf->Output($file_name, 'D'); // D means Download
    }
}
?>