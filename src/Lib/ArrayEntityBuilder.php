<?php

namespace App\Lib;

class ArrayEntityBuilder
{
    public static function build($entities, $key=null)
    {
        $arrayEntities = [];

        foreach($entities as $index => $data)
        {
            if ($key){
                $arrayEntities[$index] = $data[$key];
            }else{
                $arrayEntities[] = $data;
            }
        }
        return $arrayEntities;
    }
}