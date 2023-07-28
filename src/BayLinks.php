<?php

namespace PalPalani\BayLinks;

final class BayLinks
{
    public static function client(): Factory
    {
        return self::factory();
    }

    public static function factory(): Factory
    {
        return new Factory;
    }
}
