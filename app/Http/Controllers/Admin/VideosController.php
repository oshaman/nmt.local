<?php

namespace Fresh\Nashemisto\Http\Controllers\Admin;

use Fresh\Nashemisto\Http\Requests\VideoRequest;
use Fresh\Nashemisto\Repositories\VideosRepository;
use Fresh\Nashemisto\Channel;
use Fresh\Nashemisto\Repositories\ChannelsRepository;
use Fresh\Nashemisto\Video;
use Gate;

class VideosController extends AdminController
{
    protected $v_rep;

    /**
     * VideosController constructor.
     * @param VideosRepository $repository
     */
    public function __construct(VideosRepository $repository)
    {
        $this->template = 'admin.admin';
        $this->v_rep = $repository;
        $this->mark = 'admin_videos';
    }

    /**
     * @param VideoRequest $request
     * @return mixed
     */
    public function index(VideoRequest $request)
    {
        if (Gate::denies('view', new Video())) {
            abort(404);
        }

        $data = $request->except('_token');
        if (!empty($data['param'])) {
            $data['value'] = $data['value'] ?? null;
            switch ($data['param']) {
                case 1:
                    $videos = $this->v_rep->get(['title', 'id', 'created_at', 'user_id'],
                        false, true, [['title', 'like', '%' . $data['value'] . '%']]);
                    if ($videos) $videos->appends(['param' => $data['param']])->links();
                    break;
                case 2:
                    $videos = $this->v_rep->get(['title', 'id', 'created_at', 'user_id'],
                        false, true, ['approved' => 0], ['created_at', 'desc']);
                    if ($videos) $videos->appends(['param' => $data['param']])->links();
                    break;
                default:
                    $videos = $this->v_rep->get(['title', 'created_at', 'id', 'user_id'],
                        false, true, ['approved' => 0], ['created_at', 'desc']);
                    if ($videos) $videos->appends(['param' => $data['param']])->links();
            }
        } else {
            $videos = $this->v_rep->get(['title', 'created_at', 'id', 'user_id'],
                false, true, ['approved' => 1], ['created_at', 'desc']);
        }
        $this->title = 'Відео';
        $this->content = view('admin.video.show')->with(['videos' => $videos])->render();

        return $this->renderOutput();
    }

    /**
     * @param VideoRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function create(VideoRequest $request)
    {
        if (Gate::denies('create', new Video())) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $result = $this->v_rep->addVideo($request);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }
            return redirect()->route('edit_video', $result['id'])->with($result);
//            return redirect()->route('admin_articles')->with($result);
        }

        $this->title = 'Створення відео';

        //  get Channels
        $chs = new ChannelsRepository(new Channel());
        $lists = $chs->channelSelect();

        $this->content = view('admin.video.add')->with(['channels' => $lists])->render();

        return $this->renderOutput();
    }

    /**
     * @param ArticleRequest $request
     * @param EstablishmentsRepository $e_rep
     * @param $article
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function edit(VideoRequest $request, $video)
    {
        if (Gate::denies('update', $video)) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->v_rep->updateVideo($request, $video);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }

            return redirect()->route('admin_videos')->with($result);
        }

        $this->title = 'Редагування відео';
        //  get Channels
        $chs = new ChannelsRepository(new Channel());
        $lists = $chs->channelSelect();

        $this->content = view('admin.video.edit')
            ->with(['video' => $video, 'channels' => $lists])->render();

        return $this->renderOutput();

    }

    /**
     * @param $video
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del($video)
    {
        if (Gate::denies('delete', $video)) {
            abort(404);
        }

        $result = $this->v_rep->deleteVideo($video);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect()->route('admin_videos')->with($result);
    }
}
