<?php
require 'fpdf/fpdf.php';

include_once "Connections/cedulas.php";

$cve_emp = $_GET['recordID'];

try {
    $sql = "SELECT e.nombre, g.grado, e.puesto, n.nivel, p.puesto AS nomPuesto, e.departamento AS depto, d.departamento, e.vigencia, d.abreviatura
    FROM empleados e
    JOIN grados g
    ON e.grado = g.Id
    JOIN puestos p
    ON e.puesto = p.Id
    JOIN departamentos d
    ON e.departamento = d.cve_depto
    JOIN niveles n
    ON e.nivel = n.Id
    WHERE e.Id = ?";
    $ced = $conexion->prepare($sql);
    $ced->execute(array($cve_emp));
    $cedulas = $ced->fetch(PDO::FETCH_ASSOC);

    $nivel = $cedulas['nivel'];
} catch (PDOException $e) {
    echo $e->getMessage();
}

class PDF extends FPDF
{
    public function Header()
    {
        $this->Image('assets/images/Logo_EdoMex.png', 10, 5, 22);
        $this->Image('assets/images/Logo_Carta.gif', 145, 9, 60);
        $this->SetFont('Arial', 'B', 12);
        $this->Ln(12);
        $this->Cell(195, 10, utf8_decode('CEDULA DE FACULTADES Y REGISTRO DE FIRMA'), 1, 1, 'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Ln(2);
        $this->Cell(195, 10.5, '', 1, 1, 'C');
        $this->SetXY(12, 35);
        $this->Cell(50, 5, 'UNIDAD ORGANICA:', 0, 1, 'L');
        $this->SetXY(170, 35);
        $this->Cell(15, 5, 'No. facultades', 0, 1, 'L');
        $this->SetXY(31.5, 39.5);
        $this->Cell(50, 5, 'PUESTO:', 0, 1, 'L');

        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(10, 46.5);
        $this->Cell(10, 5, 'No.', 1, 1, 'C');
        $this->SetXY(20, 46.5);
        $this->Cell(87.5, 5, 'FACULTAD', 1, 1, 'C');
        $this->SetXY(107.4, 46.5);
        $this->Cell(97.5, 5, 'REFERENCIA NORMATIVA', 1, 1, 'C');
    }

    public function Footer()
    {
        global $nivel;
        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(10, -63);
        $this->Cell(26, 5, 'VIGENCIA', 1, 1, 'C');
        $this->SetXY(37, -63);
        $this->Cell(70, 5, 'NOMBRE DEL ' . $nivel, 1, 1, 'C');
        $this->SetXY(108, -63);
        $this->Cell(48, 5, 'FIRMA', 1, 1, 'C');
        $this->SetXY(157, -63);
        $this->Cell(48, 5, 'ANTEFIRMA', 1, 1, 'C');
        $this->SetXY(108, -57);
        $this->Cell(48, 20, '', 1, 1, 'C');
        $this->SetXY(157, -57);
        $this->Cell(48, 20, '', 1, 1, 'C');
        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(10, -36);
        $this->Cell(146, 5, 'MANUAL DE FACTULTADES Y REGISTRO DE FIRMA', 1, 1, 'C');
        $this->SetXY(157, -36);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(48, 5, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 1, 1, 'C');
        $this->SetXY(10, -30);
        $this->SetFont('Arial', 'I', 6);
        $this->MultiCell(195, 5, utf8_decode('NOTA: El original de este documento obra en poder de la UNIDAD DE MODERNIZACION ADMINISTRATIVA, por lo que queda prohibido su reproducción, alteración o uso inadecuado, lo que será sancionado de acuerdo a la norvatividad vigente.'), 0, 'L');
    }
}

$pdf = new PDF('P', 'mm', array(220, 280));
$pdf->AliasNbPages();

$Y = 51.6;
$conteo = 0;

for ($i = 1; $i <= 52; $i++) {
    $sqlPf = "SELECT f.clave, f.facultad, f.referencia, d.fac_$i FROM departamentos d JOIN facultades f ON d.fac_$i = f.clave WHERE d.cve_depto = ?";
    $pf = $conexion->prepare($sqlPf);
    $pf->execute(array($cedulas['depto']));
    $pfac = $pf->fetch(PDO::FETCH_ASSOC);

    if ($pfac['fac_' . $i] != null) {
        $conteo = $conteo + 1;
    }
}

for ($i = 1; $i <= 52; $i++) {
    $sqlPf = "SELECT f.clave, f.facultad, f.referencia, d.fac_$i FROM departamentos d JOIN facultades f ON d.fac_$i = f.clave WHERE d.cve_depto = ?";
    $pf = $conexion->prepare($sqlPf);
    $pf->execute(array($cedulas['depto']));
    $pfac = $pf->fetch(PDO::FETCH_ASSOC);

    if ($pfac['fac_' . $i] != null) {
        if ($i == 1) {
            $pdf->AddPage();
            $Y = 51.6;
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(48, 35);
            if ($cedulas['abreviatura'] != null) {
                $pdf->Cell(50, 5, utf8_decode($cedulas['departamento'] . " / " . $cedulas['abreviatura']), 0, 1, 'L');
            } else {
                $pdf->Cell(50, 5, utf8_decode($cedulas['departamento']), 0, 1, 'L');
            }
            $pdf->SetXY(48, 39.5);
            $pdf->Cell(50, 5, utf8_decode($cedulas['nomPuesto'] . " (" . $cedulas['nivel'] . ") "), 0, 1, 'L');
            $pdf->SetXY(170, 39.5);
            $pdf->Cell(30, 5, $conteo, 0, 1, 'C');
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, -57);
            $pdf->Cell(26, 20, utf8_decode($cedulas['vigencia']), 1, 1, 'C');
            $pdf->SetXY(37, -57);
            $pdf->Cell(70, 20, utf8_decode($cedulas['grado'] . " " . $cedulas['nombre']), 1, 1, 'C');
        }

        if ($i >= 1 && $i <= 8) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, $Y);
            $pdf->Cell(10, 20, $i, 1, 1, 'C');
            $pdf->SetXY(20, $Y);
            $pdf->Cell(87.5, 20, '', 1, 1, 'C');
            $pdf->SetXY(20, $Y);
            $pdf->MultiCell(87.5, 5, utf8_decode($pfac['facultad']), 0, 'L');
            $pdf->SetXY(107.4, $Y);
            $pdf->Cell(97.5, 20, '', 1, 1, 'C');
            $pdf->SetXY(107.4, $Y);
            $pdf->MultiCell(97.5, 5, utf8_decode($pfac['referencia']), 0, 'L');
            $Y = $Y + 20;
        }

        if ($i == 9) {
            $pdf->AddPage();
            $Y = 51.6;
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(48, 35);
            if ($cedulas['abreviatura'] != null) {
                $pdf->Cell(50, 5, utf8_decode($cedulas['departamento'] . " / " . $cedulas['abreviatura']), 0, 1, 'L');
            } else {
                $pdf->Cell(50, 5, utf8_decode($cedulas['departamento']), 0, 1, 'L');
            }
            $pdf->SetXY(48, 39.5);
            $pdf->Cell(50, 5, utf8_decode($cedulas['nomPuesto'] . " (" . $cedulas['nivel'] . ") "), 0, 1, 'L');
            $pdf->SetXY(170, 39.5);
            $pdf->Cell(30, 5, $conteo, 0, 1, 'C');
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, -57);
            $pdf->Cell(26, 20, utf8_decode($cedulas['vigencia']), 1, 1, 'C');
            $pdf->SetXY(37, -57);
            $pdf->Cell(70, 20, utf8_decode($cedulas['grado'] . " " . $cedulas['nombre']), 1, 1, 'C');
        }

        if ($i >= 9 && $i <= 16) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, $Y);
            $pdf->Cell(10, 20, $i, 1, 1, 'C');
            $pdf->SetXY(20, $Y);
            $pdf->Cell(87.5, 20, '', 1, 1, 'C');
            $pdf->SetXY(20, $Y);
            $pdf->MultiCell(87.5, 5, utf8_decode($pfac['facultad']), 0, 'L');
            $pdf->SetXY(107.4, $Y);
            $pdf->Cell(97.5, 20, '', 1, 1, 'C');
            $pdf->SetXY(107.4, $Y);
            $pdf->MultiCell(97.5, 5, utf8_decode($pfac['referencia']), 0, 'L');
            $Y = $Y + 20;
        }

        if ($i == 17) {
            $pdf->AddPage();
            $Y = 51.6;
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(48, 35);
            if ($cedulas['abreviatura'] != null) {
                $pdf->Cell(50, 5, utf8_decode($cedulas['departamento'] . " / " . $cedulas['abreviatura']), 0, 1, 'L');
            } else {
                $pdf->Cell(50, 5, utf8_decode($cedulas['departamento']), 0, 1, 'L');
            }
            $pdf->SetXY(48, 39.5);
            $pdf->Cell(50, 5, utf8_decode($cedulas['nomPuesto'] . " (" . $cedulas['nivel'] . ") "), 0, 1, 'L');
            $pdf->SetXY(170, 39.5);
            $pdf->Cell(30, 5, $conteo, 0, 1, 'C');
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, -57);
            $pdf->Cell(26, 20, utf8_decode($cedulas['vigencia']), 1, 1, 'C');
            $pdf->SetXY(37, -57);
            $pdf->Cell(70, 20, utf8_decode($cedulas['grado'] . " " . $cedulas['nombre']), 1, 1, 'C');
        }

        if ($i >= 17 && $i <= 24) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, $Y);
            $pdf->Cell(10, 20, $i, 1, 1, 'C');
            $pdf->SetXY(20, $Y);
            $pdf->Cell(87.5, 20, '', 1, 1, 'C');
            $pdf->SetXY(20, $Y);
            $pdf->MultiCell(87.5, 5, utf8_decode($pfac['facultad']), 0, 'L');
            $pdf->SetXY(107.4, $Y);
            $pdf->Cell(97.5, 20, '', 1, 1, 'C');
            $pdf->SetXY(107.4, $Y);
            $pdf->MultiCell(97.5, 5, utf8_decode($pfac['referencia']), 0, 'L');
            $Y = $Y + 20;
        }

        if ($i == 25) {
            $pdf->AddPage();
            $Y = 51.6;
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(48, 35);
            if ($cedulas['abreviatura'] != null) {
                $pdf->Cell(50, 5, utf8_decode($cedulas['departamento'] . " / " . $cedulas['abreviatura']), 0, 1, 'L');
            } else {
                $pdf->Cell(50, 5, utf8_decode($cedulas['departamento']), 0, 1, 'L');
            }
            $pdf->SetXY(48, 39.5);
            $pdf->Cell(50, 5, utf8_decode($cedulas['nomPuesto'] . " (" . $cedulas['nivel'] . ") "), 0, 1, 'L');
            $pdf->SetXY(170, 39.5);
            $pdf->Cell(30, 5, $conteo, 0, 1, 'C');
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, -57);
            $pdf->Cell(26, 20, utf8_decode($cedulas['vigencia']), 1, 1, 'C');
            $pdf->SetXY(37, -57);
            $pdf->Cell(70, 20, utf8_decode($cedulas['grado'] . " " . $cedulas['nombre']), 1, 1, 'C');
        }

        if ($i >= 25 && $i <= 32) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, $Y);
            $pdf->Cell(10, 20, $i, 1, 1, 'C');
            $pdf->SetXY(20, $Y);
            $pdf->Cell(87.5, 20, '', 1, 1, 'C');
            $pdf->SetXY(20, $Y);
            $pdf->MultiCell(87.5, 5, utf8_decode($pfac['facultad']), 0, 'L');
            $pdf->SetXY(107.4, $Y);
            $pdf->Cell(97.5, 20, '', 1, 1, 'C');
            $pdf->SetXY(107.4, $Y);
            $pdf->MultiCell(97.5, 5, utf8_decode($pfac['referencia']), 0, 'L');
            $Y = $Y + 20;
        }

        if ($i == 33) {
            $pdf->AddPage();
            $Y = 51.6;
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(48, 35);
            if ($cedulas['abreviatura'] != null) {
                $pdf->Cell(50, 5, utf8_decode($cedulas['departamento'] . " / " . $cedulas['abreviatura']), 0, 1, 'L');
            } else {
                $pdf->Cell(50, 5, utf8_decode($cedulas['departamento']), 0, 1, 'L');
            }
            $pdf->SetXY(48, 39.5);
            $pdf->Cell(50, 5, utf8_decode($cedulas['nomPuesto'] . " (" . $cedulas['nivel'] . ") "), 0, 1, 'L');
            $pdf->SetXY(170, 39.5);
            $pdf->Cell(30, 5, $conteo, 0, 1, 'C');
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, -57);
            $pdf->Cell(26, 20, utf8_decode($cedulas['vigencia']), 1, 1, 'C');
            $pdf->SetXY(37, -57);
            $pdf->Cell(70, 20, utf8_decode($cedulas['grado'] . " " . $cedulas['nombre']), 1, 1, 'C');
        }

        if ($i >= 33 && $i <= 40) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, $Y);
            $pdf->Cell(10, 20, $i, 1, 1, 'C');
            $pdf->SetXY(20, $Y);
            $pdf->Cell(87.5, 20, '', 1, 1, 'C');
            $pdf->SetXY(20, $Y);
            $pdf->MultiCell(87.5, 5, utf8_decode($pfac['facultad']), 0, 'L');
            $pdf->SetXY(107.4, $Y);
            $pdf->Cell(97.5, 20, '', 1, 1, 'C');
            $pdf->SetXY(107.4, $Y);
            $pdf->MultiCell(97.5, 5, utf8_decode($pfac['referencia']), 0, 'L');
            $Y = $Y + 20;
        }

        if ($i == 41) {
            $pdf->AddPage();
            $Y = 51.6;
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(48, 35);
            if ($cedulas['abreviatura'] != null) {
                $pdf->Cell(50, 5, utf8_decode($cedulas['departamento'] . " / " . $cedulas['abreviatura']), 0, 1, 'L');
            } else {
                $pdf->Cell(50, 5, utf8_decode($cedulas['departamento']), 0, 1, 'L');
            }
            $pdf->SetXY(48, 39.5);
            $pdf->Cell(50, 5, utf8_decode($cedulas['nomPuesto'] . " (" . $cedulas['nivel'] . ") "), 0, 1, 'L');
            $pdf->SetXY(170, 39.5);
            $pdf->Cell(30, 5, $conteo, 0, 1, 'C');
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, -57);
            $pdf->Cell(26, 20, utf8_decode($cedulas['vigencia']), 1, 1, 'C');
            $pdf->SetXY(37, -57);
            $pdf->Cell(70, 20, utf8_decode($cedulas['grado'] . " " . $cedulas['nombre']), 1, 1, 'C');
        }

        if ($i >= 41 && $i <= 48) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, $Y);
            $pdf->Cell(10, 20, $i, 1, 1, 'C');
            $pdf->SetXY(20, $Y);
            $pdf->Cell(87.5, 20, '', 1, 1, 'C');
            $pdf->SetXY(20, $Y);
            $pdf->MultiCell(87.5, 5, utf8_decode($pfac['facultad']), 0, 'L');
            $pdf->SetXY(107.4, $Y);
            $pdf->Cell(97.5, 20, '', 1, 1, 'C');
            $pdf->SetXY(107.4, $Y);
            $pdf->MultiCell(97.5, 5, utf8_decode($pfac['referencia']), 0, 'L');
            $Y = $Y + 20;
        }

        if ($i == 49) {
            $pdf->AddPage();
            $Y = 51.6;
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(48, 35);
            if ($cedulas['abreviatura'] != null) {
                $pdf->Cell(50, 5, utf8_decode($cedulas['departamento'] . " / " . $cedulas['abreviatura']), 0, 1, 'L');
            } else {
                $pdf->Cell(50, 5, utf8_decode($cedulas['departamento']), 0, 1, 'L');
            }
            $pdf->SetXY(48, 39.5);
            $pdf->Cell(50, 5, utf8_decode($cedulas['nomPuesto'] . " (" . $cedulas['nivel'] . ") "), 0, 1, 'L');
            $pdf->SetXY(170, 39.5);
            $pdf->Cell(30, 5, $conteo, 0, 1, 'C');
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, -57);
            $pdf->Cell(26, 20, utf8_decode($cedulas['vigencia']), 1, 1, 'C');
            $pdf->SetXY(37, -57);
            $pdf->Cell(70, 20, utf8_decode($cedulas['grado'] . " " . $cedulas['nombre']), 1, 1, 'C');
        }

        if ($i >= 49 && $i <= 52) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, $Y);
            $pdf->Cell(10, 20, $i, 1, 1, 'C');
            $pdf->SetXY(20, $Y);
            $pdf->Cell(87.5, 20, '', 1, 1, 'C');
            $pdf->SetXY(20, $Y);
            $pdf->MultiCell(87.5, 5, utf8_decode($pfac['facultad']), 0, 'L');
            $pdf->SetXY(107.4, $Y);
            $pdf->Cell(97.5, 20, '', 1, 1, 'C');
            $pdf->SetXY(107.4, $Y);
            $pdf->MultiCell(97.5, 5, utf8_decode($pfac['referencia']), 0, 'L');
            $Y = $Y + 20;
        }
    }
}

$pdf->Output();
