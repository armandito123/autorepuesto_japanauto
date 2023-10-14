<!--MENSAJE DE CORREO QUE VERÁ EL DESTINATARIO-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Correo a Destinatario</title>
</head>
<body>
    <!--CUERPO DEL CORREO QUE SE MOSTRARÁ EN EL SERVIDOR DE CORREO-->
    <center><h1><strong style="color: rgb(168, 3, 3)">Detalle del Correo</strong></h1></center>
    <p><strong>Nombre: </strong> {{$contacto['nombre']}} </p> <!-- Nombre: Mauricio Reyes -->
    <p><strong>Correo Remitente: </strong> {{$contacto['correo_remitente']}} </p> <!-- Correo Remitente: mauricio@correo.autorepuesto.com -->
    <p><strong>Mensaje: </strong> {{$contacto['mensaje']}} </p><!-- Mensaje: hola este es un mensaje de prueba -->
    
</body>
</html>