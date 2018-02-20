<?php

namespace Fresh\Nashemisto\Http\Controllers;

use Fresh\Nashemisto\Repositories\CaptchaRepository;
use Fresh\Nashemisto\Repositories\InformRepository;
use Illuminate\Http\Request;
use Lang;

class InformController extends MainController
{
    protected $repository;

    /**
     * InformController constructor.
     * @param InformRepository $repository
     */
    public function __construct(InformRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function show(Request $request)
    {
        if ($request->isMethod('post')) {

            if (!$request->has('g-recaptcha-response')) {
                return back()->withInput()->withErrors([Lang::get('ua.re-enter')]);
            }

            $captcha = $request->input('g-recaptcha-response');
            if (false == CaptchaRepository::run($captcha)) {
                return back()->withInput()->withErrors([Lang::get('ua.re-enter')]);
            }

            $result = $this->repository->send($request);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withInput()->withErrors($result['error']);
            }
            return redirect()->back()->with($result);
        }

        $this->jss = '<script src="' . asset('js/add-news.js') . '"></script>';

        $text = $this->repository->findById(1);
        $this->content = view('static.inform')->with(compact('text'))->render();
        return $this->renderOutput();
    }
}
