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

    public static function buildAssocArray($entities, $index)
    {
        $assocArrayEntities = [];
        foreach ($entities as $entity)
        {
            $assocArrayEntities[$entity[$index]]= $entity;
        }
        return $assocArrayEntities;
    }
}