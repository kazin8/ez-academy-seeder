<?php

namespace App\Data\Questions;

class QuestionSingleImg extends Question
{
    /**
     * @return mixed
     */
    public function getTypeField()
    {
        return self::TYPE_SINGLE_IMG;
    }
}