<?php

declare(strict_types=1);

namespace Widmogrod\Monad\Either;

use Widmogrod\Common;
use FunctionalPHP\FantasyLand;

class Right implements Either
{
    use Common\PointedTrait;
    use Common\ValueOfTrait;

    const of = 'Widmogrod\Monad\Either\Right::of';

    /**
     * @inheritdoc
     */
    public function ap(FantasyLand\Apply $b)
    {
        return $b->map($this->value);
    }

    /**
     * @inheritdoc
     * @return Right
     */
    public function map(callable $transformation): FantasyLand\Functor
    {
        return self::of($this->bind($transformation));
    }

    /**
     * @inheritdoc
     * @return Right
     */
    public function bind(callable $transformation)
    {
        return $transformation($this->value);
    }

    /**
     * @inheritdoc
     */
    public function either(callable $left, callable $right)
    {
        return $right($this->value);
    }

    /**
     * @inheritdoc
     */
    public function ensure(callable $predicate, $default)
    {
        return ($predicate($this->value))
            ?  $this
            : Left::of($default);
    }

    /**
     * @inheritdoc
     */
    public function foreach(callable $sideEffectF): void
    {
        $sideEffectF($this->value);
    }

}
