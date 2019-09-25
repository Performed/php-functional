<?php

declare(strict_types=1);

namespace Widmogrod\Monad\Either;

use Widmogrod\Common;
use FunctionalPHP\FantasyLand;

interface Either extends
    FantasyLand\Monad,
    Common\ValueOfInterface
{
    /**
     * Depending on if is Left or is Right then it apply corresponding function
     *
     * @param callable $left  (a -> b)
     * @param callable $right (c -> b)
     *
     * @return mixed b
     */
    public function either(callable $left, callable $right);


    /**
     * @inheritdoc
     * @return Either
     */
    public function map(callable $transformation);


    /**
     * @inheritdoc
     * @return Either
     */
    public function bind(callable $transformation);

    /**
     * @param callable $predicate
     * @param $default
     * @return Either $this if $this is Right and $predicate($value) else Left::of($default)
     */
    public function ensure(callable $predicate, $default);

}
