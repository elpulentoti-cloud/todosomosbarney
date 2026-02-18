<?php
/* =========================================================
   SISTEMA UNIVERSAL DE DIAGNÓSTICO FINANCIERO
   - Funciona en cualquier moneda
   - Todos los valores deben estar en la misma moneda
   - Incluye ejemplo de empresa saludable
========================================================= */
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Diagnóstico Financiero</title>

<style>

:root{
--azul:#0b1c2d;
--dorado:#c6a85e;
--verde:#1f7a3e;
--naranja:#b36b00;
--rojo:#a10d0d;
}

body{
margin:0;
font-family:Arial, sans-serif;
background:var(--azul);
color:white;
}

.container{
max-width:1000px;
margin:auto;
padding:20px;
}

.panel{
background:white;
color:#222;
padding:25px;
border-radius:8px;
box-shadow:0 0 20px rgba(0,0,0,0.4);
}

h1{
text-align:center;
color:var(--dorado);
}

h2{
border-left:5px solid var(--dorado);
padding-left:10px;
margin-top:30px;
}

input{
width:100%;
padding:8px;
margin-top:5px;
margin-bottom:10px;
border:1px solid #ccc;
border-radius:4px;
}

small{
color:#555;
display:block;
margin-bottom:15px;
}

button{
background:var(--dorado);
color:black;
padding:12px;
border:none;
width:100%;
font-weight:bold;
border-radius:4px;
cursor:pointer;
margin-top:15px;
}

.resultado{
margin-top:25px;
padding:20px;
border-radius:6px;
}

.verde{border-left:8px solid var(--verde);}
.naranja{border-left:8px solid var(--naranja);}
.rojo{border-left:8px solid var(--rojo);}

.simbolo{
text-align:center;
font-size:22px;
color:var(--dorado);
margin-bottom:10px;
}

@media(max-width:768px){
.container{padding:10px;}
}

</style>
</head>
<body>

<div class="container">

<h1>✦ DIAGNÓSTICO FINANCIERO UNIVERSAL ✦</h1>

<div class="panel">

<p><b>Instrucciones:</b>  
Los cálculos funcionan en cualquier moneda.  
Solo asegúrese de ingresar todos los valores en la misma moneda.</p>

<form method="post">

<h2>▢ Estado de Resultados</h2>

Ventas Totales:
<input type="number" name="ventas" value="1000000" required>
<small>Total facturado en el año. Documento: Estado de Resultados → línea “Ventas” o “Ingresos”.</small>

Costo de Ventas:
<input type="number" name="costo" value="550000" required>
<small>Costos directos de producción o mercadería vendida.</small>

Gastos Operativos:
<input type="number" name="gastos_op" value="250000" required>
<small>Sueldos, arriendo, servicios, administración.</small>

Depreciación:
<input type="number" name="depreciacion" value="30000" required>
<small>Pérdida contable de activos (no es salida de caja).</small>

<h2>△ Financiamiento</h2>

Gastos Financieros:
<input type="number" name="gastos_fin" value="20000" required>
<small>Intereses pagados por préstamos.</small>

Productos Financieros:
<input type="number" name="prod_fin" value="2000" required>
<small>Intereses ganados o rendimientos financieros.</small>

<h2>◯ Balance General</h2>

Activo Circulante:
<input type="number" name="ac" value="400000" required>
<small>Caja + bancos + clientes + inventarios.</small>

Pasivo Circulante:
<input type="number" name="pc" value="250000" required>
<small>Deudas que vencen en menos de 1 año.</small>

<h2>✦ Ciclo de Efectivo</h2>

Días Inventario:
<input type="number" name="dri" value="30" required>

Días Cobro:
<input type="number" name="drc" value="20" required>

Días Pago:
<input type="number" name="drp" value="35" required>

<button type="submit">Analizar Empresa</button>

</form>

<?php
if ($_POST){

$ventas = $_POST['ventas'];
$costo = $_POST['costo'];
$gastos_op = $_POST['gastos_op'];
$depreciacion = $_POST['depreciacion'];
$gastos_fin = $_POST['gastos_fin'];
$prod_fin = $_POST['prod_fin'];
$ac = $_POST['ac'];
$pc = $_POST['pc'];
$dri = $_POST['dri'];
$drc = $_POST['drc'];
$drp = $_POST['drp'];

/* ===== Cálculos ===== */

$utilidad_bruta = $ventas - $costo;
$ebitda = $utilidad_bruta - $gastos_op;
$ebit = $ebitda - $depreciacion;
$ebt = $ebit + $prod_fin - $gastos_fin;
$capital_trabajo = $ac - $pc;
$ciclo = $dri + $drc - $drp;

$margen = ($ventas!=0)?($ebitda/$ventas)*100:0;
$liquidez = ($pc!=0)?$ac/$pc:0;
$cobertura = ($gastos_fin!=0)?$ebit/$gastos_fin:0;

/* ===== Diagnóstico ===== */

$riesgo="Empresa Estable";
$clase="verde";

if($ebt<0 || $liquidez<1 || $cobertura<1){
$riesgo="Riesgo Financiero Alto";
$clase="rojo";
}
elseif($margen<10 || $liquidez<1.3){
$riesgo="Zona de Atención";
$clase="naranja";
}
?>

<div class="resultado <?= $clase ?>">

<div class="simbolo">▢ △ ◯ ✦</div>

<b>Utilidad Operativa (EBITDA):</b> <?= number_format($ebitda,2) ?><br>
<small>Capacidad real de generar dinero con la operación.</small><br><br>

<b>Resultado antes de impuestos:</b> <?= number_format($ebt,2) ?><br>
<small>Si es negativo, la empresa pierde dinero.</small><br><br>

<b>Capital de Trabajo:</b> <?= number_format($capital_trabajo,2) ?><br>
<small>Si es negativo, existe riesgo de liquidez.</small><br><br>

<b>Liquidez:</b> <?= round($liquidez,2) ?><br>
<small>Menor a 1 indica riesgo de insolvencia.</small><br><br>

<b>Cobertura de Deuda:</b> <?= round($cobertura,2) ?><br>
<small>Menor a 1 significa que la empresa no cubre intereses con operación.</small><br><br>

<b>Ciclo de Efectivo:</b> <?= $ciclo ?> días<br>
<small>Tiempo que tarda en recuperar el dinero invertido.</small><br><br>

<h2>Diagnóstico: <?= $riesgo ?></h2>

</div>

<?php } ?>

</div>
</div>

</body>
</html>
