<?php

declare(strict_types=1);

namespace Widmogrod\Monad\Maybe;

use Widmogrod\Common;
use FunctionalPHP\FantasyLand;

interface Maybe extends
    FantasyLand\Monad,
    FantasyLand\Foldable,
    Common\ValueOfInterface,
    FantasyLand\Monoid
{
    /**
     * Handle situation when error occur in monad computation chain.
     *
     * @param callable $fn
     *
     * @return Maybe
     */
    public function orElse(callable $fn);

    /**
     * @param Maybe $other .
     * @return Maybe .
     */
    public function orElseStrict(Maybe $other);

    /**
     * @param mixed $default .
     * @return mixed $value if $this is Just($value) else $default.
     */
    public function extractOrElse($default);

    /**
     * Extract value from Just or get lazy default value if Nothing.
     *
     * @param callable $fnDefault .
     * @return mixed $value if $this is Just($value) else $fnDefault().
     */
    public function extractOrCall(callable $fnDefault);

    /**
     * Execute side effect if Just.
     *
     * @param callable $sideEffect .
     * @return void
     */
    public function foreach(callable $sideEffect);

    /**
     * @inheritdoc
     * @return Maybe
     */
    public function map(callable $transformation);

    /**
     * @inheritdoc
     * @return Maybe
     */
    public function bind(callable $transformation);

    /**
     * @return bool True if it is Just.
     */
    public function isDefined(): bool;

    /**
     * @return bool True if it is Just.
     */
    public function nonEmpty(): bool;

    /**
     * @return bool True if it is Nothing.
     */
    public function isEmpty(): bool;

    /**
     * @param callable $filterF .
     * @return Maybe .
     */
    public function filter(callable $filterF): Maybe;

}
