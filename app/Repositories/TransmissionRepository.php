<?php
/**
 * Created by PhpStorm.
 * User: ххх
 * Date: 26.01.2018
 * Time: 12:43
 */

namespace Fresh\Nashemisto\Repositories;

use Cache;
use DB;
use Fresh\Nashemisto\Transmission;

class TransmissionRepository extends Repository
{
    /**
     * TransmissionRepository constructor.
     * @param Transmission $rep
     */
    public function __construct(Transmission $rep)
    {
        $this->model = $rep;
    }

    /**
     * @param $request
     * @return bool
     */
    public function addTransmission($request)
    {
        $result = $this->model->fill($request->only('title', 'token'))->save();
        $this->clearTransmissionCache();
        return $result;
    }

    /**
     * @param $request
     * @param $transmission
     * @return mixed
     */
    public function updateTransmission($request, $transmission)
    {
        $result = $transmission->fill($request->only('title', 'token'))->save();
        $this->clearTransmissionCache();
        return $result;
    }

    /**
     *
     */
    public function clearTransmissionCache()
    {
        Cache::forget('main-online');
    }

    /**
     * @param $request
     * @return bool
     */
    public function switchTransmission($request)
    {
        $transmission = Transmission::where('id', (int)$request->get('transmission'))->first();

        if (!is_null($transmission)) {
            DB::transaction(function () use ($transmission) {
                $this->model->where('id', '<>', $transmission->id)->update(['approved' => 0]);
                $transmission->update(['approved' => 1]);
            });
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $transmission
     * @return array|bool
     */
    public function deleteTransmission($transmission)
    {
        if ($transmission->delete()) {

            $this->clearTransmissionCache();

            return ['status' => 'Трансляцію видалено'];
        } else {
            return false;
        }
    }

    public function getOnline()
    {
        return $this->model->select('token', 'title')->where('approved', 1)->first();
    }
}