<?php

namespace App\Utils;

use DateTime;
use function PHPUnit\Framework\throwException;

class CompareDates
{
    static public function isGreater($date1, $date2){

        $errorMessage = "";

        if(gettype($date1) === 'string'){
            $date1formated = date_create($date1)->format('YmdHis');
        } else if (gettype($date1) === 'object') {
            if (get_class($date1) === 'DateTime') {
                $date1formated = $date1->format('YmdHis');
            }
        }

        if(!$date1formated){
            $errorMessage .= "Argument \$date1 should be a DateTime object or a valid format string.";
        }

        if(gettype($date2) === 'string'){
            $date2formated = date_create($date2)->format('YmdHis');
        } else if (gettype($date2) === 'object') {
            if (get_class($date2) === 'DateTime') {
                $date2formated = $date2->format('YmdHis');
            }
        }

        if(!$date2formated){
            $errorMessage .= "Argument \$date2 should be a DateTime object or a valid format string.";
        }

        if($errorMessage !== ""){
            throw new \Exception($errorMessage);
        }

        if($date1formated > $date2formated){
            return true;
        } else {
            return false;
        }
    }

    static public function isLess(DateTime | string $date1, DateTime | string $date2){

        $errorMessage = "";

        if(gettype($date1) === 'string'){
            $date1formated = date_create($date1)->format('YmdHis');
        } else if (gettype($date1) === 'object') {
            if (get_class($date1) === 'DateTime') {
                $date1formated = $date1->format('YmdHis');
            }
        }

        if(!$date1formated){
            $errorMessage .= "Argument \$date1 should be a DateTime object or a valid format string.";
        }

        if(gettype($date2) === 'string'){
            $date2formated = date_create($date2)->format('YmdHis');
        } else if (gettype($date2) === 'object') {
            if (get_class($date2) === 'DateTime') {
                $date2formated = $date2->format('YmdHis');
            }
        }

        if(!$date2formated){
            $errorMessage .= "Argument \$date2 should be a DateTime object or a valid format string.";
        }

        if($errorMessage !== ""){
            throw new \Exception($errorMessage);
        }

        if($date1formated < $date2formated){
            return true;
        } else {
            return false;
        }
    }
}
