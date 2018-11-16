<?php

namespace App\Data\Questions;

class QuestionSingleText extends Question
{
    /**
     * @return mixed
     */
    public function getTypeField()
    {
        return self::TYPE_SINGLE_TEXT;
    }
}