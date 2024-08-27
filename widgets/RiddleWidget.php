<?php

namespace app\widgets;

use app\models\Box;
use Throwable;
use yii\base\Widget;
use yii\helpers\Html;

class RiddleWidget extends Widget
{
    protected array $boxes = [];
    protected bool $showRestart = false;

    public static array $variants = [
        'GOLD'   => '🥇',
        'SILVER' => '🥈',
        'EMPTY'  => '⭕',
    ];

    /**
     * @throws Throwable
     */
    public function run()
    {
        if ($this->ready() === false) {
            $this->generateBoxes();
        }

        return $this->render('@app/views/widgets/riddle', [
            'widget' => $this
        ]);
    }

    public function fillBoxes(): self
    {
        if ($this->ready()) {
            $labels = array_keys(self::$variants);
            $contents = self::$variants;

            shuffle($labels);
            shuffle($contents);

            $variants = array_combine($labels, $contents);

            foreach ($this->boxes as $box) {
                $box->content = $variants[$box->label];
            }
        }

        return $this;
    }

    public function boxesBlock(): string
    {
        $html = '';
        $isWinner = false;
        /** @var Box $box */
        foreach ($this->boxes as $index => $box) {
            $html .= BoxWidget::widget([
                'id'      => "box-$index",
                'label'   => $box->label,
                'content' => $box->content,
                'opened'  => $box->opened,
                'win'     => $box->isWin(),
            ]);

            if ($box->isWin()) {
                $isWinner = true;
            }
        }

        if ($this->showRestart) {
            $html .= $this->restartBlock($isWinner);
        }

        return $html;
    }

    public function restartBlock($isWinner = false): string
    {
        $restartText = $isWinner ? 'Congratulations! You win!' : 'Sorry, maybe next time!';

        $html = Html::beginTag('div', ['id' => 'restart', 'class' => 'col-12 fade text-center']);
        $html .= Html::tag('h2', $restartText, ['class' => 'text-muted']);
        $html .= Html::a('Try again?', ['site/index'], ['class' => 'btn btn-primary', 'data-pjax' => 0]);
        $html .= Html::endTag('div');

        return $html;
    }

    protected function generateBoxes(): void
    {
        foreach (self::$variants as $label => $content) {
            $this->boxes[] = new Box($label);
        }

        shuffle($this->boxes);
    }

    public function setBoxes(array $boxes): self
    {
        $this->boxes = $boxes;

        return $this;
    }

    public function getBoxes(): array
    {
        return $this->boxes;
    }

    public function ready(): bool
    {
        return $this->boxes !== [];
    }

    public function showRestart(): self
    {
        $this->showRestart = true;

        return $this;
    }

    public function needRestart(): bool
    {
        return $this->showRestart;
    }
}
