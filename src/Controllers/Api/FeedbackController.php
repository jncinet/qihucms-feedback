<?php

namespace Qihucms\Feedback\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Qihucms\Feedback\Models\Feedback;
use Qihucms\Feedback\Requests\StoreRequest;
use Qihucms\Feedback\Resources\FeedbackCollection;
use Qihucms\Feedback\Resources\Feedback as FeedbackResource;

class FeedbackController extends ApiController
{
    /**
     * 我的反馈
     *
     * @param Request $request
     * @return FeedbackCollection
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit', 15);
        $result = Feedback::where('user_id', \Auth::id())->latest()->paginate($limit);

        return new FeedbackCollection($result);
    }

    /**
     * 发布反馈
     *
     * @param StoreRequest $request
     * @return FeedbackResource
     */
    public function store(StoreRequest $request)
    {
        $data = $request->only(['title', 'content', 'file', 'contact']);
        $data['user_id'] = \Auth::id();
        $data['status'] = 0;
        $result = Feedback::create($data);

        return new FeedbackResource($result);
    }

    /**
     * 反馈详细
     *
     * @param $id
     * @return FeedbackResource
     */
    public function show($id)
    {
        $result = Feedback::where('id', $id)->where('user_id', \Auth::id())->first();

        return new FeedbackResource($result);
    }

    /**
     * 更新反馈
     *
     * @param StoreRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreRequest $request, $id)
    {
        $data = $request->only(['title', 'content', 'file', 'contact']);

        $result = Feedback::where('user_id', \Auth::id())->where('id', $id)->update($data);

        if ($result) {
            return $this->jsonResponse(['id' => $id]);
        }

        return $this->jsonResponse(['更新失败'], '', 422);
    }

    /**
     * 删除反馈
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Feedback::where('user_id', \Auth::id())->where('id', $id)->delete()) {
            return $this->jsonResponse(['id' => $id]);
        }

        return $this->jsonResponse(['删除失败'], '', 422);
    }
}