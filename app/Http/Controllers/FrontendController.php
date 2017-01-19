<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contact;
use App\Delivery;
use App\Module;
use App\Post;
use App\Product;
use App\Question;
use App\Tag;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FrontendController extends Controller
{

    protected function generateMeta($case = null, $meta = [], $mainContent = null)
    {
        $defaultLogo = url(env('LOGO_URL'));
        switch ($case) {
            default :
                return [
                    'meta_title' => env('META_INDEX_TITLE'),
                    'meta_desc' => env('META_INDEX_DESC'),
                    'meta_keywords' => env('META_INDEX_KEYWORD'),
                    'meta_url' => url('/'),
                    'meta_image' => $defaultLogo
                ];
                break;

            case 'lien-he' :
                return [
                    'meta_title' => env('META_CONTACT_TITLE'),
                    'meta_desc' => env('META_CONTACT_DESC'),
                    'meta_keywords' => env('META_CONTACT_KEYWORD'),
                    'meta_url' => url('lien-he'),
                    'meta_image' => $defaultLogo
                ];
                break;
            case 'video' :

                return [
                    'meta_title' => !empty($meta['title']) ? $meta['title'] : env('META_VIDEO_TITLE'),
                    'meta_desc' => !empty($meta['desc']) ? $meta['desc'] : env('META_VIDEO_DESC'),
                    'meta_keywords' => !empty($meta['keywords']) ? $meta['keywords'] : env('META_VIDEO_KEYWORD'),
                    'meta_url' => ($mainContent) ? url('video/' . $mainContent->slug) : url('video'),
                    'meta_image' => ($mainContent) ? url('img/cache/120x120/' . $mainContent->image) : $defaultLogo
                ];

                break;

            case 'san-pham' :

                return [
                    'meta_title' => !empty($meta['title']) ? $meta['title'] : env('META_PRODUCT_TITLE'),
                    'meta_desc' => !empty($meta['desc']) ? $meta['desc'] : env('META_PRODUCT_DESC'),
                    'meta_keywords' => !empty($meta['keywords']) ? $meta['keywords'] : env('META_PRODUCT_KEYWORD'),
                    'meta_url' => ($mainContent) ? url('san-pham/' . $mainContent->slug) : url('san-pham'),
                    'meta_image' => ($mainContent) ? url('img/cache/120x120/' . $mainContent->image) : $defaultLogo
                ];

            case 'hoi-dap' :

                return [
                    'meta_title' => !empty($meta['title']) ? $meta['title'] : env('META_QUESTION_TITLE'),
                    'meta_desc' => !empty($meta['desc']) ? $meta['desc'] : env('META_QUESTION_DESC'),
                    'meta_keywords' => !empty($meta['keywords']) ? $meta['keywords'] : env('META_QUESTION_KEYWORD'),
                    'meta_url' => ($mainContent) ? url('hoi-dap/' . $mainContent->slug) : url('hoi-dap'),
                    'meta_image' => ($mainContent) ? url('img/cache/120x120/' . $mainContent->image) : $defaultLogo
                ];



            case 'post' :
                return [
                    'meta_title' => $meta['title'],
                    'meta_desc' => $meta['desc'],
                    'meta_keywords' => $meta['keywords'],
                    'meta_url' => url($mainContent->slug . '.html'),
                    'meta_image' => url('img/cache/120x120/' . $mainContent->image)
                ];
                break;
            case 'category' :
                return [
                    'meta_title' => $meta['title'],
                    'meta_desc' => $meta['desc'],
                    'meta_keywords' => $meta['keywords'],
                    'meta_url' => url($mainContent->slug),
                    'meta_image' => $defaultLogo
                ];
                break;

            case 'tu-khoa' :
                return [
                    'meta_title' => $meta['title'],
                    'meta_desc' => $meta['desc'],
                    'meta_keywords' => $meta['keywords'],
                    'meta_url' => url('tu-khoa', $mainContent->slug),
                    'meta_image' => $defaultLogo
                ];
                break;

        }

    }


    public function index()
    {
        $page = 'index';

        $indexSliderModules = Module::where('key_type', 'index_slider')->where('key_content', 'posts')->pluck('key_value')->all();

        $sliderPosts = Post::where('status', true)->whereIn('id', $indexSliderModules)->get();

        return view('frontend.index', compact(
            'page',
            'sliderPosts'
        ))->with($this->generateMeta());

    }

    public function contact()
    {
        $page = 'lien-he';
        return view('frontend.contact', compact('page'))->with($this->generateMeta('lien-he'));
    }

    public function saveContact()
    {
        Contact::create(request()->all());
        return redirect('/');
    }


    public function main($value)
    {

        if (preg_match('/([a-z0-9\-]+)\.html/', $value, $matches)) {

            $mainPost = Post::findBySlug($matches[1]);
            $mainPost->increment('views', 1);

            $page = $mainPost->category->slug;

            $detail = 1;

            return view('frontend.post', compact('mainPost', 'page', 'detail'))->with($this->generateMeta('post', [
                'title' => ($mainPost->seo_title) ? $mainPost->seo_title : $mainPost->title,
                'desc' => $mainPost->desc,
                'keywords' => ($mainPost->tagList) ? implode(',', $mainPost->tagList) : null,
            ], $mainPost));

        } else {

            $category = Category::findBySlug($value);

            if ($category->subCategories->count() == 0) {
                //child categories
                $posts = Post::where('status', true)
                    ->where('category_id', $category->id)
                    ->latest('created_at')
                    ->paginate(10);

            } else {
                //parent categories
                $posts = Post::where('status', true)
                    ->whereIn('category_id', $category->subCategories->pluck('id')->all())
                    ->latest('created_at')
                    ->paginate(10);

            }

            $page = $category->slug;

            return view('frontend.category', compact(
                'category', 'posts', 'page'
            ))->with($this->generateMeta('category', [
                'title' => ($category->seo_title) ?  $category->seo_title : $category->title,
                'desc' =>  ($category->desc)? $category->desc : null,
                'keywords' => ($category->keywords)? $category->keywords : null,
            ], $category));


        }
    }

    public function question($value = null)
    {
        $page = 'hoi-dap';
        $mainQuestion = null;
        $meta_title = $meta_desc = $meta_keywords = null;
        $view = 'question';
        $detail = null;
        if ($value) {
            $mainQuestion = Question::findBySlug($value);
            $meta_title = ($mainQuestion->seo_title) ? $mainQuestion->seo_title : $mainQuestion->title;
            $meta_desc = $mainQuestion->desc;
            $meta_keywords = $mainQuestion->keywords;
            $view = 'question_detail';
            $detail = 1;
        }
        $questions = Question::where('status', true)->paginate(10);
        return view('frontend.'.$view, compact('questions', 'mainQuestion', 'page', 'detail'))->with($this->generateMeta('hoi-dap', [
            'title' => $meta_title,
            'desc' => $meta_desc,
            'keywords' => $meta_keywords,
        ], $mainQuestion));
    }


    public function delivery($value = null)
    {
        $page = 'phan-phoi';
        $meta_title = $meta_desc = $meta_keywords = null;
        if ($value) {
            $delivery = Delivery::find($value);
            $meta_title = $delivery->seo_title;
            $meta_desc = $delivery->desc;
            $meta_keywords = $delivery->keywords;
            $detail = 1;

            return view('frontend.detail_delivery', compact('delivery', 'page', 'detail'))->with($this->generateMeta('phan-phoi', [
                'title' => $meta_title,
                'desc' => $meta_desc,
                'keywords' => $meta_keywords,
            ], $delivery));
        } else {
            $totalDeliveries = [];
            foreach (config('delivery')['area'] as $key => $area) {
                $totalDeliveries[$area] = Delivery::where('area', $key)->get();
            }

            return view('frontend.delivery', compact('totalDeliveries', 'page', 'page_css'))->with($this->generateMeta('phan-phoi', [
                'title' => $meta_title,
                'desc' => $meta_desc,
                'keywords' => $meta_keywords,
            ]));
        }
    }

    public function product()
    {
        $page = 'san-pham';
        $product = Product::latest('created_at')->limit(1)->get()->first();
        $meta_title = ($product->seo_title) ? $product->seo_title : $product->title;
        $meta_desc = $product->desc;
        $meta_keywords = $product->keywords;

        return view('frontend.product', compact('product', 'page'))->with($this->generateMeta('san-pham', [
            'title' => $meta_title,
            'desc' => $meta_desc,
            'keywords' => $meta_keywords,
        ], $product));
    }

    public function video($value = null)
    {
        $page = 'video';
        $mainVideo = null;
        $meta_title = $meta_desc = $meta_keywords = null;
        $videos = Video::paginate(6);

        $detail = null;


        if ($value) {
            $mainVideo = Video::findBySlug($value);
            $meta_title = ($mainVideo->seo_title) ? $mainVideo->seo_title : $mainVideo->title;
            $meta_desc = $mainVideo->desc;
            $meta_keywords = $mainVideo->keywords;
            $mainVideo->increment('views', 1);
            $detail = 1;
        }


        return view('frontend.video', compact('videos', 'mainVideo', 'page', 'detail'))->with($this->generateMeta('video', [
            'title' => $meta_title,
            'desc' => $meta_desc,
            'keywords' => $meta_keywords,
        ], $mainVideo));

    }

    public function tag($value)
    {
        $page = 'tu-khoa';

        $tag = Tag::findBySlug($value);

        $meta_title = ($tag->seo_title) ? $tag->seo_title : $tag->name;
        $meta_desc = $tag->desc;
        $meta_keywords = $tag->keywords;

        $posts = Post::where('status', true)
            ->whereHas('tags', function ($q) use ($tag) {
                $q->where('id', $tag->id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.tag', compact('posts', 'tag', 'page'))->with
        ($this->generateMeta('tu-khoa', [
            'title' => $meta_title,
            'desc' => $meta_desc,
            'keywords' => $meta_keywords,
        ], $tag));
    }

}