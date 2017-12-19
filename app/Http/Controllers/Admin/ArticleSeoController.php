<?php

namespace Fresh\Nashemisto\Http\Controllers\Admin;

use Fresh\Nashemisto\Repositories\ArticleSeoRepository;
use Illuminate\Http\Request;
use Gate;

class ArticleSeoController extends AdminController
{
    public function updateSeo(Request $request, $article)
    {
        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }

        $article->load('seo');

        if ($request->isMethod('post')) {

            $repository = new ArticleSeoRepository();

            $result = $repository->updateSeo($request, $article);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }

            return redirect()->back()->with($result);
        }

        $this->title = 'Редагувати SEO';
        $this->template = 'admin.admin';

        $this->content = view('admin.seo.update')->with(['article_id' => $article->id, 'seo' => $article->seo])->render();

        return $this->renderOutput();
    }
}
