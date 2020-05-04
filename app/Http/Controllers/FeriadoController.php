<?php

namespace App\Http\Controllers;

use App\Feriado;

use Illuminate\Http\Request;
use PhpParser\Builder\FunctionTest;

class FeriadoController extends Controller
{
    public Function teste() { // TODO - teste
        echo 'bife';
    }

    public function getFeriados()
    {
        return Feriado::all();
    }

    public function checkFeriado($diaVerificado)
    {
        if (($timestamp = strtotime($diaVerificado)) !== false) {
            $diaVerificado = strtotime($diaVerificado);
            $ano = date("Y", $timestamp);
            
            $feriadosAno = $this->dias_feriados($ano);
            
            foreach ($feriadosAno as $diaFeriado) {
                if ($diaFeriado == $diaVerificado) {
                    return '1';
                }                        
            }
            return '0';
        }
        else {
            echo 'invalid timestamp!';
            return '0';
        }        
    }

    public function checkPeriodo($inicio, $fim)
    {
        $timeDiff = strtotime($fim) - strtotime($inicio);
        $totalDias = round($timeDiff / (60 * 60 * 24));

        $diasUteis = 0;

        for ($i = 0; $i < $totalDias; $i++) {
            $diaTimestamp = strtotime($inicio) + ($i * 86400);
            
            $diaVerificado = date("Y-m-d", $diaTimestamp);
            
            if (date('w', $diaTimestamp) == '0' || date('w', $diaTimestamp) == '6') {
                continue;
            } else if ($this->checkFeriado($diaVerificado) == '1') {
                continue;
            } else {
                $diasUteis++;
            }
        }

        return response(strval($diasUteis));
    }

    function dias_feriados($ano = null)
    {
        if ($ano === null) { /* Alterado de 'false' para 'null' */ 
            $ano = intval(date('Y'));
        }
        $pascoa     = easter_date($ano); // Limite de 1970 ou após 2037 da easter_date PHP consulta http://www.php.net/manual/pt_BR/function.easter-date.php
        $dia_pascoa = date('d', $pascoa); // alterado de 'jour' para 'dia'
        $mes_pascoa = date('m', $pascoa); // alterado de 'n' para 'm'
        $ano_pascoa = date('Y', $pascoa);

        $feriados = array(
            // Datas Fixas dos feriados Nacionail Basileiras
            mktime(0, 0, 0, 1,  1,   $ano), // Confraternização Universal - Lei nº 662, de 06/04/49
            mktime(0, 0, 0, 4,  21,  $ano), // Tiradentes - Lei nº 662, de 06/04/49
            mktime(0, 0, 0, 5,  1,   $ano), // Dia do Trabalhador - Lei nº 662, de 06/04/49
            mktime(0, 0, 0, 9,  7,   $ano), // Dia da Independência - Lei nº 662, de 06/04/49
            mktime(0, 0, 0, 10, 12,  $ano), // N. S. Aparecida - Lei nº 6802, de 30/06/80
            mktime(0, 0, 0, 11, 2,   $ano), // Todos os santos - Lei nº 662, de 06/04/49
            mktime(0, 0, 0, 11, 15,  $ano), // Proclamação da republica - Lei nº 662, de 06/04/49
            mktime(0, 0, 0, 12, 25,  $ano), // Natal - Lei nº 662, de 06/04/49

            // These days have a date depending on easter
            mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 48,  $ano_pascoa), //2ºferia Carnaval
            mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 47,  $ano_pascoa), //3ºferia Carnaval	
            mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 2,  $ano_pascoa), //6ºfeira Santa  
            mktime(0, 0, 0, $mes_pascoa, $dia_pascoa,  $ano_pascoa), //Pascoa
            mktime(0, 0, 0, $mes_pascoa, $dia_pascoa + 60,  $ano_pascoa), //Corpus Cirist
        );

        sort($feriados);

        // Código não utilizado no momento

        // $confraternizacao_universal = mktime(0, 0, 0, 1,  1, $ano); // Confraternização Universal - Lei nº 662, de 06/04/49
        // $tiradentes = mktime(0, 0, 0, 4,  21,  $ano); // Tiradentes - Lei nº 662, de 06/04/49
        // $dia_do_trabalhador = mktime(0, 0, 0, 5,  1,   $ano); // Dia do Trabalhador - Lei nº 662, de 06/04/49
        // $dia_da_independencia = mktime(0, 0, 0, 9,  7,   $ano); // Dia da Independência - Lei nº 662, de 06/04/49
        // $n_s_aparecida = mktime(0, 0, 0, 10,  12, $ano); // N. S. Aparecida - Lei nº 6802, de 30/06/80
        // $todos_os_santos = mktime(0, 0, 0, 11,  2,  $ano); // Todos os santos - Lei nº 662, de 06/04/49
        // $proclamacao_da_republica = mktime(0, 0, 0, 11, 15,  $ano); // Proclamação da republica - Lei nº 662, de 06/04/49
        // $natal = mktime(0, 0, 0, 12, 25,  $ano); // Natal - Lei nº 662, de 06/04/49


        // $segunda_carnaval = mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 48,  $ano_pascoa); //2ºferia Carnaval
        // $terca_carnaval = mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 47,  $ano_pascoa); //3ºferia Carnaval	
        // $sexta_feira_santa = mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 2,  $ano_pascoa); //6ºfeira Santa  
        // $pascoa = mktime(0, 0, 0, $mes_pascoa, $dia_pascoa,  $ano_pascoa); //Pascoa
        // $corpus_crist = mktime(0, 0, 0, $mes_pascoa, $dia_pascoa + 60,  $ano_pascoa); //Corpus Crist


        return $feriados;
    }
}
