<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Compra - KingsCinema</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #2c3e50;
        }
        p {
            color: #555;
            line-height: 1.6;
        }
        .ticket-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .ticket-table th, .ticket-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .ticket-table th {
            background-color: #34495e;
            color: white;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #7f8c8d;
        }
        .qr-container {
            margin: 20px 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .qr-image {
            max-width: 200px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Hola {{ $cliente['name'] }} {{ $cliente['surname'] }}!</h1>
        <p>Gracias por elegir <strong>KingsCinema</strong> para tu experiencia cinematográfica.</p>
        <p>A continuación, encontrarás el código QR para tus entradas. Puedes presentarlo en la entrada del cine.</p>

        <table class="ticket-table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Asiento</th>
                </tr>
            </thead>
            <tbody>
                @for($i = 0; $i < count($seats); $i++)
                <tr>
                    <td>{{ $session['day'] }}</td>
                    <td>{{ $session['hour'] }}</td>
                    <td>{{ $seats[$i] }}</td>
                </tr>
                @endfor
            </tbody>
        </table>

        <div class="qr-container">
            <!-- Placeholder para el código QR generado dinámicamente -->
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQN8Enp-u5_AjM00-hp9CZXYCcfzkSHNiFJtA&s" alt="Código QR de Entradas" class="qr-image">
        </div>

        <div class="footer">
            <p>¡Te esperamos pronto en <strong>KingsCinema</strong> para más películas increíbles!</p>
            <p>Atentamente, <br> Equipo de Atención al Cliente - {{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>
