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
     * @inheritdoc
     * @return Maybe
     */
    public function map(callable $transformation);


    /**
     * @inheritdoc
     * @return Maybe
     */
    public function bind(callable $transformation);
}
