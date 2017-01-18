<?php

namespace App;

class Site
{
    public static function moduleEnable($key_type, $key_content, $key_value)
    {
        $modules = Module::where('key_type', $key_type)
            ->where('key_content', $key_content)
            ->where('key_value', $key_value)
            ->get();

        return ($modules->count() > 0)? $modules->first() : null;
    }

    public static function getCategories()
    {
        return array(0 => 'Chọn chuyên mục cha') + Category::pluck('title', 'id')->all();
    }

    public static function getNoSubCategories()
    {
        return array(0 => 'Chọn chuyên mục') + Category::doesntHave('subCategories')->pluck('title', 'id')->all();
    }


    public static function getStatus()
    {
        return array(1 => 'Active', 0 => 'Inactive');
    }

    public static function getBannerPositions()
    {
        return array(0 => 'Chọn vị trí') + Position::pluck('name', 'id')->all();
    }
}