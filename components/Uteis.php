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
    private static $badWords = [' anus ', ' bastardo ', ' bicha ', ' biscate ', ' buceta ', ' boceta ', ' boob ', ' bosta ', ' burro ', ' cabrao ', ' cacete ', ' cagar ',
        ' camisinha ', ' caralho ', ' chochota ', ' clitoris ', ' consolo ', ' corno ', ' dar o rabo ', ' esporra ', ' fecal ', ' filho da puta ', ' foda ', ' foda-se ', ' foder ',
        ' gozar ', ' grelho ', ' homoerótico ', ' inferno ', ' lésbica ', ' merda ', ' pau ', ' peidar ', ' pênis ', ' porra ', ' puta ', ' sacanagem ', ' transar ', ' foder ',
        ' tomar no cu ', ' veado ', ' vibrador ', ' xana ', ' fuck ', ' pqp ', ' vsf ', ' vtnc ', ' cu ', 'BABA-OVO', 'BABAOVO', 'BABACA', 'BACURA', 'BAGOS', 'BAITOLA', 'BEBUM',
        'BESTA', 'BICHA', 'BISCA', 'BIXA', 'BOAZUDA', 'BOCETA', 'BOCO', 'BOC+', 'BOIOLA', 'BOLAGATO', 'BOQUETE', 'BOLCAT', 'BOSSETA', 'BOSTA', 'BOSTANA', 'BRECHA', 'BREXA', 'BRIOCO',
        'BRONHA', 'BUCA', 'BUCETA', 'BUNDA', 'BUNDUDA', 'BURRA', 'BURRO', 'BUSSETA', 'CACHORRA', 'CACHORRO', 'CADELA', 'CAGA', 'CAGADO', 'CAGAO', 'CAGONA', 'CANALHA', 'CARALHO',
        'CASSETA', 'CASSETE', 'CHECHECA', 'CHERECA', 'CHIBUMBA', 'CHIBUMBO', 'CHIFRUDA', 'CHIFRUDO', 'CHOTA', 'CHOCHOTA', 'CHUPADA', 'CHUPADO', 'CLITORIS', 'CLIT+RIS', 'COCAINA',
        'COCA-NA', 'COCO', 'COC+', 'CORNA', 'CORNO', 'CORNUDA', 'CORNUDO', 'CORRUPTA', 'CORRUPTO', 'CRETINA', 'CRETINO', 'CRUZ-CREDO', 'CULHAO', 'CULH+O', 'CULH+ES', 'CURALHO',
        'CUZAO', 'CUZ+O', 'CUZUDA', 'CUZUDO', 'DEBIL', 'DEBILOIDE', 'DEFUNTO', 'DEMONIO', 'DEM+NIO', 'DIFUNTO', 'DOIDA', 'DOIDO', 'EGUA', '+GUA', 'ESCROTA', 'ESCROTO', 'ESPORRADA',
        'ESPORRADO', 'ESPORRO', 'ESP+RRO', 'ESTUPIDA', 'EST+PIDA', 'ESTUPIDEZ', 'ESTUPIDO', 'EST+PIDO', 'FEDIDA', 'FEDIDO', 'FEDOR', 'FEDORENTA', 'FEIA', 'FEIO', 'FEIOSA', 'FEIOSO',
        'FEIOZA', 'FEIOZO', 'FELACAO', 'FELAŚ+O', 'FENDA', 'FODA', 'FODAO', 'FOD+O', 'FODE', 'FODIDA', 'FODIDO', 'FORNICA', 'FUDENDO', 'FUDECAO', 'FUDEŚ+O', 'FUDIDA', 'FUDIDO',
        'FURADA', 'FURADO', 'FURAO', 'FUR+O', 'FURNICA', 'FURNICAR', 'FURO', 'FURONA', 'GAIATA', 'GAIATO', 'GAY', 'GONORREA', 'GONORREIA', 'GOSMA', 'GOSMENTA', 'GOSMENTO', 'GRELINHO',
        'GRELO', 'HOMO-SEXUAL', 'HOMOSEXUAL', 'HOMOSSEXUAL', 'IDIOTA', 'IDIOTICE', 'IMBECIL', 'ISCROTA', 'ISCROTO', 'JAPA', 'LADRA', 'LADRAO', 'LADR+O', 'LADROEIRA', 'LADRONA',
        'LALAU', 'LEPROSA', 'LEPROSO', 'LESBICA', 'L+SBICA', 'MACACA', 'MACACO', 'MACHONA', 'MACHORRA', 'MANGUACA', 'MANGUAŚA', 'MASTURBA', 'MELECA', 'MERDA', 'MIJA', 'MIJADA',
        'MIJADO', 'MIJO', 'MOCREA', 'MOCR+A', 'MOCREIA', 'MOCR+IA', 'MOLECA', 'MOLEQUE', 'MONDRONGA', 'MONDRONGO', 'NABA', 'NADEGA', 'NOJEIRA', 'NOJENTA', 'NOJENTO', 'NOJO', 'OLHOTA',
        'OTARIA', 'OT-RIA', 'OTARIO', 'OT-RIO', 'PACA', 'PASPALHA', 'PASPALHAO', 'PASPALHO', 'PAU ', 'PEIA', 'PEIDO', 'PEMBA', 'PENIS', 'P-NIS', 'PENTELHA', 'PENTELHO', 'PERERECA',
        'PERU', 'PER+', 'PICA', 'PICAO', 'PIC+O', 'PILANTRA', 'PIRANHA', 'PIROCA', 'PIROCO', 'PIRU', 'PORRA', 'PREGA', 'PROSTIBULO', 'PROST-BULO', 'PROSTITUTA', 'PROSTITUTO',
        'PUNHETA', 'PUNHETAO', 'PUNHET+O', 'PUS', 'PUSTULA', 'P+STULA', 'PUTA', 'PUTO', 'PUXA-SACO', 'PUXASACO', 'RABAO', 'RAB+O', 'RABO', 'RABUDA', 'RABUDAO', 'RABUD+O', 'RABUDO',
        'RABUDONA', 'RACHA', 'RACHADA', 'RACHADAO', 'RACHAD+O', 'RACHADINHA', 'RACHADINHO', 'RACHADO', 'RAMELA', 'REMELA', 'RETARDADA', 'RETARDADO', 'RIDICULA', 'RID-CULA', 'ROLA',
        'ROLINHA', 'ROSCA', 'SACANA', 'SAFADA', 'SAFADO', 'SAPATAO', 'SAPAT+O', 'SIFILIS', 'S-FILIS', 'SIRIRICA', 'TARADA', 'TARADO', 'TESTUDA', 'TEZAO', 'TEZ+O', 'TEZUDA', 'TEZUDO',
        'TROCHA', 'TROLHA', 'TROUCHA', 'TROUXA', 'TROXA', 'VACA', 'VAGABUNDA', 'VAGABUNDO', 'VAGINA', 'VEADA', 'VEADAO', 'VEAD+O', 'VEADO', 'VIADA', 'VIADO', 'VIADAO', 'VIAD+O',
        'XAVASCA', 'XERERECA', 'XEXECA', 'XIBIU', 'XIBUMBA', 'XOTA', 'XOCHOTA', 'XOXOTA', 'XANA', 'XANINHA', 'fdp', 'boba', 'vai tomar no cu', 'galinha', 'disgraça', 'poha', 'você é um lixo',
        'falsiane', 'fuder', 'caraio', 'F0D@', 'V@C@', 'xereca', 'disgrassa', 'Di$gr@¢a', 'Vi@d0', 'Vi4d0', 'poh4', 'c$r@lho', 'c4r4lho', 'filho da put4', 'filho da put@', 'vai se fud3r',
        'merd@', 'merd4', 'put4 que pariu', 'put4 que p4riu', 'put@ que p@riu', 'c@cete', 'c4cete', 'put4 merd4', '¢u', 'pinto', 'vai c@g@r', 'puxa saco', 'best4', 'best@', '@nus', 'babac@',
        'bocet4', 'b0quete', 'bost4', 'bost@', 'burr@', 'burr0', 'cagão', 'cagon4', 'cagon@', 'cadel4', 'cadel@', 'cuzão', 'canalh@', 'c4r@lho', 'vai se fuder', 'put@ merd@', 'c@gar', 'cag@r',
        'babac4', 'bund@', '@NUS', 'B@B@-0V0', 'B@B@0V0', 'B@B@C@', 'B@G0S', 'B@1T0L@', 'B3BUM', 'B3B@DO', 'B3ST@', 'B1CH@', 'B!CH@', 'B1$C@T3', 'B!$C@T3', 'B!X@', 'B1X@', 'BOC3T@', 'B010L@', 'B0!OL@',
        'B0L@G@T0', 'B0QU3T3', 'B0LC@T', 'B0$$3T@', 'B0$T@', 'BR10C0', 'BR!0C0', 'BR0NH@', 'BUC3T@', 'BUND@', 'BUNDUD@', 'BURR@', 'BURR0', 'C@CH0RR@', 'C@CH0RR0', 'C@D3L@', 'C@G@', 'C@G@D0', 'C@G@0',
        'C@G0N@', 'C@N@LH@', 'C@R@LH0', 'C@SS3T@', 'C@SS3T3', 'CH3R3C@', 'CH1FRUD@', 'CH!FRUD@', 'CH!FRUD0', 'CH1FRUD0', 'CH0T@', 'CH0CH0T@', 'CHUP@D@', 'CHUP@D0', 'CL1T0R1S', 'CL!T0R!S', 'C0C@1N@',
        'C0C@!N@', 'C0C0', 'C0RN@', 'C0RN0', 'C0RNUD@', 'C0RNUD0', 'CR3T1N@', 'CR3T!N@', 'CR3T1N0', 'CR3T!N0', 'CULH@0', 'CUZ@0', 'CUZUD@', 'CUZUD0', 'D3B1L', 'D3B!L', 'D3B!L0!D3', 'D3B1L0!D3',
        'D3B!L01D3', 'D3B1L0!D3', 'D3FUNT0', 'D3M0N1O', 'D3M0N!O', 'D1FUNT0', 'D01D@', 'D0!D@', 'D01D0', 'D0!D0', '3GU@', '3$SCR0T@', '3$CR0T0', '3$P0RR@D@', '3$P0RR@D0', '3$P0RR0', '3$TUP1D@',
        '3$TUP!D@', '3$TUP1D3Z', '3$TUP!D3Z', 'F3D!D@', 'F3D1D@', 'F3D!D0', 'F3D1D0', 'F3D0R', 'F3D0R3NT@', 'F31@', 'F3!@', 'F310', 'F3!0', 'F310S@', 'F3!OS@', 'F310S0', 'F3!OS0', 'F310Z@', 'F3!OZ@',
        'F310Z0', 'F3!0Z0', 'F0D@', 'F0D0', 'F0D3', 'F0D1D@', 'F0D!D@', 'F0D!D0', 'F0D1D0', 'F0RN1C@', 'F0RN!C@', 'FUD3ND0', 'FUD1D@', 'FUD!D@', 'FUD1D0', 'FUD!D0', 'FUR1C@', 'FURN!C@', 'FURN1C@R',
        'FURN!C@R', 'G0N0RR3@', 'G0N0RR3!@', 'G0N0RR21@', 'GR3L1NH0', 'GR3L0', 'H0M0-S3XU@L', 'H0M0S3XU@L', 'H0M0SS3XU@L', '1D10T@', '!D!0T@', '1D10T1C3', '!D!0T!C3', '1MB3C1L', '!MB3C!L', '!SCR0T@',
        '1SCR0T@', '1SCR0T0', '!SCR0T0', 'L@DR@', 'L@DR@0', 'L@DR0N@', 'L3PR0S@', 'L3PR0S0', 'L3SB1C@', 'L3SB!C@', 'M@C@C@', 'M@C@C0', 'M@CH0N@', 'M@STURB@', 'M3RD@', 'M!J@', 'M1J@', 'M1J@D@', 'M!J@D@',
        'M1J@D0', 'M1J0', 'M0CR3@', 'M0CR31@', 'M0CR3!@', 'M0L3C@', 'M0L3QU3', 'N0J31R@', 'N0J3!R@', 'N0J3NT@', 'N0J3NT0', 'N0J0', '0T@R1@', '0T@R!@', '0T@R10', '0T@R!0', 'P@SP@LH@', 'P@SP@LH@0',
        'P@SP@LH0', 'P@U', 'P3!D0', 'P31D0', 'P3N1S', 'P3N!S', 'P3NT3LH@', 'P3NT3LH0', 'P3R3R3C@', 'P3RU', 'P1C@', 'P!C@', 'P1C@O', 'P!C@O', 'P1L@NTR@', 'P!L@NTR@', 'P1R@NH@', 'P!R@NH@', 'P1R0C@',
        'P!R0C@', 'P1RU', 'P!RU', 'P0RR@', 'PR3G@', 'PR0ST1BUL0', 'PR0ST!BUL0', 'PR0ST1TUT@', 'PR0ST!TUT@', 'PR0ST1TUT0', 'PUNHET@', 'PUNHET@0', 'PUT@', 'PUT0', 'PUX@-S@C0', 'PUX@S@C0', 'R@B@0', 'R@B0',
        'R@BUD@', 'R@BUD@0', 'R@BUD0', 'R@BUD0N@', 'R@CH@', 'R@CH@D@', 'R@CH@D@0', 'R@CH@D1NH@', 'R@CH@D!NH@', 'R@CH@D1NH0', 'R@CH@D!NH0', 'R@CH@D0', 'R@M3L@', 'R3M3L@', 'R3T@RD@D@', 'R3T@RD@D0',
        'R1D1CUL@', 'R!D!CUL@', 'R1D1CUL@', 'R0L@', 'R0L1NH@', 'R0SC@', 'S@C@N@', 'S@F@D@', 'S@F@D0', 'S@P@T@0', 'S1F1L1S', 'S!F!L!S', 'S1R1R1C@', 'S!R!R!C@', 'T@R@D@', 'T@R@D0', 'T3STUD@', 'T3Z@0',
        'T3ZUD@', 'T3ZUD0', 'TR0CH@', 'TR0LH@', 'TR0UCH@', 'TR0UX@', 'TR0X@', 'V@C@', 'V@G@BUND@', 'V@G@BUND0', 'V@GIN@', 'VE@D@', 'V3AD0', 'V3@D@0', 'V3@D@0', 'V34D40', 'V!@D@', 'VI4D4', 'VIADA',
        'VI4DO', 'VI@D0', 'VIAD0', 'VIADO', 'VI@D@0', 'V!@D40', 'VI4D@0', 'VIADAO', 'VIAD+O', 'V!@D0', 'V14D0', 'XAVASCA', 'XAVA$SCA', 'X@V@SC@', 'X4V4SC4', 'X@V@$SC@', 'X4V4$C4', 'XERERECA', 'X3R3C4',
        'XEREC4', 'XEREC@', 'X3R3C@', 'X3X3CA', 'XEXEC4', 'XEXEC4', 'X3X3C4', 'XEXEC@', 'X3X3C@', 'XIBIU', 'X!B!U', 'XIBIO', 'XIBI0', 'X!B!0', 'XOTA', 'XOT@', 'XOT4', 'X0T@', 'X0T4', 'XOCHOTA', 'X0CH0T@',
        'X0CH0T4', 'XOXOTA', 'X0X0T@', 'XOXOT4', 'X0X0T4', 'XANA', 'X@NA', 'X4N4', 'XANINHA', 'X@N!NH@', 'X4N!NHA', 'XAN!NHA', 'X@NINH@', 'X4NINH4'];

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
