<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Area;
use App\KindOfSport;
use App\Event;
use App\Organization;
use App\Section;
use App\Place;
//use App\User;
//use Carbon\Carbon;
use Illuminate\Support\Facades\Settings;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

trait HelperTrait
{
    public $validationPhone = 'required|regex:/^((\+)?(\d)(\s)?(\()?[0-9]{3}(\))?(\s)?([0-9]{3})(\-)?([0-9]{2})(\-)?([0-9]{2}))$/';
    public $validationUser = 'required|integer|exists:users,id';
    public $validationPassword = 'required|confirmed|min:8|max:50';
    public $validationCoordinates = 'required|regex:/^(\d{2}\.\d{5,6})$/';
    public $validationDate = 'required|regex:/^(((\d){2}\.){2}(\d){4})$/';
    public $validationImage = 'image|min:5|max:5000';
    public $validationArea = 'required|integer|exists:areas,id';
    public $metas = [
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
    
    public function masterMail()
    {
        return (string)Settings::getSettings()->email;
    }
      
    public function randString()
    {
        return md5(rand(0,100000));
    }

    public function processingFields(Request $request, $checkboxFields=null, $ignoreFields=null, $timeFields=null, $colorFields=null)
    {

        $exceptFields = ['_token','id'];
        if ($ignoreFields) {
            if (is_array($ignoreFields)) $exceptFields = array_merge($exceptFields, $ignoreFields);
            else $exceptFields[] = $ignoreFields;
        }

//        $exceptFields = array_merge($exceptFields, $this->ignoringFields);
        $fields = $request->except($exceptFields);

        if ($checkboxFields) {
            if (is_array($checkboxFields)) {
                foreach ($checkboxFields as $field) {
                    $fields[$field] = isset($fields[$field]) && $fields[$field] == 'on' ? 1 : 0;
                }
            } else {
                $fields[$checkboxFields] = isset($fields[$checkboxFields]) && $fields[$checkboxFields] == 'on' ? 1 : 0;
            }
        }

        if ($timeFields) {
            if (is_array($timeFields)) {
                foreach ($timeFields as $field) {
//                    $fields[$field] = Carbon::createFromTimestamp(strtotime($this->convertTime($fields[$field])))->toDateTimeString();
                    $fields[$field] = strtotime($this->convertTime($fields[$field]));
                }
            } else {
//                $fields[$timeFields] = Carbon::createFromTimestamp(strtotime($this->convertTime($fields[$timeFields])))->toDateTimeString();
                $fields[$timeFields] = strtotime($this->convertTime($fields[$timeFields]));
            }
        }

        if ($colorFields) {
            if (is_array($colorFields)) {
                foreach ($colorFields as $field) {
                    $fields[$field] = $this->convertColor($fields[$field]);
                }
            } else {
                $fields[$colorFields] = $this->convertColor($fields[$colorFields]);
            }
        }
        return $fields;
    }

    public function processingImage(Request $request, Model $model=null, $field=null, $name=null, $path=null)
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

    public function unlinkFile($table, $file, $path='')
    {
        $fullPath = base_path('public/'.$path.$table[$file]);
        if (isset($table[$file]) && $table[$file] && file_exists($fullPath)) unlink($fullPath);
    }

    public function findSport($areaId=null,$kindOfSport=null,$events=1,$organizations=1,$sections=1,$places=1)
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
    
    public function getRandomCoordinates($areaId)
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

        $latitude = $areasCoords[$areaId]['latitude'] - $this->getRandomCoords();
        $longitude =$areasCoords[$areaId]['longitude'] - $this->getRandomCoords();
        return [$latitude,$longitude];
    }

    private function getRandomCoords()
    {
        return rand(-100000,100000)/1000000;
    }

    private function convertTime($time)
    {
        $time = explode('.', $time);
        return $time[1].'/'.$time[0].'/'.$time[2];
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