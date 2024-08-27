<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\StringHelper;

class BoxWidget extends Widget
{
    public string $id;
    public string $label;
    public string $content;
    public bool $opened = false;
    public bool $win = false;

    public function run(): string
    {
        $win = $this->isWin() ? ' win' : ' lose';

        $html = Html::beginTag('div',
            ['class' => 'box col-4 ' . ($this->isOpened() ? 'opened' : '') . $win, 'id' => $this->id]);
        $html .= Html::beginTag('div', ['class' => 'box-inner']);

        $html .= $this->boxFrontBlock();
        $html .= $this->boxBackBlock();

        $html .= Html::hiddenInput("riddle[$this->id][label]", $this->label, ['class' => 'box-label']);
        $html .= Html::hiddenInput("riddle[$this->id][opened]", $this->opened ? '1' : '0', ['class' => 'box-opened']);

        $html .= Html::endTag('div');
        $html .= Html::endTag('div');

        return $html;
    }

    protected function boxBackBlock(): string
    {
        return Html::tag('div',
            Html::tag('div', $this->getContent(), ['class' => 'box-title']),
            ['class' => 'box-back']
        );
    }

    protected function boxFrontBlock(): string
    {
        return Html::tag('div',
            Html::tag('div', $this->label, ['class' => 'box-title']) . $this->openButton(),
            ['class' => 'box-front']
        );
    }

    protected function openButton(): string
    {
        return Html::button($this->opened ? 'Opening..' : 'Open', [
            'class'       => 'btn-open open-box',
            'data-box-id' => $this->id,
            'disabled'    => $this->opened,
        ]);
    }

    protected function getContent(): string
    {
        return Html::tag('p', StringHelper::mb_ucfirst($this->content));
    }

    public function isWin(): bool
    {
        return $this->win;
    }

    public function isOpened(): bool
    {
        return $this->opened;
    }
}
