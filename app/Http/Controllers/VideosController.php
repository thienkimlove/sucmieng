<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Validator;

class VideosController extends AdminController
{

    public $model = 'videos';

    public $validator = [
        'title' => 'required'
    ];

    private function init()
    {
        return '\\App\\' . ucfirst(str_singular($this->model));
    }

    public function index(Request $request)
    {
        $modelClass = $this->init();
        $searchKeyword = null;
        $searchCate = null;
        $contents = $modelClass::latest('created_at');

        if ($request->input('q')) {
            $searchKeyword = urldecode($request->input('q'));
            $contents = $contents->where('title', 'like', '%'.$searchKeyword.'%');
        }

        if ($request->input('cat')) {
            $searchCate = $request->input('cat');
            $category = Category::find($searchCate);
            $contents = ($category->subCategories->count() == 0) ? $contents->where('category_id', $category->id) : $contents->whereIn('category_id', $category->subCategories->pluck('id')->all());
        }

        $contents = $contents->paginate(config('site.item_per_page'));

        return view('admin.'.$this->model.'.index', compact('contents', 'searchKeyword', 'searchCate'))->with('model', $this->model);
    }

    public function create()
    {
        $modelClass = $this->init();
        $content = new $modelClass;
        return view('admin.'.$this->model.'.form', compact('content'))->with('model', $this->model);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validator);

        if ($validator->fails()) {
            return redirect('admin/'.$this->model.'/create')
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->all();

        if ($request->file('image') && $request->file('image')->isValid()) {
            $data['image'] = $this->saveImage($request->file('image'));
        } else {
            unset($data['image']);
        }


        $modelClass = $this->init();
        $content = $modelClass::create($data);

        $tagIds = [];
        if (isset($data['tag_list']) && $data['tag_list']) {
            foreach ($request->input('tag_list') as $tag) {
                $tagIds[] = Tag::firstOrCreate(['title' => $tag])->id;
            }
        }

        if ($tagIds) {
            $content->tags()->sync($tagIds);
        }


        flash()->success('Thêm mới thành công!');
        return redirect('admin/'.$this->model);

    }

    public function edit($id)
    {
        $modelClass = $this->init();
        $content = $modelClass::find($id);
        return view('admin.'.$this->model.'.form', compact('content'))->with('model', $this->model);
    }

    public function update($id, Request $request)
    {

        $validator = Validator::make($request->all(), $this->validator);

        if ($validator->fails()) {
            return redirect('admin/'.$this->model.'/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }
        $modelClass = $this->init();
        $content = $modelClass::find($id);
        $data = $request->all();
        if ($request->file('image') && $request->file('image')->isValid()) {
            $data['image'] = $this->saveImage($request->file('image'), $content->image);
        } else {
            unset($data['image']);
        }
        $content->update($data);

        $tagIds = [];
        if (isset($data['tag_list']) && $data['tag_list']) {
            foreach ($request->input('tag_list') as $tag) {
                $tagIds[] = Tag::firstOrCreate(['title' => $tag])->id;
            }
        }

        if ($tagIds) {
            $content->tags()->sync($tagIds);
        }

        flash()->success('Chỉnh sửa thành công!');
        return redirect('admin/'.$this->model);
    }

    public function destroy($id)
    {
        $modelClass = $this->init();
        $content = $modelClass::find($id);
        $content->delete();
        flash()->success('Xóa thành công!');
        return redirect('admin/'.$this->model);
    }
}