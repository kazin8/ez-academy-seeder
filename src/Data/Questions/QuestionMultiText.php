<?php

namespace App\Data\Questions;

class QuestionMultiText extends Question
{
    /**
     * @return mixed
     */
    public function getTypeField()
    {
        return self::TYPE_MULTI_TEXT;
    }
}