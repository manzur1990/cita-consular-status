<?php
// Prepare the SQL query
$queryIdentidad = "
    SELECT
        tbl_cita.idCita,
        tbl_cita.fechaNacimiento,
        tbl_consulado.nombre AS Consulado,
        tbl_producto.nombreProducto AS nombreProducto,
        tbl_cita.fechaHoraCita AS horaCita,
        tbl_cita.nombre,
        tbl_cita.apellido,
        tbl_cita.identidad,
        tbl_horario_consulado.horaFinal AS horaAtencion,
        tbl_cita.estado AS estado,
        tbl_usuario.nombre AS agente
    FROM
        tbl_cita
        INNER JOIN tbl_usuario ON tbl_cita.idUsuarioCI = tbl_usuario.idUsuario
        INNER JOIN tbl_producto ON tbl_cita.idProducto = tbl_producto.idProducto
        INNER JOIN tbl_horario_consulado ON tbl_cita.idHorarioConsulado = tbl_horario_consulado.idHorarioConsulado
        INNER JOIN tbl_consulado ON tbl_cita.idConsulado = tbl_consulado.idConsulado
    WHERE
        tbl_cita.identidad = :identidad
    ORDER BY
        tbl_horario_consulado.horaFinal ASC";
