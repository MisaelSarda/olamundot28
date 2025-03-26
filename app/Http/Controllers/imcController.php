<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImcController extends Controller
{
    public function exercicio() {
        return view('imc');
    }

    // Método para calcular o IMC
    public function calcularIMC(Request $request)
    {
        $peso = $request->input('peso');
        $altura = $request->input('altura');

        // Validação: verifica se são numéricos e maiores que zero
        if (!is_numeric($peso) || !is_numeric($altura) || $altura <= 0 || $peso <= 0) {
            $resultado = "Valores inválidos. Insira um peso e altura válidos.";
        } else {
            // Cálculo do IMC
            $imc = $peso / ($altura * $altura);

            // Classificação do IMC (segundo OMS)
            if ($imc < 16) {
                $categoria = "Magreza grave";
            } elseif ($imc < 17) {
                $categoria = "Magreza moderada";
            } elseif ($imc < 18.5) {
                $categoria = "Magreza leve";
            } elseif ($imc < 25) {
                $categoria = "Peso normal";
            } elseif ($imc < 30) {
                $categoria = "Sobrepeso";
            } elseif ($imc < 35) {
                $categoria = "Obesidade grau I";
            } elseif ($imc < 40) {
                $categoria = "Obesidade grau II (severa)";
            } else {
                $categoria = "Obesidade grau III (mórbida)";
            }

            // Exibição do resultado formatado
            $resultado = "Seu IMC é " . number_format($imc, 2) . " (" . $categoria . ").";
        }

        return view('imc', ['resultado' => $resultado]);
    }
}
