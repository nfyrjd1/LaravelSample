<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\Blog\Admin\CategoryCreateRequest;
use App\Http\Requests\Blog\Admin\CategoryUpdateRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = BlogCategory::paginate(20);
        return view('blog.admin.category.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = BlogCategory::all();
        return view('blog.admin.category.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {
        $data = $request->all();
        
        if (empty($data['slug'])) {
            $data['slug'] = str_slug($data['title']);
        }

        $item = new BlogCategory($data);
        $item->save();

        if ($item) {
            return redirect()
                ->route('blog.admin.category.edit', $item->id)
                ->with(['success' => 'Запись успешно сохранена']);
        } else {
            back()
                ->withErrors(['msg' => "Не удалось сохранить данные"])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = BlogCategory::findOrFail($id);
        $categoryList = BlogCategory::where('id', '!=', $id)->get();
        return view('blog.admin.category.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        $item = BlogCategory::find($id);
        if (empty($item)) {
            //Редирект на прошлый роут
            return back()
                ->withErrors(['msg' => "Не удалось найти запись id = $id"])
                //Возвращает только что полученные данные обратно на форму, чтобы не перезатереть ввод пользователя
                ->withInput();
        }

        $data = $request->all();
        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.category.edit', $id)
                ->with(['success' => 'Запись успешно сохранена']);
        } else {
            back()
                ->withErrors(['msg' => "Не удалось сохранить данные"])
                ->withInput();
        }
    }
}
