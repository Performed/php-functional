<?php

declare(strict_types=1);

namespace Widmogrod\Primitive;

use FunctionalPHP\FantasyLand\Chain;
use Widmogrod\Common;
use FunctionalPHP\FantasyLand;

/**
 * data List a = Nil | Cons a (List a)
 */
interface Listt extends
    FantasyLand\Monad,
    FantasyLand\Monoid,
    FantasyLand\Setoid,
    FantasyLand\Foldable,
    FantasyLand\Traversable,
    Common\ValueOfInterface
{
    /**
     * head :: [a] -> a
     *
     * @return mixed First element of Listt
     *
     * @throws EmptyListError
     */
    public function head();

    /**
     * tail :: [a] -> [a]
     *
     * @return \Widmogrod\Primitive\Listt
     *
     * @throws EmptyListError
     */
    public function tail(): self;


    /**
     * @returns Listt
     */
    public static function of($value);

    /**
     * @return Listt
     */
    public function map(callable $transformation);

    /**
     * fs <*> xs = [f x | f <- fs, x <- xs]
     *
     * @return Listt
     */
    public function ap(FantasyLand\Apply $applicative);

    /**
     * @return Chain
     */
    public function bind(callable $transformation);

    /**
     * @return array
     */
    public function extract();

    /**
     * @return Listt
     */
    public static function mempty();

    /**
     * @throws TypeMismatchError
     *
     * @return Listt
     */
    public function concat(FantasyLand\Semigroup $value);
}
