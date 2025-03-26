<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaudeController extends Controller
{
    // Exibe o formulário com os campos para IMC e sono
    public function index()
    {
        return view('saude');
    }

    // Calcula IMC e qualidade do sono
    public function calcularSaude(Request $request)
    {
        // Captura os dados do formulário
        $peso = $request->input('peso');
        $altura = $request->input('altura');
        $idade = $request->input('idade');
        $horasDormidas = $request->input('horas_dormidas');

        // Validação dos inputs
        if (!is_numeric($peso) || !is_numeric($altura) || !is_numeric($idade) || !is_numeric($horasDormidas) ||
            $peso <= 0 || $altura <= 0 || $idade <= 0 || $horasDormidas < 0) {
            return view('saude', ['resultado' => "Valores inválidos. Insira todos os dados corretamente."]);
        }

        // Cálculo do IMC
        $imc = $peso / ($altura * $altura);
        $categoriaIMC = $this->classificarIMC($imc);

        // Avaliação da qualidade do sono conforme a idade
        $recomendacaoSono = $this->avaliarQualidadeSono($idade, $horasDormidas);

        // Retorna os resultados para a view
        return view('saude', [
            'resultado' => [
                'imc' => "Seu IMC é " . number_format($imc, 2) . " (" . $categoriaIMC . ").",
                'sono' => $recomendacaoSono
            ]
        ]);
    }

    // Classifica o IMC com base na tabela da OMS
    private function classificarIMC($imc)
    {
        if ($imc < 16) {
            return "Magreza grave";
        } elseif ($imc < 17) {
            return "Magreza moderada";
        } elseif ($imc < 18.5) {
            return "Magreza leve";
        } elseif ($imc < 25) {
            return "Peso normal";
        } elseif ($imc < 30) {
            return "Sobrepeso";
        } elseif ($imc < 35) {
            return "Obesidade grau I";
        } elseif ($imc < 40) {
            return "Obesidade grau II (severa)";
        } else {
            return "Obesidade grau III (mórbida)";
        }
    }

    // Avalia a qualidade do sono com base na idade
    private function avaliarQualidadeSono($idade, $horasDormidas)
    {
        // Recomendação de horas de sono por faixa etária
        $recomendacoes = [
            ['min' => 12, 'max' => 14, 'idade' => 2],  // Menores de 3 anos
            ['min' => 10, 'max' => 13, 'idade' => 5],  // 3 a 5 anos
            ['min' => 9, 'max' => 11, 'idade' => 12],  // 6 a 12 anos
            ['min' => 8, 'max' => 10, 'idade' => 17],  // 13 a 17 anos
            ['min' => 7, 'max' => 9, 'idade' => 99]    // 18+ anos
        ];

        foreach ($recomendacoes as $recomendacao) {
            if ($idade <= $recomendacao['idade']) {
                if ($horasDormidas < $recomendacao['min']) {
                    return "Qualidade do sono: Insuficiente. Tente dormir mais horas!";
                } elseif ($horasDormidas > $recomendacao['max']) {
                    return "Qualidade do sono: Excesso de sono. Tente manter uma rotina mais equilibrada.";
                } else {
                    return "Qualidade do sono: Ideal. Continue mantendo uma boa rotina de sono.";
                }
            }
        }

        return "Não foi possível determinar a qualidade do sono.";
    }
}
?>
