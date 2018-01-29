<?php

namespace Fresh\Nashemisto\Http\Controllers\Admin;

use Fresh\Nashemisto\Http\Requests\TransmissionRequest;
use Fresh\Nashemisto\Repositories\TransmissionRepository;
use Gate;
use Illuminate\Http\Request;

class TransmissionController extends AdminController
{
    protected $transmission_rep;

    /**
     * TransmissionController constructor.
     * @param TransmissionRepository $rep
     */
    public function __construct(TransmissionRepository $rep)
    {
        $this->title = 'Online - трансляції.';
        $this->transmission_rep = $rep;
        $this->template = 'admin.admin';
    }

    /**
     * @param Request $request
     * @return $this|mixed
     */
    public function show(Request $request)
    {
        if (Gate::denies('UPDATE_CHANNEL')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->transmission_rep->switchTransmission($request);

            if ($result) {
                $request->session()->flash('status', 'Трансляція змінена!');
            } else {
                return redirect()->back()
                    ->withErrors(['message' => 'Помилка заміни трансляції, повторіть спробу пізніше.']);
            }
        }

        $transmissions = $this->transmission_rep->get(['title', 'token', 'approved', 'id']);

        $this->content = view('admin.transmission.show')->with(['transmissions' => $transmissions]);

        return $this->renderOutput();
    }

    /**
     * @param TransmissionRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function create(TransmissionRequest $request)
    {
        if (Gate::denies('UPDATE_CHANNEL')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->transmission_rep->addTransmission($request);

            if ($result) {
                return back()->with(['status' => 'Нову трансляцію додано.']);
            } else {
                return redirect()->back()
                    ->withErrors(['message' => 'Помилка створення трансляції, повторіть спробу пізніше.']);
            }

        }

        $transmissions = $this->transmission_rep->get(['title', 'token', 'approved', 'id']);

        $this->content = view('admin.transmission.add')->with(['transmissions' => $transmissions]);

        return $this->renderOutput();
    }

    /**
     * @param TransmissionRequest $request
     * @param $transmission
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function edit(TransmissionRequest $request, $transmission)
    {
        if (Gate::denies('UPDATE_CHANNEL')) {
            abort(404);
        }
        if ($request->isMethod('post')) {

            $result = $this->transmission_rep->updateTransmission($request, $transmission);

            if ($result) {
                return back()->with(['status' => 'Трансляцію оновлено.']);
            } else {
                return redirect()->back()
                    ->withErrors(['message' => 'Помилка редагування трансляції, повторіть спробу пізніше.']);
            }

        }

        $this->content = view('admin.transmission.edit')->with(['transmission' => $transmission]);

        return $this->renderOutput();
    }

    /**
     *
     */
    public function del($transmission)
    {
        if (Gate::denies('UPDATE_CHANNEL')) {
            abort(404);
        }

        $result = $this->transmission_rep->deleteTransmission($transmission);

        if (false == $result) {
            return redirect()->back()
                ->withErrors(['message' => 'Помилка видалення трансляції, повторіть спробу пізніше.']);
        }
        return redirect()->route('create_transmission')->with($result);
    }
}
