<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesas Disponibles</title>
</head>
<body>
    <h1>Selecciona una Mesa</h1>
    <ul>
        @foreach($mesas as $mesa)
            <li>Mesa {{ $mesa['id'] }} - {{ $mesa['estado'] }}</li>
        @endforeach
    </ul>
</body>
</html>
