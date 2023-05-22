<?php
// Prepare the SQL query
$queryIdentidad = "
SELECT
tbl_cita.idCita,
tbl_consulado.nombre AS Consulado,
tbl_producto.nombreProducto AS nombreProducto,
tbl_cita.fechaHoraCita AS fechaCita,
tbl_cita.nombre,
tbl_cita.apellido,
tbl_cita.identidad
FROM
tbl_cita
INNER JOIN tbl_producto ON tbl_cita.idProducto = tbl_producto.idProducto
INNER JOIN tbl_consulado ON tbl_cita.idConsulado = tbl_consulado.idConsulado
WHERE
tbl_cita.identidad = :identidad
AND tbl_cita.fechaHoraCita >= CURDATE()
ORDER BY
tbl_cita.fechaHoraCita ASC
";
