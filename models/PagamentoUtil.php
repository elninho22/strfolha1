<?php

namespace app\models;


class PagamentoUtil
{
	public static function getStatusValue($data, $key, $index, $column)
                 {
                    if($data->fopa_stat == '0')
                    {
                        return 'Pendente';
                    }
                    if($data->fopa_stat == '1')
                    {
                        return 'Aprovado';
                    }
                    else
                    {
                        return 'Reprovado';
                    }
                }
   /* public static function getMesReferenciaValue($data, $key, $index, $column)
     {
        if($data->fopa_data)
        {
            return null;
        }
        if else
        {
            return null;
        }
    }*/
}

?>