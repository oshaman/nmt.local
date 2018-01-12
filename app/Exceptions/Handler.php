<?php

namespace Fresh\Nashemisto\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Cache;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {

            return redirect()
                ->back()
                ->withInput($request->except('_token'))
                ->withErrors('Время Вашей сессии истекло, повторите запрос.');

        }

        if ($this->isHttpException($exception)) {
            $statusCode = $exception->getStatusCode();
            switch ($statusCode) {
                case '404' :
                    $articles = Cache::remember('404', 24 * 60, function () {
                        $result = \Fresh\Nashemisto\Article::where([['approved', 1]])
                            ->with(['image', 'category'])->take(6)->orderBy('created_at', 'desc')->get();

                        $result->transform(function ($item) {

                            if ($item->created_at) {
                                $created = strtotime($item->created_at);

                                $item->date = date('d.m.Y', $created);
                                $item->time = date('H:i', $created);
                            }

                            return $item;

                        });

                        return $result;
                    });

                    $header = view('layouts.header')->render();
                    $footer = view('layouts.footer')->render();
                    return response()->view('errors.404',
                        ['header' => $header, 'footer' => $footer, 'articles' => $articles, 'title' => '404'], 404);
            }
        }

        return parent::render($request, $exception);
    }
}
