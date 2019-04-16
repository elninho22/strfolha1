<?php

namespace app\components;

use NumberFormatter;
use Yii;
use yii\helpers\Html;

class Uteis {

    private $script_start;
    private $script_end;
    private $elapsed_time;
    private static $Data;
    private static $Format;
    
    public static function pre($var) {
        echo '<pre>';
        print_r($var);
        echo '</pre>'
        . '<br>';
    }

    public static function preStop($var) {
        self::pre($var);
        die('PreStop da classe components/Uteis executado');
    }

    //fonte: http://blog.luders.com.br/desenvolvimento/calculando-o-tempo-de-execucao-com-php/
    // iniciar contador para debugar o tempo de execução de um codigo
    public function initTimeExecution() {
        // Iniciamos o "contador"
        list($usec, $sec) = explode(' ', microtime());
        $this->script_start = (float) $sec + (float) $usec;
        return $this->script_start;
    }

    //fonte: http://blog.luders.com.br/desenvolvimento/calculando-o-tempo-de-execucao-com-php/
    // finalizar contador para debugar o tempo de execução de um codigo
    public function finishTimeExecution() {
        // Terminamos o "contador"
        list($usec, $sec) = explode(' ', microtime());
        $this->script_end = (float) $sec + (float) $usec;
        $this->elapsed_time = round($this->script_end - $this->script_start, 5);
        return $this->script_end;
    }

    //fonte: http://blog.luders.com.br/desenvolvimento/calculando-o-tempo-de-execucao-com-php/
    // exibe o resultado do tempo de execução de um codigo
    public function printTimeExecution() {
        // Exibimos uma mensagem
        echo 'Elapsed time: ', $this->elapsed_time, ' secs. Memory usage: ', round(((memory_get_peak_usage(true) / 1024) / 1024), 3), 'MB';
    }

    /**
     * Pegar iniciais do nome passado por parametro, do primeiro nome, e caso houver, do ultimo nome.
     */
    public static function getIniciais($nome, $separator = ' ') {
        $iniciais = "";
        if ($nome) {
            $nome = explode(' ', trim($nome));
            if (count($nome) > 1) {
                $iniciais = strtoupper($nome[0]{0} . " " . $separator . $nome[count($nome) - 1]{0});
            } else {
                $iniciais = strtoupper($nome[0]{0});
            }
        }
        return $iniciais;
    }

    /**
     * Pegar iniciais do primeiro nome passado por parametro
     */
    public static function getInicial($nome) {
        $nome = trim($nome);
        $inicial = "";
        if ($nome) {
            $inicial = strtoupper($nome{0});
        }
        return $inicial;
    }

    // Generates a strong password of N length containing at least one lower case letter,
    // one uppercase letter, one digit, and one special character. The remaining characters
    // in the password are chosen at random from those four sets.
    //
   // The available characters in each set are user friendly - there are no ambiguous
    // characters such as i, l, 1, o, 0, etc. This, coupled with the $add_dashes option,
    // makes it much easier for users to manually type or speak their passwords.
    //
   // Note: the $add_dashes option will increase the length of the password by
    // floor(sqrt(N)) characters.

    function geraSenha($length = 20, $add_dashes = false, $available_sets = 'luds') {
        $sets = array();
        if (strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if (strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if (strpos($available_sets, 'd') !== false)
            $sets[] = '23456789';
        if (strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%&*?';
        $all = '';
        $password = '';
        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for ($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];
        $password = str_shuffle($password);
        if (!$add_dashes)
            return $password;
        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while (strlen($password) > $dash_len) {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }

    /**
     * Fonte: https://gist.github.com/tylerhall/521810
     */
    public static function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds') {
        $sets = [];
        if (strpos($available_sets, 'l') !== false) {
            $sets['l'] = 'abcdefghjkmnpqrstuvwxyz';
        }
        if (strpos($available_sets, 'u') !== false) {
            $sets['u'] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        }
        if (strpos($available_sets, 'd') !== false) {
            $sets['d'] = '23456789';
        }
        if (strpos($available_sets, 's') !== false) {
            $sets['s'] = '!@#$%&*?';
        }
        $all = '';
        $password = '';
        foreach ($sets as $key => $set) {
            //se o índice do sets for o 'd' (no qual representa os números), gero no mínimo dois
            //para passar pela validação de senha da model
            if ($key == 'd') {
                $password .= $set[array_rand(str_split($set))];
                $password .= $set[array_rand(str_split($set))];
            } else {
                $password .= $set[array_rand(str_split($set))];
            }
            $all .= $set;
        }
        $all = str_split($all);
        //adiciono mais um no real length caso seja passado como parâmetro o valor 'd' (no qual
        //representa os números, pela obrigatoriedade de ter no mínimo 2).
        $realLength = array_search('d', array_keys($sets)) ? count($sets) + 1 : count($sets);
        for ($i = 0; $i < $length - $realLength; $i++) {
            $password .= $all[array_rand($all)];
        }
        $password = str_shuffle($password);
        if (!$add_dashes) {
            return $password;
        }
        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while (strlen($password) > $dash_len) {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }

    /**
     * Faz a criação das pastas que não existem no diretório de uploads.
     * @param type $path
     */
    public static function verificaUploadPath($path) {
        $dir = Yii::getAlias("@webroot") . '/uploads';
        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $dir = "$dir/$path";
        if (!is_dir($dir)) {
            mkdir($dir);
        }
    }

    public static function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }

    public static function endsWith($haystack, $needle) {
        // search forward starting from end minus needle length characters
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
    }

    /**
     * <b>Limita os Palavras:</b> Limita a quantidade de palavras a serem exibidas em uma string!
     * @param STRING $String = Uma string qualquer
     * @return INT = $Limite = quantidade de palavras não caracteres
     */
    public static function words($String, $Limite, $Pointer = null) {
        self::$Data = strip_tags(trim($String));
        self::$Format = (int) $Limite;

        $ArrWords = explode(' ', self::$Data);
        $NumWords = count($ArrWords);
        $NewWords = implode(' ', array_slice($ArrWords, 0, self::$Format));

        $Pointer = (empty($Pointer) ? '...' : ' ' . $Pointer );
        $Result = ( self::$Format < $NumWords ? $NewWords . $Pointer : self::$Data );
        return $Result;
    }

    public static function unhtmlentities($data) {
        $data = str_replace("\xc2\xa0", '', $data); // UTF-8 nbsp -> space
        $data = str_replace("\xa0", '', $data);  // ISO-8859-1 nbsp -> space, why: http://stackoverflow.com/a/1462039.
        return $data;
    }

    /**
     *
     * @param string $string string a se limitar
     * @param int $limit limite de caracteres
     * @param string $finishString Final da string (não considerada na contagem)
     * @param boolean $encode se o texto será processado pelo \yii\helpers\Html::endode()
     * @return string String limitada
     */
    public static function characterLimit($string, $limit, $finishString = '', $encode = true) {
        if (strlen($string) > $limit) {
            $string = substr($string, 0, $limit) . $finishString;
        }
        return $encode ? Html::encode($string) : $string;
    }

    public static function unsetIfIsset($array, $key) {
        if (isset($array[$key])) {
            unset($array[$key]);
        }
        return $array;
    }

    public static function hasBadWords($string) {
        return BadwordsFilter::hasBadWord($string);
    }

    /**
     * <b>Tranforma URL:</b> Tranforma uma string no formato de URL amigável e retorna o a string convertida!
     * @param STRING $Name = Uma string qualquer
     * @return STRING = $Data = Uma URL amigável válida
     */
    public static function Name($Name) {
        self::$Format = array();
        self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        self::$Data = strtr(utf8_decode($Name), utf8_decode(self::$Format['a']), self::$Format['b']);
        self::$Data = strip_tags(trim(self::$Data));
        self::$Data = str_replace(' ', '-', self::$Data);
        self::$Data = str_replace(array('-----', '----', '---', '--'), '-', self::$Data);

        return strtolower(utf8_encode(self::$Data));
    }

    public static function calculaPorcentage($valor, $totalGeral, $format = true) {
        $data = ($valor * 100) / $totalGeral;
        return $format ? ' (' . number_format($data, 2, '.', '') . "%)" : number_format($data, 2, '.', '');
    }

    public static function temDadosSensiveis($string) {
        $string = Encoding::fixUTF8($string, Encoding::ICONV_IGNORE);
        //remove as informações no formato de data
        $stringEntities = htmlentities(preg_replace(["/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/"], "", strip_tags($string)), null, 'utf-8');
        $string = Html::encode(preg_replace(["/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/"], "", $string), null, 'utf-8');

        //Utilizado para Chpras, CPF, Celular, Conta Corrente, nº do cartão
        $string = preg_replace('~[\r\n]+~', '', $string);
        $stringEntities = preg_replace('~[\r\n]+~', '', $stringEntities);
        $stringTratada = str_replace(['&gt;', '&lt;', '&nbsp;', '(', ')', '\\', '/', ',', '.', ' ', '|', '-', '+', '_', '*', ':', '[', ']', '=', '?', '>', '<'], '', $string);
        $stringEntitiesTratada = str_replace(['&gt;', '&lt;', '&nbsp;', '(', ')', '\\', '/', ',', '.', ' ', '|', '-', '+', '_', '*', ':', '[', ']', '=', '?', '>', '<'], '', $stringEntities);

        //na validação de telefone, não é levado em consideração o caractere '/', pois pode conter em datas
        //verificação para nº de cartão
        if (preg_match("/[0-9]{16}/", $stringTratada) || preg_match("/[0-9]{16}/", $stringEntitiesTratada)) {
            return true;
            //verificação para Chpras, CPF e Celular
        } else if (preg_match("/[0-9]{11}/", $stringTratada) || preg_match("/[0-9]{11}/", $stringEntitiesTratada)) {
            return true;
            //verificação de RG somente com 9 dígitos
        } else if (preg_match("/[0-9]{9}/", $stringTratada) || preg_match("/[0-9]{9}/", $stringEntitiesTratada)) {
            return true;
            //verificação para Telefone e RGs somente com 8 dígitos
        } else if (preg_match("/[0-9]{8}/", $stringTratada) || preg_match("/[0-9]{8}/", $stringEntitiesTratada)) {
            return true;
            //verificação de Conta Corrente
        } else if (preg_match("/[0-9]{6}/", $stringTratada) || preg_match("/[0-9]{6}/", $stringEntitiesTratada)) {
            return true;
        }
        return false;
    }

    public static function copiarArquivosPastas($src, $dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ( $file = readdir($dir))) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if (is_dir($src . '/' . $file)) {
                    self::copiarArquivosPastas($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    public static function deletarArquivosPastas($dir) {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? self::deletarArquivosPastas("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    public static function convertISOtoUtf8($text) {
        // map based on:
        // http://konfiguracja.c0.pl/iso02vscp1250en.html
        // http://konfiguracja.c0.pl/webpl/index_en.html#examp
        // http://www.htmlentities.com/html/entities/
        $map = array(
            chr(0x8A) => chr(0xA9),
            chr(0x8C) => chr(0xA6),
            chr(0x8D) => chr(0xAB),
            chr(0x8E) => chr(0xAE),
            chr(0x8F) => chr(0xAC),
            chr(0x9C) => chr(0xB6),
            chr(0x9D) => chr(0xBB),
            chr(0xA1) => chr(0xB7),
            chr(0xA5) => chr(0xA1),
            chr(0xBC) => chr(0xA5),
            chr(0x9F) => chr(0xBC),
            chr(0xB9) => chr(0xB1),
            chr(0x9A) => chr(0xB9),
            chr(0xBE) => chr(0xB5),
            chr(0x9E) => chr(0xBE),
            chr(0x80) => '&euro;',
            chr(0x82) => '&sbquo;',
            chr(0x84) => '&bdquo;',
            chr(0x85) => '&hellip;',
            chr(0x86) => '&dagger;',
            chr(0x87) => '&Dagger;',
            chr(0x89) => '&permil;',
            chr(0x8B) => '&lsaquo;',
            chr(0x91) => '&lsquo;',
            chr(0x92) => '&rsquo;',
            chr(0x93) => '&ldquo;',
            chr(0x94) => '&rdquo;',
            chr(0x95) => '&bull;',
            chr(0x96) => '&ndash;',
            chr(0x97) => '&mdash;',
            chr(0x99) => '&trade;',
            chr(0x9B) => '&rsquo;',
            chr(0xA6) => '&brvbar;',
            chr(0xA9) => '&copy;',
            chr(0xAB) => '&laquo;',
            chr(0xAE) => '&reg;',
            chr(0xB1) => '&plusmn;',
            chr(0xB5) => '&micro;',
            chr(0xB6) => '&para;',
            chr(0xB7) => '&middot;',
            chr(0xBB) => '&raquo;',
        );
        return html_entity_decode(mb_convert_encoding(strtr($text, $map), 'UTF-8', 'ISO-8859-2'), ENT_QUOTES, 'UTF-8');
    }

}
