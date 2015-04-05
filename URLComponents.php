<?php
/**
 * FileName: URLComponents.php
 * Description: URLComponents 组建
 * Author: Bigpao
 * Email: bigpao.luo@gmail.com
 * HomePage: 
 * Version: 0.0.1
 * LastChange: 2015-04-05 16:33:06
 * History:
 */
class URLComponents
{
    protected $code =
        array (
            0 => 'n',
            1 => 'z',
            2 => '3',
            3 => 'l',
            4 => 't',
            5 => 'p',
            6 => '7',
            7 => '2',
            8 => 'V',
            9 => 'W',
            10 => 'y',
            11 => '1',
            12 => 'D',
            13 => '+',
            14 => 'e',
            15 => 'i',
            16 => 'j',
            17 => 'C',
            18 => 'K',
            19 => 'h',
            20 => '6',
            21 => 'E',
            22 => 'f',
            23 => 'U',
            24 => 'S',
            25 => 'A',
            26 => 'L',
            27 => 'J',
            28 => '-',
            29 => '4',
            30 => 'T',
            31 => 'X',
            32 => 'I',
            33 => 'P',
            34 => 'c',
            35 => 'w',
            36 => 's',
            37 => 'b',
            38 => 'm',
            39 => 'M',
            40 => 'g',
            41 => 'q',
            42 => 'Z',
            43 => 'F',
            44 => 'N',
            45 => 'B',
            46 => 'G',
            47 => 'r',
            48 => '5',
            49 => 'Y',
            50 => 'a',
            51 => 'H',
            52 => 'u',
            53 => 'Q',
            54 => 'd',
            55 => '9',
            56 => '8',
            57 => 'R',
            58 => 'O',
            59 => 'o',
            60 => 'v',
            61 => 'x',
            62 => '0',
            63 => 'k',
        );

    /**
     * 根据数字转65进制
     * @prams integer $num
     * @return string $code
     */
    public function encode($num)
    {
        $len = count($this -> code);
        $code = '';
        while($num > $len)
        {
            $code = $this -> code[abs($num % $len)] . $code;
            $num = floor($num / $len);
        }
        if($num > 0)
        {
            $code = $this -> code[$num] . $code;
        }

        return $code;
    }

    public function decode($str = '')
    {
        $strLength = strlen($str);
        $strArr = str_split($str);
        $sum = 0;

        $codeLength = count($this -> code);
        $codeFilp = array_flip($this -> code);

        foreach($strArr as $value)
        {
            $sum += $codeFilp[$value] * (pow($codeLength, --$strLength));
        }

        return $sum;
    }

}
