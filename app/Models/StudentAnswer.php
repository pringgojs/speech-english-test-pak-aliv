<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    protected $table = 'student_answers';   

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function scopeJoinTopic($q)
    {
        $q->join('topics', 'topics.id', '=', $this->table.'.topic_id');
    }

    public function scopeJoinGroup($q)
    {
        $q->join('groups', 'groups.id', '=', $this->table.'.group_id');
    }

    public function scopeJoinStudent($q)
    {
        $q->join('students', 'students.id', '=', $this->table.'.student_id');
    }

    public function scopeSearch($q)
    {
        $topic_id = \Input::get('topic_id') ? : '';
        $group_id = \Input::get('group_id') ? : '';
        $search = \Input::get('search') ? : '';

        $q->joinGroup()->joinTopic()->joinStudent()->where(function ($q) use ($topic_id, $group_id) {
            
            if ($topic_id) {
                $q->where('topic_id', $topic_id);
            }

            if ($group_id) {
                $q->where('group_id', $group_id);
            }
        })->orWhere(function ($q) use ($search) {
            if ($search) {
                $q->where('students.name', 'like', '%'.$search.'%');

            }
        })
        ->select([$this->table.'.*']);
    }

    public function answerRender()
    {
        $question = Question::find($this->question_id);
        $score = 0;
        $answer = strtolower($this->answer);
        $text = '';
        foreach ($question->answers as $question_answer) {
            foreach ($question_answer->variants as $variant) {
                if (strpos($answer, strtolower($variant->answer))  !== false) {
                    //$score += $question_answer->score;
                    $answer = str_replace(strtolower($variant->answer), '<span style="border:1px solid green; text-align: center; padding:3px; margin-right:3px">'. strtolower($variant->answer).'</span> ', $answer);
                    # 1 kategori hanya bisa diambil maksimal 1 skor yang betul. Agar tidak bug (user bisa menjawab dengan variant sama dan mendapat skor)
                    break;
                }
            }
        }

        return $answer;
    }

    public function renderCorrectCategory()
    {
        $question = Question::find($this->question_id);
        $score = 0;
        $answer = strtolower($this->answer);
        $id_variant = [];
        echo '<div class="button-list mt-25">';
        foreach ($question->answers as $question_answer) {

            $true = false;
            foreach ($question_answer->variants as $variant) {
                if (strpos($answer, strtolower($variant->answer))  !== false) {
                    $true = true;
                    # 1 kategori hanya bisa diambil maksimal 1 skor yang betul. Agar tidak bug (user bisa menjawab dengan variant sama dan mendapat skor)
                    break;
                }
            }

            $bg = $true ? 'btn-success' : 'btn-warning';
            echo '<button type="button" class="btn btn-xs '.$bg.' btn-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$question_answer->answer.'">'.$question_answer->answer.'</button>';
        }

        echo '</div>';
    }
}
