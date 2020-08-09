<?php


namespace App\Helpers;


class AppHelper
{
    public static function instance()
    {
        return new AppHelper();
    }

    public function dates()
    {
        return [
            '01' => 'FIRST', '02' => 'SECOND', '03' => 'THIRD', '04' => 'FOURTH', '05' => 'FIFTH',
            '06' => 'SIXTH', '07' => 'SEVENTH', '08' => 'EIGHTH', '09' => 'NINTH', '10' => 'TENTH',
            '11' => 'ELEVENTH', '12' => 'TWELFTH', '13' => 'THIRTEENTH', '14' => 'FOURTEENTH', '15' => 'FIFTEENTH',
            '16' => 'SIXTEENTH', '17' => 'SEVENTEENTH', '18' => 'EIGHTEENTH', '19' => 'NINETEENTH', '20' => 'TWENTIETH',
            '21' => 'TWENTY FIRST', '22' => 'TWENTY SECOND', '23' => 'TWENTY THIRD', '24' => 'TWENTY FOURTH', '25' => 'TWENTY FIFTH',
            '26' => 'TWENTY SIXTH', '27' => 'TWENTY SEVENTH', '28' => 'TWENTY EIGHTH', '29' => 'TWENTY NINTH', '30' => 'THIRTIETH',
            '31' => 'THIRTY FIRST',
        ];
    }
}