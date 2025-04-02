<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a SmartOrder</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .welcome-container {
            background: rgba(0, 0, 0, 0.6);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }
        .welcome-title {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .welcome-text {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        .btn-menu {
            font-size: 1.2rem;
            padding: 10px 20px;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            color: #fff;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }
        .btn-menu:hover {
            background-color: #218838;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1 class="welcome-title">¡Bienvenido a SmartOrder!</h1>
        <p class="welcome-text">Disfruta de una experiencia única al ordenar tus platos favoritos. Haz clic en el botón de abajo para comenzar.</p>
        <a href="{{ route('menu') }}" class="btn btn-menu">Ir al Menú</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>