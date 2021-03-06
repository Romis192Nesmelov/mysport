<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Area;
use App\Event;
use App\Organization;
use App\Section;
use App\Place;
use App\KindOfSport;
use App\User;
//use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Settings;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Helper;
use Illuminate\Support\Facades\App;

trait HelperTrait
{
    private $validationEmail = 'required|email|unique:users,email';
    private $validationNoUniqueEmail = 'required|email';
    private $validationPhone = 'required|regex:/^((\+)?(\d)(\s)?(\()?[0-9]{3}(\))?(\s)?([0-9]{3})(\-)?([0-9]{2})(\-)?([0-9]{2}))$/';
    private $validationSite = 'required|url';
    private $validationUser = 'required|integer|exists:users,id';
    private $validationTrainer = 'required|integer|exists:trainers,id';
    private $validationKindOfSport = 'required|integer|exists:kind_of_sports,id';
    private $validationCharField = 'required|min:3|max:255';
    private $validationTextField = 'required|min:10|max:800';
    private $validationGender = 'required|in:M,W,М,Ж';
    private $validationPassword = 'required|confirmed|min:4|max:50';
    private $validationCoordinates = 'required|regex:/^(\d{2}\.\d{5,6})$/';
    private $validationDate = ['required','regex:/^((([0-2][0-9])|(3[0-1]))\.((0[1-9])|([0-1][0-2]))\.((19\d{2})|(20[0-2][0-9])))$/'];
    private $validationTime = ['required','regex:/^((([0-1][0-9])|(2[0-4]))\.[0-5][0-9])$/'];
    private $validationImage = 'image|min:5|max:2000';
    private $validationArea = 'required|integer|exists:areas,id';
    private $validationOrganization = 'required|integer|exists:organizations,id';
    private $validationSection = 'required|integer|exists:sections,id';
    private $validationPlace = 'required|integer|exists:places,id';
    private $validationEvent = 'required|integer|exists:events,id';
    private $trainerSocNets = ['fb','vk','inst'];
    private $validationSocNets = [
        'fb' => ['required','regex:/(?:https?:\/\/)?(?:www\.)?(mbasic.facebook|m\.facebook|facebook|fb)\.(com|me)\/(?:(?:\w\.)*#!\/)?(?:pages\/)?(?:[\w\-\.]*\/)*([\w\-\.]*)/'],
        'vk' => ['required','regex:/^(https?:\/\/(www\.)?vk\.com\/(\d|\w)+(\/)?)$/'],
        'inst' => ['required','regex:/^(https:\/\/www.instagram.com\/(\d|\w)+(\/)?)$/']
    ];
    private $metas = [
        'meta_description' => ['name' => 'description', 'property' => false],
        'meta_keywords' => ['name' => 'keywords', 'property' => false],
        'meta_twitter_card' => ['name' => 'twitter:card', 'property' => false],
        'meta_twitter_size' => ['name' => 'twitter:size', 'property' => false],
        'meta_twitter_creator' => ['name' => 'twitter:creator', 'property' => false],
        'meta_og_url' => ['name' => false, 'property' => 'og:url'],
        'meta_og_type' => ['name' => false, 'property' => 'og:type'],
        'meta_og_title' => ['name' => false, 'property' => 'og:title'],
        'meta_og_description' => ['name' => false, 'property' => 'og:description'],
        'meta_og_image' => ['name' => false, 'property' => 'og:image'],
        'meta_robots' => ['name' => 'robots', 'property' => false],
        'meta_googlebot' => ['name' => 'googlebot', 'property' => false],
        'meta_google_site_verification' => ['name' => 'robots', 'property' => false],
    ];

    private function getEventOnTheYear($useOwner=false,$useActive=true)
    {
        $this->data['year'] = date('Y');
        $limitInPast = strtotime('1/1/'.$this->data['year']);
        $limitInFuture = date('n') <= 10 ? strtotime('12/31/'.$this->data['year']) : strtotime((date('n')+4-12).'1/'.($this->data['year']+1));
        $events = Event::where('start_time','>=',$limitInPast)->where('start_time','<=',$limitInFuture);
        if ($useActive) $events->where('active',1);
        if ($useOwner) $events->where('user_id',Auth::id());
        $this->data['events_on_year'] = $events->get();
    }
    
    private function getActiveKindOfSport()
    {
        return KindOfSport::where('active',1)->get();
    }
    
    private function getActiveAreas()
    {
        return Area::where('active',1)->get();
    }

    private function getItem(Request $request, Model $model, $slug)
    {
        if ($slug) {
            $this->data['item'] = $model->where('slug',$slug)->first();
        } else {
            $this->validate($request, ['id' => 'required|integer|exists:'.$model->getTable().',id']);
            $this->data['item'] = $model->find($request->input('id'));
        }
        if (!$this->data['item']) abort(404);
    }

//    private function masterMail()
//    {
//        return (string)Settings::getSettings()->email;
//    }

    private function randString()
    {
        return md5(rand(0,100000));
    }

    private function processingFields(Request $request, $checkboxFields=null, $ignoreFields=null, $timeFields=null, $colorFields=null)
    {
        $exceptFields = ['_token','id'];
        if ($ignoreFields) {
            if (is_array($ignoreFields)) $exceptFields = array_merge($exceptFields, $ignoreFields);
            else $exceptFields[] = $ignoreFields;
        }

//        $exceptFields = array_merge($exceptFields, $this->ignoringFields);
        $fields = $request->except($exceptFields);

        if ($checkboxFields) {
            if (is_array($checkboxFields) && count($checkboxFields)) {
                foreach ($checkboxFields as $field) {
                    $fields[$field] = isset($fields[$field]) && $fields[$field] == 'on' ? 1 : 0;
                }
            } else {
                $fields[$checkboxFields] = isset($fields[$checkboxFields]) && $fields[$checkboxFields] == 'on' ? 1 : 0;
            }
        }

        if ($timeFields) {
            if (is_array($timeFields) && count($timeFields)) {
                foreach ($timeFields as $field) {
//                    $fields[$field] = Carbon::createFromTimestamp($this->convertDate($fields[$field]))->toDateTimeString();
                    $fields[$field] = $this->convertDate($fields[$field]);
                }
            } else {
//                $fields[$timeFields] = Carbon::createFromTimestamp($this->convertDate($fields[$timeFields]))->toDateTimeString();
                $fields[$timeFields] = $this->convertDate($fields[$timeFields]);
            }
        }

        if ($colorFields) {
            if (is_array($colorFields) && count($colorFields)) {
                foreach ($colorFields as $field) {
                    $fields[$field] = $this->convertColor($fields[$field]);
                }
            } else {
                $fields[$colorFields] = $this->convertColor($fields[$colorFields]);
            }
        }
        
        foreach ($fields as $name => $value) {
            if ($value === '0') $fields[$name] = null;
        }
        
        return $fields;
    }

    private function processingImage(Request $request, Model $model=null, $field=null, $name=null, $path=null)
    {
        $imageField = [];
        $field = $field ? $field : 'image';
        
        if ($request->hasFile($field)) {
            $this->unlinkFile($model, $field);

            $info = $model && $model[$field] ? pathinfo($model[$field]) : null;
            
            if ($name) $imageName = $name.'.'.$request->file($field)->getClientOriginalExtension();
            elseif ($info) $imageName = $info['filename'].'.'.$request->file($field)->getClientOriginalExtension();
            else $imageName = $this->randString().'.'.$request->file($field)->getClientOriginalExtension();
            
            if (!$path && $info) $path = $info ? $info['dirname'] : 'images';

            $request->file($field)->move(base_path('public/'.$path),$imageName);
            $imageField[$field] = $path.'/'.$imageName;
        }
        return $imageField;
    }

    private function deleteSomething(Request $request, Model $model, $files=null, $addValidation=null, $notValidate=false)
    {
        if (!$notValidate) {
            $this->validate($request, ['id' => 'required|integer|exists:'.$model->getTable().',id'.($addValidation ? '|'.$addValidation : '')]);
            $table = $model->find($request->input('id'));
        } else $table = $model; 
        $table->delete();

        if ($files) {
            if (is_array($files)) {
                foreach ($files as $file) {
                    $this->unlinkFile($table, $file);
                }
            } else $this->unlinkFile($table, $files);
        }
        
        if (isset($table->gallery) && count($table->gallery)) {
            foreach ($table->gallery as $gallery) {
                $this->unlinkFile($gallery, 'photo');
                $gallery->delete();
            }
        }
        
        return response()->json(['success' => true]);
    }

    private function unlinkFile($table, $file, $path='')
    {
        $fullPath = base_path('public/'.$path.$table[$file]);
        if (isset($table[$file]) && $table[$file] && file_exists($fullPath)) unlink($fullPath);
    }

    private function findSport($areaId=null,$kindOfSport=null,$events=1,$organizations=1,$sections=1,$places=null)
    {  
        $eventsPoints = $events ? $this->getPoints(new Event(),$areaId,false) : null;
        $organizationsPoints = $organizations ? $this->getPoints(new Organization(),$areaId,false) : null;
        $sectionsPoints = $sections ? $this->getPoints(new Section(),$areaId,$kindOfSport) : null;
        $placesPoints = $places ? $this->getPoints(new Place(),$areaId,false) : null;

        $organizationsPoints = $this->cutLeftPoints($organizationsPoints, 'sections', $kindOfSport);
        $placesPoints = $this->cutLeftPoints($placesPoints, 'sports', $kindOfSport);
        
        return [
            'events' => $eventsPoints,
            'organizations' => $organizationsPoints,
            'sections' => $sectionsPoints,
            'places' => $placesPoints
        ];
    }

    private function getPoints(Model $model, $areaId, $kindOfSport)
    {
        $model = $model->where('active',1);
        if ($areaId) $model = $model->where('area_id',$areaId);
        if ($kindOfSport) $model = $model->where('kind_of_sport_id',$kindOfSport);
        return $model->get();
    }

    private function cutLeftPoints($points, $subItems, $kindOfSport)
    {
        if ($points && $kindOfSport) {
            $matches = false;
            for ($i=0;$i<count($points);$i++) {
                foreach ($points[$i]->$subItems as $item) {
                    if ($item->kind_of_sport_id == $kindOfSport) {
                        $matches = true;
                        break;
                    }
                }
                if (!$matches) unset($points[$i]);
            }
        }
        return $points;
    }

    private function getRandomAddress($onlyStreet=false)
    {
        $streets = [
            'Литейный проспект',
            'Улица Некрасова',
            'Думская улица',
            'Набережная реки Фонтанки',
            'Улица Рубинштейна',
            'Пушкинская улица',
            'Улица Малая Садовая',
            'Фурштатская улица',
            '1-й Верхний переулок',
            '1-й Конной Лахты 2-й проезд',
            '1-й Муринский проспект',
            '1-й Озерковский переулок',
            '1-й Предпортовый проезд',
            '1-й проезд, Шушары',
            '1-й Рабфаковский переулок',
            '1-й Рыбацкий проезд',
            '1-я Алексеевская улица',
            '1-я аллея, Торики',
            '1-я Березовая аллея',
            '1-я Жерновская улица',
            '1-я Заводская улица, Старо-Паново',
            '1-я Конная Лахта улица',
            '1-я Красноармейская улица',
            '1-я линия Васильевского острова',
            '1-я линия, Володарский',
            '1-я линия, Ново-Ковалево',
            '1-я линия, Торики',
            '1-я Никитинская улица',
            '1-я Полевая улица',
            '1-я Поперечная улица',
            '1-я Советская улица',
            '1-я Тупиковая улица, Ново-Ковалево',
            '1-я Утиная улица',
            '1-я Шоссейная улица, Старо-Паново',
            '10-я Красноармейская улица',
            '10-я линия Васильевского острова',
            '10-я Советская улица',
            '11-я Красноармейская улица',
            '11-я линия Васильевского острова',
            '12-я Красноармейская улица',
            '12-я линия Васильевского острова',
            '13-я Красноармейская улица',
            '13-я линия Васильевского острова',
            '14-я линия Васильевского острова',
            '15-я линия Васильевского острова',
            '16-я линия Васильевского острова',
            '17-я линия Васильевского острова',
            '18-я линия Васильевского острова',
            '19-я линия Васильевского острова',
            '2-й Верхний переулок',
            '2-й Луч улица',
            '2-й Муринский проспект',
            '2-й Озерковский переулок',
            '2-й Предпортовый проезд',
            '2-й проезд, Горелово',
            '2-й Рабфаковский переулок',
            '2-й Рыбацкий проезд',
            '2-я Алексеевская улица',
            '2-я аллея, Лесное',
            '2-я Березовая аллея',
            '2-я Жерновская улица',
            '2-я Заводская улица, Старо-Паново',
            '2-я Комсомольская улица',
            '2-я Конная Лахта улица',
            '2-я Красноармейская улица',
            '2-я линия Васильевского острова',
            '2-я линия, Володарский',
            '2-я линия, Ново-Ковалево',
            '2-я линия, Торики',
            '2-я Никитинская улица',
            '2-я Полевая улица',
            '2-я Поперечная улица',
            '2-я Семеновская улица',
            '2-я Советская улица',
            '2-я Тупиковая улица, Ново-Ковалево',
            '2-я Утиная улица',
            '2-я Шоссейная улица, Старо-Паново',
            '20-я линия Васильевского острова',
            '21-я линия Васильевского острова',
            '22-я линия Васильевского острова',
            '23-я линия Васильевского острова',
            '24-я линия Васильевского острова',
            '25-я линия Васильевского острова',
            '26-я линия Васильевского острова',
            '27-я линия Васильевского острова',
            '28-я линия Васильевского острова',
            '29-я линия, Васильевского острова',
            '3-й Верхний переулок',
            '3-й Озерковский переулок',
            '3-й Предпортовый проезд',
            '3-й проезд, Шушары',
            '3-й Рабфаковский переулок',
            '3-й Рыбацкий проезд',
            '3-я Жерновская улица',
            '3-я Конная Лахта улица',
            '3-я Красноармейская улица',
            '3-я линия 1-й половины улица',
            '3-я линия 2-й половины улица',
            'Академика Павлова улица',
            'Академика Павлова улица, Володарский',
            'Академика Сахарова парк',
            'Академика Сахарова площадь',
            'Академика Шиманского улица',
            'Академический переулок',
            'Аккуратова улица',
            'Актерский проезд',
            'Александра Блока улица',
            'Александра Матросова улица',
            'Александра Невского площадь',
            'Александра Невского улица',
            'Александра Ульянова улица',
            'Александровская линия',
            'Александровская улица',
            'Александровская улица, Лахта',
            'Александровский парк',
            'Александровский переулок',
            'Александровской Фермы проспект',
            'Алтайская улица',
            'Альпийский переулок',
            'Амурская улица',
            'Английская набережная',
            'Английский проспект',
            'Андреевская улица',
            'Андреевская улица, Володарский',
            'Андреевская улица, Пороховые',
            'Андреевский переулок',
            'Аникушинская аллея',
            'Анисимовская дорога',
            'Аннинское шоссе',
            'Антоненко переулок',
            'Антонова-Овсеенко улица',
            'Антоновская улица',
            'Апраксин переулок',
            'Апрельская улица',
            'Аптекарская набережная',
            'Аптекарский переулок',
            'Аптекарский проспект',
            'Арктическая улица',
            'Арсенальная набережная',
            'Арсенальная улица',
            'Арсеньевский переулок',
            'Артиллерийская улица',
            'Артиллерийский переулок',
            'Асафьева улица',
            'Астраханская улица',
            'Атаманская улица',
            'АТП-71 Дубовая улица',
            'АТП-71 Зеленая улица',
            'АТП-71 Садовая улица',
            'АТП-71 Языков переулок',
            'Афанасьевская улица',
            'Афонская улица',
            'Аэродромная улица',
            'Бабанова улица',
            'Бабанова улица, Володарский',
            'Бабушкина парк',
            'Бабушкина улица',
            'Бадаева улица',
            'Байконурская улица',
            'Бакунина проспект',
            'Балканская площадь',
            'Балканская улица',
            'Балтийская улица',
            'Балтийских Юнг площадь',
            'Балтийского вокзала площадь',
            'Балтфлота площадь',
            'Банковский переулок',
            'Барклаевская улица',
            'Бармалеева улица',
            'Барочная улица',
            'Баррикадная улица',
            'Басков переулок',
            'Бассейная улица',
            'Батайский переулок',
            'Батарейная дорога',
            'Беговая улица',
            'Безымянная улица',
            'Безымянный переулок',
            'Белградская улица',
            'Белевский проспект',
            'Белинского площадь',
            'Белинского улица',
            'Беловодский переулок',
            'Беломорская улица',
            'Белоостровская улица',
            'Белорусская улица',
            'Белосельский переулок'
        ];
        
        return $streets[rand(0,count($streets)-1)].($onlyStreet ? '' : ' д.'.rand(1,50).(rand(0,1) ? ' стр.'.rand(1,10) : ''));
    }

    private function getRandomPhone()
    {
        return '+7(812)'.rand(1,9).rand(1,9).rand(1,9).'-'.rand(1,9).rand(1,9).'-'.rand(1,9).rand(1,9);
    }

    private function getRandomEmail()
    {
        return strtolower(str_random(5)).'@mail.ru';
    }

    private function getRandomSite()
    {
        return 'http://'.strtolower(str_random(5)).'.ru';
    }

    private function getRandomCoordinates($areaId)
    {
        $areaId--;
        $areasCoords = [
            ['latitude' => 59.916825,'longitude' => 30.297542],
            ['latitude' => 59.941425,'longitude' => 30.248045],
            ['latitude' => 60.050448,'longitude' => 30.328696],
            ['latitude' => 59.997685,'longitude' => 30.396824],
            ['latitude' => 59.876391,'longitude' => 30.257603],
            ['latitude' => 59.775082,'longitude' => 30.595792],
            ['latitude' => 59.964458,'longitude' => 30.460398],
            ['latitude' => 59.790793,'longitude' => 30.121823],
            ['latitude' => 60.013056,'longitude' => 29.714374],
            ['latitude' => 60.181218,'longitude' => 29.864878],
            ['latitude' => 59.852176,'longitude' => 30.323073],
            ['latitude' => 59.881932,'longitude' => 30.464602],
            ['latitude' => 59.967687,'longitude' => 30.281660],
            ['latitude' => 59.877791,'longitude' => 29.866827],
            ['latitude' => 60.017715,'longitude' => 30.185145],
            ['latitude' => 59.696674,'longitude' => 30.421276],
            ['latitude' => 59.869964,'longitude' => 30.390788],
            ['latitude' => 59.930908,'longitude' => 30.361817],
        ];

        $latitude = round($areasCoords[$areaId]['latitude'] - $this->getRandomCoords(),6);
        $longitude = round($areasCoords[$areaId]['longitude'] - $this->getRandomCoords(),6);
        return [$latitude,$longitude];
    }

    private function getRandomCoords()
    {
        return rand(-100000,100000)/1000000;
    }

    private function convertDate($date)
    {
        $date = explode('.', $date);
        return strtotime($date[1].'/'.$date[0].'/'.$date[2]);
    }
    
    private function convertTime($time)
    {
        $time = explode('.', $time);
        return (60 * 60 * $time[0]) + (60 * $time[1]);
    }

    private function getMoscowTimeZone($timestamp)
    {
        return $timestamp - (60 * 60 * 3);
    }

    private function convertColor($color)
    {
        if (preg_match('/^(hsv\(\d+\, \d+\%\, \d+\%\))$/',$color)) {
            $hsv = explode(',',str_replace(['hsv','(',')','%',' '],'',$color));
            $color = $this->fGetRGB($hsv[0],$hsv[1],$hsv[2]);
        }
        return $color;
    }

    private function fGetRGB($iH, $iS, $iV)
    {
        if($iH < 0)   $iH = 0;   // Hue:
        if($iH > 360) $iH = 360; //   0-360
        if($iS < 0)   $iS = 0;   // Saturation:
        if($iS > 100) $iS = 100; //   0-100
        if($iV < 0)   $iV = 0;   // Lightness:
        if($iV > 100) $iV = 100; //   0-100
        $dS = $iS/100.0; // Saturation: 0.0-1.0
        $dV = $iV/100.0; // Lightness:  0.0-1.0
        $dC = $dV*$dS;   // Chroma:     0.0-1.0
        $dH = $iH/60.0;  // H-Prime:    0.0-6.0
        $dT = $dH;       // Temp variable
        while($dT >= 2.0) $dT -= 2.0; // php modulus does not work with float
        $dX = $dC*(1-abs($dT-1));     // as used in the Wikipedia link
        switch(floor($dH)) {
            case 0:
                $dR = $dC; $dG = $dX; $dB = 0.0; break;
            case 1:
                $dR = $dX; $dG = $dC; $dB = 0.0; break;
            case 2:
                $dR = 0.0; $dG = $dC; $dB = $dX; break;
            case 3:
                $dR = 0.0; $dG = $dX; $dB = $dC; break;
            case 4:
                $dR = $dX; $dG = 0.0; $dB = $dC; break;
            case 5:
                $dR = $dC; $dG = 0.0; $dB = $dX; break;
            default:
                $dR = 0.0; $dG = 0.0; $dB = 0.0; break;
        }
        $dM  = $dV - $dC;
        $dR += $dM; $dG += $dM; $dB += $dM;
        $dR *= 255; $dG *= 255; $dB *= 255;
        return 'rgb('.round($dR).', '.round($dG).', '.round($dB).')';
    }

    public function transliteration($string)
    {
        return str_replace('_',' ',str_slug($string));
    }

    public function sendMessage($destination, $template, array $fields, $copyTo=null, $pathToFile=null)
    {
        $title = (string)Settings::getSeoTags()['title'];
        Mail::send($template, $fields, function($message) use ($title, $pathToFile, $destination, $copyTo) {
            $message->subject(trans('auth.message_from').$title);
            $message->from(Config::get('app.master_mail'), $title);
            $message->to($destination);
            if ($copyTo) $message->cc($copyTo);
            if ($pathToFile) $message->attach($pathToFile);
        });
    }
}