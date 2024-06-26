<?php

namespace Faker\ORM\Propel;

use ColumnMap;
use PropelColumnTypes;

class ColumnTypeGuesser
{
    protected \Faker\Generator $generator;

    public function __construct(\Faker\Generator $generator)
    {
        $this->generator = $generator;
    }

    public function guessFormat(ColumnMap $column): ?\Closure
    {
        $generator = $this->generator;
        if ($column->isTemporal()) {
            if ($column->isEpochTemporal()) {
                return static function() use ($generator) {
                    return $generator->dateTime;
                };
            }

            return static function() use ($generator) {
                return $generator->dateTimeAD;
            };
        }
        $type = $column->getType();
        switch ($type) {
            case PropelColumnTypes::BOOLEAN:
            case PropelColumnTypes::BOOLEAN_EMU:
                return static function() use ($generator) {
                    return $generator->boolean;
                };
            case PropelColumnTypes::NUMERIC:
            case PropelColumnTypes::DECIMAL:
                $size = $column->getSize();

                return static function() use ($generator, $size) {
                    return $generator->randomNumber($size + 2) / 100;
                };
            case PropelColumnTypes::TINYINT:
                return static function() {
                    return \random_int(0, 127);
                };
            case PropelColumnTypes::SMALLINT:
                return static function() {
                    return \random_int(0, 32767);
                };
            case PropelColumnTypes::INTEGER:
                return static function() {
                    return \random_int(0, 2147483647);
                };
            case PropelColumnTypes::BIGINT:
                return static function() {
                    return \random_int(0, 9223372036854775807);
                };
            case PropelColumnTypes::FLOAT:
                return static function() {
                    return \random_int(0, 2147483647) / \random_int(1, 2147483647);
                };
            case PropelColumnTypes::DOUBLE:
            case PropelColumnTypes::REAL:
                return static function() {
                    return \random_int(0, 9223372036854775807) / \random_int(1, 9223372036854775807);
                };
            case PropelColumnTypes::CHAR:
            case PropelColumnTypes::VARCHAR:
            case PropelColumnTypes::BINARY:
            case PropelColumnTypes::VARBINARY:
                $size = $column->getSize();

                return static function() use ($generator, $size) {
                    return $generator->text($size);
                };
            case PropelColumnTypes::LONGVARCHAR:
            case PropelColumnTypes::LONGVARBINARY:
            case PropelColumnTypes::CLOB:
            case PropelColumnTypes::CLOB_EMU:
            case PropelColumnTypes::BLOB:
                return static function() use ($generator) {
                    return $generator->text;
                };
            case PropelColumnTypes::ENUM:
                $valueSet = $column->getValueSet();

                return static function() use ($generator, $valueSet) {
                    return $generator->randomElement($valueSet);
                };
            case PropelColumnTypes::OBJECT:
            case PropelColumnTypes::PHP_ARRAY:
            default:
                // no smart way to guess what the user expects here
                return null;
        }
    }
}
