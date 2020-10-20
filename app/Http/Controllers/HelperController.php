<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

class HelperController extends Controller
{
    use HelperTrait;

    public function randHash()
    {
        return '?' . $this->randString();
    }
   
    public function googleHref()
    {
        $oauth = new OAuthController();
        return $oauth->googleClient->createAuthUrl();
    }
    
   
    public function valueFormat($value)
    {
        return number_format((int)$value, 0, ',', ' ').'$';
    }

    public function valueWordsFormat($value)
    {
        $mbStrToUpper = function ($str, $encoding = 'UTF8')
        {
            return mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
        };
        
        # Все варианты написания чисел прописью от 0 до 999 скомпонуем в один небольшой массив
        $m = [
            [trans('numbers.zero')],
            ['-',trans('numbers.one'),trans('numbers.two'),trans('numbers.three'),trans('numbers.four'),trans('numbers.five'),trans('numbers.six'),trans('numbers.seven'),trans('numbers.eight'),trans('numbers.nine')],
            [trans('numbers.ten'),trans('numbers.eleven'),trans('numbers.twelve'),trans('numbers.thirteen'),trans('numbers.fourteen'),trans('numbers.fifteen'),trans('numbers.sixteen'),trans('numbers.seventeen'),trans('numbers.eighteen'),trans('numbers.nineteen')],
            ['-','-',trans('numbers.twenty'),trans('numbers.thirty'),trans('numbers.forty'),trans('numbers.fifty'),trans('numbers.sixty'),trans('numbers.seventy'),trans('numbers.eighty'),trans('numbers.ninety')],
            ['-',trans('numbers.one_hundred'),trans('numbers.two_hundred'),trans('numbers.three_hundred'),trans('numbers.four_hundred'),trans('numbers.five_hundred'),trans('numbers.six_hundred'),trans('numbers.seven_hundred'),trans('numbers.eight_hundred'),trans('numbers.nine_hundred')],
            ['-',trans('numbers.one_fe'),trans('numbers.two_fe')]
        ];

        # Все варианты написания разрядов прописью скомпануем в один небольшой массив
        $r = [
            [trans('numbers.unknown_end'),'',trans('numbers.end1'),'ов'], // используется для всех неизвестно больших разрядов
            [trans('numbers.thousand'),trans('numbers.end1'),trans('numbers.end2'),''],
            [trans('numbers.million'),'',trans('numbers.end1'),trans('numbers.end3')],
            [trans('numbers.billion'),'',trans('numbers.end1'),trans('numbers.end3')],
            [trans('numbers.trillion'),'',trans('numbers.end1'),trans('numbers.end3')],
            [trans('numbers.quadrillion'),'',trans('numbers.end1'),trans('numbers.end3')],
            [trans('numbers.quintillion'),'',trans('numbers.end1'),trans('numbers.end3')]
            // ,[... список можно продолжить
        ];

        if ($value==0) return $m[0][0]; # Если число ноль, сразу сообщить об этом и выйти
        $o = []; # Сюда записываем все получаемые результаты преобразования

        # Разложим исходное число на несколько трехзначных чисел и каждое полученное такое число обработаем отдельно
        foreach (array_reverse(str_split(str_pad($value,ceil(strlen($value)/3)*3,'0',STR_PAD_LEFT),3))as$k=>$p) {
            $o[$k] = [];

            # Алгоритм, преобразующий трехзначное число в строку прописью
            foreach ($n = str_split($p) as $kk => $pp)
                if (!$pp) continue;
                else
                    switch ($kk) {
                        case 0:$o[$k][]=$m[4][$pp];break;
                        case 1:if($pp==1){$o[$k][]=$m[2][$n[2]];break 2;}else$o[$k][]=$m[3][$pp];break;
                        case 2:if(($k==1)&&($pp<=2))$o[$k][]=$m[5][$pp];else$o[$k][]=$m[1][$pp];break;
                    } $p*=1;if(!$r[$k])$r[$k]=reset($r);

            # Алгоритм, добавляющий разряд, учитывающий окончание руского языка
            if ($p&&$k) switch (true) {
                case preg_match("/^[1]$|^\\d*[0,2-9][1]$/",$p):$o[$k][]=$r[$k][0].$r[$k][1];break;
                case preg_match("/^[2-4]$|\\d*[0,2-9][2-4]$/",$p):$o[$k][]=$r[$k][0].$r[$k][2];break;
                default: $o[$k][]=$r[$k][0].$r[$k][3];break;
            }
            $o[$k] = implode(' ',$o[$k]);
        }

        return $mbStrToUpper(implode(' ',array_reverse($o)).' '.trans('docs.dollars'));
    }
    
    public function croppedContent($content,$length)
    {
        return mb_substr(strip_tags($content),0,$length,'UTF-8').( mb_strlen(strip_tags($content), 'UTF-8') > $length ? '…' : '');
    }
}
