<?php

namespace Fresh\Nashemisto\Http\Controllers\Admin;

use Fresh\Nashemisto\Http\Requests\CardRequest;
use Fresh\Nashemisto\Repositories\CardRepository;
use Gate;

class CardController extends AdminController
{
    protected $card_rep;

    /**
     * CardController constructor.
     * @param CardRepository $rep
     */
    public function __construct(CardRepository $rep)
    {
        $this->title = 'Анонси трансляцій.';
        $this->card_rep = $rep;
        $this->template = 'admin.admin';
    }

    /**
     * @param CardRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function show(CardRequest $request)
    {
        if (Gate::denies('UPDATE_CHANNEL')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->card_rep->addCard($request);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }
            return redirect()->back()->with($result);
        }

        $cards = $this->card_rep->get(['title', 'created_at', 'approved', 'id']);

        $this->content = view('admin.transmission.cards.show')->with(['cards' => $cards]);

        return $this->renderOutput();
    }

    /**
     * @param CardRequest $request
     * @param $card
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function edit(CardRequest $request, $card)
    {
        if (Gate::denies('UPDATE_CHANNEL')) {
            abort(404);
        }
        if ($request->isMethod('post')) {

            $result = $this->card_rep->updateCard($request, $card);

            if ($result) {
                return back()->with(['status' => 'Анонс оновлено.']);
            } else {
                return redirect()->back()
                    ->withErrors(['message' => 'Помилка редагування анонса, повторіть спробу пізніше.']);
            }

        }

        $this->content = view('admin.transmission.cards.edit')->with(['card' => $card]);

        return $this->renderOutput();
    }

    /**
     * @param $card
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function del($card)
    {
        if (Gate::denies('UPDATE_CHANNEL')) {
            abort(404);
        }

        $result = $this->card_rep->deleteCard($card);

        if (false == $result) {
            return redirect()->back()
                ->withErrors(['message' => 'Помилка видалення анонса, повторіть спробу пізніше.']);
        }
        return redirect()->route('admin_card')->with($result);
    }
}
