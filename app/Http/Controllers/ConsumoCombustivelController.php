<?php

// app/Http/Controllers/ConsumoCombustivelController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsumoCombustivelController extends Controller
{
    public function index()
    {
        return view('consumo_combustivel');
    }

    public function calcularConsumo(Request $request)
    {
        $distancia = $request->input('distancia');
        $combustivel = $request->input('combustivel');
        $tipoCombustivel = $request->input('tipo_combustivel');
        $valorCombustivel = $request->input('valor_combustivel');

        // Verificando se os valores são numéricos
        if (!is_numeric($distancia) || !is_numeric($combustivel) || !is_numeric($valorCombustivel) ||
            $distancia <= 0 || $combustivel <= 0 || $valorCombustivel <= 0) {
            $resultado = "Valores inválidos. A distância, o combustível e o valor devem ser números maiores que zero.";
        } else {
            // Cálculo corrigido: consumo é distância por litro
            $consumoPorKm = $distancia / $combustivel;

            // Cálculo do custo total correto
            $custoTotal = ($distancia / $consumoPorKm) * $valorCombustivel;

            // Formatação do tipo de combustível
            $tipoCombustivelTexto = ucfirst($tipoCombustivel);

            // Formatação do resultado
            $resultado = "O consumo de combustível é de " . number_format($consumoPorKm, 2) . " km por litro. ";
            $resultado .= "O custo total para percorrer " . number_format($distancia, 2, ',', '.') . " km com " . number_format($combustivel, 2, ',', '.') . 
                          " litros de " . $tipoCombustivelTexto . " é R$ " . number_format($custoTotal, 2, ',', '.') . ".";
        }

        return view('consumo_combustivel', ['resultado' => $resultado]);
    }
}
?>
