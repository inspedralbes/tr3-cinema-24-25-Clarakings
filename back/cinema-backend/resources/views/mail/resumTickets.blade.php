<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo de Confirmación de Compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
        }
        p {
            color: #666666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 20px;
            color: #999999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Estimado, {{ $cliente['first_name'] }} {{ $cliente['last_name'] }}, cliente de CineVilla!</h1>
        <br>
        <p>Gracias por escoger nuestro cine local para disfrutar de una tarde espectacular.</p>
        <br>
        <p>Adjunto a este correo electrónico, encontrarás un archivo PDF detallando los elementos adquiridos. Por favor, revisa los detalles cuidadosamente para asegurarte de que todo es correcto. Si encuentras alguna discrepancia o tienes alguna pregunta sobre tu compra, no dudes en ponerte en contacto con nuestro equipo de atención al cliente. Estaremos encantados de ayudarte en todo lo que necesites.</p>
        <br>
        <table>
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
        {{-- <p>Precio total: ${{ $totalPrice }}</p> --}}
        <br>
        <p>Gracias de nuevo por tu compra. Esperamos verte pronto en CineVilla para satisfacer tus futuras necesidades cinemáticas. ¡Ten un gran día!</p>
        <br>
        <div class="footer">
            <p>Atentamente,</p>
            <p>Servicio al cliente de {{ config('app.name') }}.</p>
        </div>
    </div>
</body>
</html>
