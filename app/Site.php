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

    #Frontend

    public static function getSubCategories($cateSlug)
    {
        return Category::findBySlug($cateSlug);
    }

    public static function getFrontendBanners()
    {
        return Banner::all();
    }

    public static function getLatestIndexPosts()
    {
        return Post::where('status', true)->latest('created_at')->limit(3)->get();
    }

    public static function getLatestQuestions()
    {
        return Question::where('status', true)->latest('created_at')->limit(3)->get();
    }

    public static function getRightIndexVideos()
    {
        $rightIndexModules = Module::where('key_type', 'index_right')->where('key_content', 'videos')->pluck('key_value')->all();
        return Video::where('status', true)->whereIn('id', $rightIndexModules)->latest('created_at')->limit(4)->get();
    }

    public static function getRightQuanTam()
    {
        $rightFeatureModules = Module::where('key_type', 'right_quantam')->where('key_content', 'posts')->pluck('key_value')->all();

        return Post::where('status', true)
            ->whereIn('id', $rightFeatureModules)
            ->latest('created_at')
            ->limit(4)
            ->get();
    }

    public static function getRightFeaturePosts($page)
    {
        if (in_array($page, ['index', 'lien-he', 'video', 'hoi-dap', 'phan-phoi','san-pham', 'tu-khoa'])) {
            $category = Category::findBySlug('tin-tuc');
        } else {
            $category = Category::findBySlug($page);
        }

        $rightFeatureModules = Module::where('key_type', 'right_feature')->where('key_content', 'posts')->pluck('key_value')->all();

        if ($category->subCategories->count() == 0) {
            return Post::where('status', true)
                ->where('category_id', $category->id)
                ->whereIn('id', $rightFeatureModules)
                ->latest('created_at')
                ->limit(4)
                ->get();
        } else {
            return Post::where('status', true)
                ->whereIn('category_id', $category->subCategories->pluck('id')->all())
                ->whereIn('id', $rightFeatureModules)
                ->latest('created_at')
                ->limit(4)
                ->get();
        }
    }
    public static function getLatestNews()
    {
        $category = Category::findBySlug('tin-tuc');
        if ($category->subCategories->count() == 0) {
            return Post::where('status', true)
                ->where('category_id', $category->id)
                ->latest('created_at')
                ->limit(4)
                ->get();
        } else {
            return Post::where('status', true)
                ->whereIn('category_id', $category->subCategories->pluck('id')->all())
                ->latest('created_at')
                ->limit(4)
                ->get();
        }
    }
}