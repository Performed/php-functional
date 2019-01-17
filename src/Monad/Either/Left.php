<?php

declare(strict_types=1);

namespace Widmogrod\Monad\Either;

use Widmogrod\Common;
use FunctionalPHP\FantasyLand;

class Left implements Either
{
    use Common\PointedTrait;
    use Common\ValueOfTrait;

    const of = 'Widmogrod\Monad\Either\Left::of';

    /**
     * @inheritdoc
     * @return Left
     */
    public function ap(FantasyLand\Apply $b)
    {
        return $this;
    }

    /**
     * @inheritdoc
     * @return Left
     */
    public function map(callable $transformation)
    {
        return $this;
    }

    /**
     * @inheritdoc
     * @return Left
     */
    public function bind(callable $transformation)
    {
        // Don't do anything
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function either(callable $left, callable $right)
    {
        return $left($this->value);
    }
}
