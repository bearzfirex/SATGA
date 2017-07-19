<?php
function generar_arreglo_fechas($fecha_inicial,$fecha_final)
{
	// Bucle para generar un arreglo con las fechas
	$j=0;
	for ($i=$fecha_inicial; $i<=$fecha_final; $i+=86400)
	{
		$fecha["$j"] = date("d/m/Y", $i);
		$j++;
	}
	return $fecha;
}
?>