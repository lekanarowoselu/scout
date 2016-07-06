<?php
/**
 * Created by PhpStorm.
 * User: backend1
 * Date: 6/28/16
 * Time: 1:53 PM
 */

namespace AppBundle\Service;


class Slugify
{


    public  function slugify($str, $char )
    {

        // Lower case the string and remove whitespace from the beginning or end
        $str = trim(strtolower($str));

        // Remove single quotes from the string
        $str = str_replace("'", "", $str);

       // Every character other than a-z, 0-9 will be replaced with a single dash (-)
       $str = preg_replace("/[^a-z0-9]+/", $char, $str);

       // Remove any beginning or trailing dashes
       $str = trim($str, $char);

        return $str;
     }

}



?>