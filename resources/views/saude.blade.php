@extends('layout.app')
@section('title', 'IMC')
@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Calculadora de IMC e Qualidade do Sono</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg,rgb(255, 255, 255),rgb(255, 255, 255));
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
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }
        input[type="submit"] {
            background: #4A90E2;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            border: none;
        }
        input[type="submit"]:hover {
            background: #357ABD;
        }
        .resultado {
            margin-top: 20px;
            background:rgb(145, 246, 250);
            padding: 15px;
            border-radius: 8px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Calculadora de IMC e Qualidade do Sono</h2>
        <form method="POST" action="{{ url('/saude') }}">
            @csrf
            <label for="peso">Peso (kg):</label>
            <input type="number" name="peso" step="0.01" min="0" required>
            
            <label for="altura">Altura (m):</label>
            <input type="number" name="altura" step="0.01" min="0" required>
            
            <label for="idade">Idade (anos):</label>
            <input type="number" name="idade" min="0" required>
            
            <label for="horas_dormidas">Horas de Sono (por noite):</label>
            <input type="number" name="horas_dormidas" step="0.1" min="0" required>
            
            <input type="submit" value="Calcular IMC e Qualidade do Sono">
        </form>
        
        @if (isset($resultado))
            <div class="resultado">
                <h3>Resultado:</h3>
                <p>{{ $resultado['imc'] }}</p>
                <p>{{ $resultado['sono'] }}</p>
            </div>
        @endif
    </div>
</body>
</html>
@endsection
