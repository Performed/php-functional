<?php

declare(strict_types=1);

namespace Widmogrod\Primitive;

use FunctionalPHP\FantasyLand\Chain;
use Widmogrod\Common;
use FunctionalPHP\FantasyLand;
use Widmogrod\Monad\Maybe\Maybe;

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
     * @param FantasyLand\Semigroup $value
     *
     * @return Listt
     */
    public function concat(FantasyLand\Semigroup $value);

    /**
     * find :: (a -> Bool) -> [a] -> Maybe a
     *
     * @param callable $predicate
     *
     * @return Maybe
     */
    public function find(callable $predicate): Maybe;

    /**
     * filter :: (a -> Bool) -> [a] -> [a]
     *
     * @param callable $predicate
     *
     * @return Listt
     */
    public function filter(callable $predicate): Listt;
}
