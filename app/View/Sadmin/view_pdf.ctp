<?php
App::import('Vendor','xtcpdf');
$tcpdf = new XTCPDF();
$textfont = 'courier';

$tcpdf->SetAuthor("KBS Homes & Properties at http://kbs-properties.com");
$tcpdf->SetAutoPageBreak( false );
$tcpdf->setHeaderFont(array($textfont,'',40));
$tcpdf->xheadercolor = array(255, 255, 255);
$tcpdf->xheadertext = '';
$tcpdf->xfootertext = '%s';

// add a page (required with recent versions of tcpdf)
$tcpdf->AddPage();

// Now you position and print your page content
// example:
$tcpdf->SetTextColor(0, 0, 0);
$tcpdf->SetFont($textfont,'B',12);


// create some HTML content
$html = "
<h1>Reporte de Equipos</h1>

<table border='1' cellspacing='3' cellpadding='4'>
            <tr>
                <th>Nombre del Equipo</th>
                <th>Delegado</th>
                <th>Status</th>
                <th>Deporte</th>
                <th>Categoria</th>
                <th>Periodo</th>
            </tr>";


foreach ($teams as $team):
    $html=$html."<tr>
    <td>".
    $team['Team']['name'].'</td>
        <td>'.$team['std']['name'].'</td>
        <td>';

            switch ($team['Team']['status']){
                case 1:
                    $html=$html.'Sin Asignar';
                    break;
                case 2:
                    $html=$html.'Campeones';
                    break;
                case 3:
                    $html=$html.'Segunda Etapa';
                    break;
                case 4:
                    $html=$html.'No clasifico';
                    break;
                case 5:
                    $html=$html.'Baja por default';
                    break;
                case 6:
                    $html=$html.'Baja por reglamento';
                    break;
            }

    $html=$html.'</td>
        <td>'.$team['sprt']['name'].'</td>
        <td>'.$team['sprt']['category'].'</td>
        <td>'.$team['prd']['period'].'</td>
        </tr>';

        endforeach;
        unset($team);

$html=$html.'
</table>';


// output the HTML content
$tcpdf->writeHTML($html, true, false, true, false, '');


echo $tcpdf->Output('Reporte.pdf', 'D');
