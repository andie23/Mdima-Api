<?php

namespace App\Lib;

class ArrayEntityBuilder
{
    public static function buildArrayList($entities, $index=null)
    {
        $arrayEntities = [];

        foreach($entities as $data)
        {
            $arrayEntities[] = $data[$index];
        }
        return $arrayEntities;
    }

    public static function buildNumericIndexedAssocArray($entities)
    {

        $assocArrayEntities = [];
        foreach ($entities as $entity)
        {
            $assocArrayEntities[]= $entity;
        }
        return $assocArrayEntities;
    }

    public static function buildAssocArray($entities, $index, $useNumbericIndex=false)
    {
        $assocArrayEntities = [];
        foreach ($entities as $entity)
        {
            if($useNumbericIndex)
            {
                $assocArrayEntities[$entity[$index]][]= $entity;
                continue;
            }
            $assocArrayEntities[$entity[$index]]= $entity;
        }
        return $assocArrayEntities;
    }
}