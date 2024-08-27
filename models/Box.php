<?php

namespace app\models;

use app\widgets\RiddleWidget;
use yii\base\Model;

class Box extends Model
{
    public string $label;
    public string $content = '';
    public bool $opened = false;

    public function __construct(string $label = '', array $config = [])
    {
        $this->label = $label;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['label', 'opened'], 'required'],
            [['label', 'content'], 'string'],
            [['opened'], 'boolean'],
        ];
    }

    public function isWin(): bool
    {
        return $this->opened && $this->content === RiddleWidget::$variants[$this->label];
    }
}
