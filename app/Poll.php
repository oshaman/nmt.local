<?php

namespace Fresh\Nashemisto;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = [
        'title', 'alias', 'description', 'question', 'image', 'alt', 'imgtitle', 'cessation',
        'answer1', 'answer2', 'answer3', 'answer4', 'answer5', 'approved', 'created_at', 'user_id'
    ];

    public function voting($id)
    {
        $stat = \Fresh\Nashemisto\PollStatistic::select('n1', 'n2', 'n3', 'n4', 'n5')->where('poll_id', $id)->first();

        $stat = $stat ? $stat->toArray() : [];
        return array_sum($stat);
    }

    public function statistic()
    {
        return $this->hasOne('\Fresh\Nashemisto\PollStatistic');
    }
}
