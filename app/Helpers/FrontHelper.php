<?php

namespace App\Helpers;

use App\Models\Question;
use App\Models\StudentAnswer;

class FrontHelper
{
    /** format token: ($group_id.$topic_id.$student_id) */
    public static function isValidForm($decrypt)
    {
        $decrypt = explode('.', $decrypt);
        $where = [
            'group_id' => $decrypt[0],
            'topic_id' => $decrypt[1],
            'student_id' => $decrypt[2]
        ];

        $student_answer = StudentAnswer::where($where)->first();
        if (!$student_answer) return true;

        return false;
    }

    public static function nextQuestion($decrypt)
    {
        $decrypt = explode('.', $decrypt);
        $where = [
            'group_id' => $decrypt[0],
            'topic_id' => $decrypt[1],
            'student_id' => $decrypt[2]
        ];

        $student_answer = StudentAnswer::where($where)->select('question_id')->get()->toArray();
        $question_id = array_flatten($student_answer);
        $question = Question::where('topic_id', $decrypt[1])->whereNotIn('id', $question_id)->orderBy('serial_number', 'asc')->first();

        return $question;
    }

    public static function isDone($token)
    {
        $decrypt = decrypt($token);

        return self::nextQuestion($decrypt) ? false: true;
    }
    
    public static function storeAnswer($request)
    {
        info($request);
        $decrypt = decrypt($request['token']);
        $decrypt = explode('.', $decrypt);
        /** format token: ($group_id.$topic_id.$student_id) */

        $answer = new StudentAnswer;
        $answer->group_id = $decrypt[0];
        $answer->topic_id = $decrypt[1];
        $answer->student_id = $decrypt[2];
        $answer->answer = $request['answer'];
        $answer->question_id = $request['question_id'];
        $answer->score = self::calculateScore($request['question_id'], $request['answer']);
        $answer->save();

        return $answer;
    }

    public static function calculateScore($question_id, $answer)
    {
        $question = Question::find($question_id);
        $score = 0;
        
        foreach ($question->answers as $question_answer) {
            foreach ($question_answer->variants as $variant) {
                if (strpos(strtolower($answer), strtolower($variant->answer))  !== false) {
                    $score += $question_answer->score;
                    # 1 kategori hanya bisa diambil maksimal 1 skor yang betul. Agar tidak bug (user bisa menjawab dengan variant sama dan mendapat skor)
                    break;
                }
            }
        }

        return $score;
    }

    public static function getTotalScore($group_id, $topic_id, $student_id)
    {
        $where = [
            'group_id' => $group_id,
            'topic_id' => $topic_id,
            'student_id' => $student_id
        ];

        return StudentAnswer::where($where)->sum('score');
    }
}
