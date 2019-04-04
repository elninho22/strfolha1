<?php

namespace app\models;


class PagamentoUtil
{
	public static function getStatusValue($data, $key, $index, $column)
                 {
                    if($data->fopa_stat == '1')
                    {
                        return 'Aprovado';
                    }
                    else
                    {
                        return 'Reprovado';
                    }
                }
}

?>