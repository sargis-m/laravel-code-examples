<?php

use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;
class Math
{
    public const SCALE = 4;
    public const ROUDNING_MODE = RoundingMode::HALF_UP;

    public function toBigInteger()
    {
        return BigDecimal::of($this->price)
            ->dividedBy(100, self::SCALE, self::ROUDNING_MODE)
            ->multipliedBy($this->coefficient)
            ->toScale(self::SCALE, self::ROUDNING_MODE)
            ->getUnscaledValue();
    }
}