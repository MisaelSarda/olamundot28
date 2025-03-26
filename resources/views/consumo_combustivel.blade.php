@extends('layout.app')
@section('Combustível')
@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Calculadora de Consumo de Combustível</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg,rgb(251, 252, 253),rgb(248, 251, 252));
            margin: 0;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input, select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }
        input[type="submit"] {
            background: #007BFF;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            border: none;
        }
        input[type="submit"]:hover {
            background: #0056b3;
        }
        .resultado {
            margin-top: 20px;
            background:rgb(172, 233, 114);
            padding: 15px;
            border-radius: 8px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Calculadora de Consumo de Combustível</h2>
        <form method="POST" action="{{ url('/consumo-combustivel') }}">
            @csrf
            <label for="distancia">Distância percorrida (km):</label>
            <input type="number" name="distancia" step="0.1" min="0" required>
            
            <label for="combustivel">Combustível consumido (litros):</label>
            <input type="number" name="combustivel" step="0.1" min="0" required>
            
            <label for="tipo_combustivel">Tipo de combustível:</label>
            <select name="tipo_combustivel" required>
                <option value="gasolina">Gasolina</option>
                <option value="alcool">Álcool</option>
                <option value="diesel">Diesel</option>
            </select>
            
            <label for="valor_combustivel">Valor do combustível (por litro):</label>
            <input type="number" name="valor_combustivel" step="0.01" min="0" required>
            
            <input type="submit" value="Calcular Consumo">
        </form>
        
        @if (isset($resultado))
            <div class="resultado">
                <h3>Resultado:</h3>
                <p>{{ $resultado }}</p>
            </div>
        @endif
    </div>
</body>
</html>
@endsection
