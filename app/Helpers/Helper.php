<?php

namespace App\Helpers;

use DateTime;
use Carbon\Carbon;



class Helper
{

    // converter caixa alta
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    // formatar string
    public static function format($mask,$string)
    {
        return  vsprintf($mask, str_split($string));
    }

    // formatar mascara de string
    public static function mask($val, $mask)
    {

        $maskared = '';
        $k = 0;
        if($val != ""){
            for($i = 0; $i<=strlen($mask)-1; $i++)
            {
                if($mask[$i] == '#')
                {
                    if(isset($val[$k]))
                    $maskared .= $val[$k++];
                }
                else
                {
                    if(isset($mask[$i]))
                    $maskared .= $mask[$i];
                }
            }
            return $maskared;

        } else {
            return "";
        }
        
    }
    public static function mask_cpf_cnpj($val)
    {
        $mask_cnpj = '##.###.###/####-##';
        $mask_cpf = '###.###.###-##';
        $val_length = strlen($val);

        $maskared = '';
        $k = 0;
        if($val != ""){

            if ($val_length > 11 ){
                for($i = 0; $i<=strlen($mask_cnpj)-1; $i++)
                {
                    if($mask_cnpj[$i] == '#')
                    {
                        if(isset($val[$k]))
                            $maskared .= $val[$k++];
                    }
                    else
                    {
                        if(isset($mask_cnpj[$i]))
                            $maskared .= $mask_cnpj[$i];
                    }
                }
                return $maskared;
            } else {
                for($i = 0; $i<=strlen($mask_cpf)-1; $i++)
                {
                    if($mask_cpf[$i] == '#')
                    {
                        if(isset($val[$k]))
                            $maskared .= $val[$k++];
                    }
                    else
                    {
                        if(isset($mask_cpf[$i]))
                            $maskared .= $mask_cpf[$i];
                    }
                }
                return $maskared;
            }



        } else {
            return "";
        }

    }

    public static function returnDataFim($date_start, $days)
    {

        if ($date_start != "")
        {
            $data_end = date('Y-m-d', strtotime('+'.$days.' days', strtotime($date_start)));

            $data_end = \Carbon\Carbon::parse($data_end)->format('d/m/Y');

            return $data_end;
        } else 
        {
            return "Inicio não definido";
        }
    }

    public static function prazoDiasSumula($date_start, $days)
    {

        if ($date_start != "")
        {
            $data_end = new DateTime( returnDataFim($date_start,$days) );
            $data_now = new DateTime( Carbon::now()->format('Y-m-d') );

            $prazo = $data_end->diff( $data_now )->format("%a");

            if ($data_end < $data_now)
            {


             return "VENCIDA";


            } else {

             return $prazo." dias";
            }
        
        } else 
        {
            return "---";
        }
    }


    public static function calcularDataEndSumula($data_start, $days)
    {
        if ( $data_start != null )
        {
            $data_end = date('Y-m-d', strtotime("+" .$days. " days", strtotime($data_start)));

            return $data_end;

        } else {

            return null;
        }
    }

    public static function calcularDiasRestantesSumula($data_start)
    {

        if ( $data_start != null ) {


            //pegar dat atual
            $data_atual = Carbon::now()->format('Y-m-d');

                try {

                    $data1 = new DateTime(Helper::calcularDataEndSumula($data_start, 90));

                } catch (\Exception $e) {

                }
                try {
                    $data2 = new DateTime($data_atual);

                } catch (\Exception $e) {

                }

            $dias = $data1->diff($data2)->format("%a");

            if ($data1 < $data2)
            {


             return "VENCIDA";;


            } else {

             return $dias." dias";
            }

        } else {
            return "---";
        }

    }

    
}