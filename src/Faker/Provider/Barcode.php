<?php

namespace Faker\Provider;

/**
 * @see http://en.wikipedia.org/wiki/EAN-13
 * @see http://en.wikipedia.org/wiki/ISBN
 */
class Barcode extends Base
{
    private function ean(int $length = 13): string
    {
        $code = static::numerify(\str_repeat('#', $length - 1));

        return $code.static::eanChecksum($code);
    }

    /**
     * Utility function for computing EAN checksums.
     */
    protected static function eanChecksum(string $input): int
    {
        $sequence = (\strlen($input) + 1) === 8 ? [3, 1] : [1, 3];
        $sums = 0;
        foreach (\str_split($input) as $n => $digit) {
            $sums += $digit * $sequence[$n % 2];
        }

        return (10 - $sums % 10) % 10;
    }

    /**
     * ISBN-10 check digit.
     *
     * @see http://en.wikipedia.org/wiki/International_Standard_Book_Number#ISBN-10_check_digits
     *
     * @param string $input ISBN without check-digit
     *
     * @throws \LengthException When wrong input length passed
     *
     * @return int Check digit
     */
    protected static function isbnChecksum(string $input): int
    {
        // We're calculating check digit for ISBN-10
        // so, the length of the input should be 9
        $length = 9;

        if (\strlen($input) !== $length) {
            throw new \LengthException(\sprintf('Input length should be equal to %d', $length));
        }

        $digits = \str_split($input);
        \array_walk(
            $digits,
            static function(&$digit, $position) {
                $digit *= (10 - $position);
            }
        );
        $result = (11 - \array_sum($digits) % 11) % 11;

        // 10 is replaced by X
        return ($result < 10) ? $result : 'X';
    }

    /**
     * Get a random EAN13 barcode.
     *
     * @example '4006381333931'
     */
    public function ean13(): string
    {
        return $this->ean(13);
    }

    /**
     * Get a random EAN8 barcode.
     *
     * @example '73513537'
     */
    public function ean8(): string
    {
        return $this->ean(8);
    }

    /**
     * Get a random ISBN-10 code.
     *
     * @see http://en.wikipedia.org/wiki/International_Standard_Book_Number
     *
     * @example '4881416324'
     */
    public function isbn10(): string
    {
        $code = static::numerify(\str_repeat('#', 9));

        return $code.static::isbnChecksum($code);
    }

    /**
     * Get a random ISBN-13 code.
     *
     * @see http://en.wikipedia.org/wiki/International_Standard_Book_Number
     *
     * @example '9790404436093'
     */
    public function isbn13(): string
    {
        $code = '97'.static::numberBetween(8, 9).static::numerify(\str_repeat('#', 9));

        return $code.static::eanChecksum($code);
    }
}
