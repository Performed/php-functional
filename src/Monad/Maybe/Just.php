<?php

declare(strict_types=1);

namespace Widmogrod\Monad\Maybe;

use Widmogrod\Common;
use FunctionalPHP\FantasyLand;
use Widmogrod\Primitive\TypeMismatchError;
use Widmogrod\Useful\PatternMatcher;

class Just implements Maybe, PatternMatcher
{
    use Common\PointedTrait;

    const of = 'Widmogrod\Monad\Maybe\Just::of';

    /**
     * @inheritdoc
     */
    public function ap(FantasyLand\Apply $applicative)
    {
        return $applicative->map($this->value);
    }

    /**
     * @param callable $sideEffect .
     */
    public function foreach(callable $sideEffect)
    {
        $sideEffect();
    }

    /**
     * @inheritdoc
     * @return Just
     */
    public function map(callable $transformation)
    {
        return self::of($this->bind($transformation));
    }

    /**
     * @inheritdoc
     * @return Just
     */
    public function bind(callable $transformation)
    {
        return $transformation($this->value);
    }

    /**
     * @inheritdoc
     * @return FantasyLand\Semigroup
     * @throws TypeMismatchError
     */
    public function concat(FantasyLand\Semigroup $value): FantasyLand\Semigroup
    {
        if (!($value instanceof Maybe)) {
            throw new TypeMismatchError($value, Maybe::class);
        }

        if ($value instanceof Nothing) {
            return $this;
        }

        if (!($this->value instanceof FantasyLand\Semigroup)) {
            throw new TypeMismatchError($this->value, FantasyLand\Semigroup::class);
        }

        return self::of($this->value->concat($value->extract()));
    }

    /**
     * @inheritdoc
     * @return Nothing
     */
    public static function mempty()
    {
        return new Nothing();
    }

    /**
     * @inheritdoc
     * @return Just
     */
    public function orElse(callable $fn)
    {
        return $this;
    }

    /**
     * Extract value from Just or get default value if Nothing.
     *
     * @param mixed $default .
     * @return mixed
     */
    public function extractOrElse($default)
    {
        return $this->extract();
    }

    /**
     * Extract value from Just or get lazy default value if Nothing.
     *
     * @param callable $fnDefault .
     * @return mixed
     */
    public function extractOrCall(callable $fnDefault)
    {
        return $this->extract();
    }

    /**
     * @inheritdoc
     */
    public function extract()
    {
        return $this->value;
    }

    /**
     * foldl _ z Nothing = z
     * foldl f z (Just x) = f z x
     *
     * @inheritdoc
     */
    public function reduce(callable $function, $accumulator)
    {
        return $function($accumulator, $this->value);
    }

    /**
     * @inheritdoc
     */
    public function patternMatched(callable $fn)
    {
        return $fn($this->value);
    }

    /**
     * @inheritdoc
     */
    public function isDefined(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function nonEmpty(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function isEmpty(): bool
    {
        return false;
    }

}
