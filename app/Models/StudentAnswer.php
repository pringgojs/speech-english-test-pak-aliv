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
}
