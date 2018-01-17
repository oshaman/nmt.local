<?php

namespace Fresh\Nashemisto\Http\Controllers\Admin;

use Fresh\Nashemisto\Http\Requests\ChannelRequest;
use Fresh\Nashemisto\Repositories\ChannelsRepository;
use Gate;
use Validator;

class ChannelsController extends AdminController
{
    protected $c_rep;

    /**
     * ChannelsController constructor.
     * @param ChannelsRepository $rep
     */
    public function __construct(ChannelsRepository $rep)
    {
        $this->c_rep = $rep;
        $this->template = 'admin.admin';
        $this->jss = '
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script src="' . asset('js/translate.js') . '"></script>
        ';
    }

    /**
     * View or Create Catigories
     * @param Request $request
     * @return View
     */
    public function index(ChannelRequest $request)
    {
        if (Gate::denies('UPDATE_CHANNEL')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->c_rep->addChannel($request);

            if ($result) {
                return back()->with(['status' => 'Новий канал додано.']);
            } else {
                return redirect()->back()
                    ->withErrors(['message' => 'Помилка створення каналу, повторіть спробу пізніше.']);
            }

        }

        $channels = $this->c_rep->get(['title', 'id', 'alias', 'approved'], false, true);
        $this->content = view('admin.video.channels.content')->with('channels', $channels);

        return $this->renderOutput();
    }

    /**
     * Category update
     * @param Request $request
     * @param $cat cat_id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function edit(ChannelRequest $request, $channel)
    {
        if (Gate::denies('UPDATE_CHANNEL')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->c_rep->updateChannel($request, $channel);

            if (is_array($result) && !empty($result['error'])) {
                return redirect()->back()->withErrors($result['error'])->withInput();
            }

            if ($result) {
                return redirect()->route('admin_channels')->with(['status' => 'Канал оновлено.']);
            } else {
                return redirect()->back()->withErrors(['message' => 'Помилка оновлення каналу, повторіть спробу пізніше.']);
            }
        }

        $this->content = view('admin.video.channels.edit')->with('channel', $channel);
        return $this->renderOutput();
    }
}
