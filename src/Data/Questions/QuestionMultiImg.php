<?php

namespace App\Data\Questions;

class QuestionMultiImg extends Question
{
    /**
     * @return mixed
     */
    public function getTypeField()
    {
        return self::TYPE_MULTI_IMG;
    }
}