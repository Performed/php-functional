<?php

declare(strict_types=1);

namespace Widmogrod\Monad\Free;

use Widmogrod\Common;
use FunctionalPHP\FantasyLand;

class Pure implements MonadFree
{
    use Common\PointedTrait;

    const of = 'Widmogrod\Monad\Free\Pure::of';

    /**
     * @inheritdoc
     */
    public function ap(FantasyLand\Apply $b)
    {
        return $b->map($this->value);
    }

    /**
     * @inheritdoc
     * @return Pure
     */
    public function bind(callable $function)
    {
        return $function($this->value);
    }

    /**
     * @inheritdoc
     * @return Pure
     */
    public function map(callable $function)
    {
        return self::of($function($this->value));
    }

    /**
     * ```
     * foldFree _ (Pure a)  = return a
     * ```
     *
     * @inheritdoc
     */
    public function foldFree(callable $f, callable $return): FantasyLand\Monad
    {
        return $return($this->value);
    }
}
