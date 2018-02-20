<?php

namespace Fresh\Nashemisto\Repositories;

use Fresh\Nashemisto\Informer;
use Fresh\Nashemisto\Jobs\AddNews;
use Validator;
use Storage;

class InformRepository extends Repository
{
    public function __construct(Informer $informer)
    {
        $this->model = $informer;
    }

    /**
     * @param $request
     * @return array
     */
    public function send($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:3,255',
            'email' => 'required|email',
            'phone' => 'required|string|between:7,64',
            'text' => 'required|string|between:3,2000',
            "file" => 'array|max:5',
            'file.*' => 'mimes:jpg,jpeg,png,doc,docx,txt,avi,flv,mp4,3gp,mov,zip,rar,7z|between:50,20480'
        ]);

        if ($validator->fails()) {
            $result['error'] = $validator;
            return $result;
        }

        $data = $request->only('file', 'name', 'email', 'phone', 'text');

        if (!empty($data['file'])) {
            foreach ($data['file'] as $k => $file) {
                $data['attach'][$k]['mime'] = $file->getMimeType();
                $data['attach'][$k]['file_name'] = str_replace('news/', '', $file->store('news', 'public'));
                $data['attach'][$k]['path'] = storage_path('app/public/news/' . $data['attach'][$k]['file_name']);
            }
            array_forget($data, 'file');
        }
//dd($data);
        dispatch(new AddNews(env('MAIL_ADD_NEWS'), $data));
        return ['status' => 'Новину відправлено!'];
    }

    /**
     *
     */
    public function clearNews()
    {
        Storage::deleteDirectory('public/news');
        \Log::info('clearNews');
    }

    /**
     * @param $request
     * @return array
     */
    public function updateInformer($request)
    {
        $informer = $this->model->find(1);

        $informer->text = $request->get('text');

        try {
            $result = $informer->save();
        } catch (Exception $e) {
            \Log::info('Помилка збереження "Повідомити новину" - ') . $e->getMessage();
        }

        if ($result) {
            return ['status' => 'Сторінку оновлено'];
        } else {
            return ['error' => 'Помилка збереження'];
        }
    }
}