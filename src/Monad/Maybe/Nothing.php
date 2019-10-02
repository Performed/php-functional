<?php

declare(strict_types=1);

namespace Widmogrod\Monad\Maybe;

use FunctionalPHP\FantasyLand;
use Widmogrod\Useful\PatternMatcher;

class Nothing implements Maybe, PatternMatcher
{
    const of = 'Widmogrod\Monad\Maybe\Nothing::of';

    /**
     * @inheritdoc
     * @return Nothing
     */
    public static function of($value)
    {
        return new static();
    }

    /**
     * @inheritdoc
     * @return Nothing
     */
    public function ap(FantasyLand\Apply $applicative)
    {
        return $this;
    }

    /**
     * @param callable $sideEffect .
     */
    public function foreach(callable $sideEffect)
    {
        return;
    }

    /**
     * @inheritdoc
     * @return Nothing
     */
    public function map(callable $transformation)
    {
        return $this;
    }

    /**
     * @inheritdoc
     * @return Nothing
     */
    public function bind(callable $transformation)
    {
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function concat(FantasyLand\Semigroup $value)
    {
        return $value;
    }

    /**
     * @inheritdoc
     * @return Nothing
     */
    public static function mempty()
    {
        return new static();
    }

    /**
     * @inheritdoc
     */
    public function orElse(callable $fn)
    {
        return $fn();
    }

    /**
     * @inheritdoc
     */
    public function extractOrElse($default)
    {
        return $default;
    }

    /**
     * @inheritdoc
     */
    public function extractOrCall(callable $fnDefault)
    {
        return $fnDefault();
    }

    /**
     * @inheritdoc
     */
    public function extract()
    {
        return null;
    }

    /**
     * foldl _ z Nothing = z
     * foldl f z (Just x) = f z x
     *
     * @inheritdoc
     */
    public function reduce(callable $function, $accumulator)
    {
        return $accumulator;
    }

    /**
     * @inheritdoc
     */
    public function patternMatched(callable $fn)
    {
        return $fn();
    }

    /**
     * @inheritdoc
     */
    public function isDefined(): bool
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function nonEmpty(): bool
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function isEmpty(): bool
    {
        return true;
    }

}
