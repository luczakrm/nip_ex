<?php

namespace App\Service;

use App\Exception\InvalidValueException;
use App\Exception\InvalidValueLengthException;
use App\Exception\InvalidValueTypeException;
use App\Exception\MissingValueException;

/**
 * Service with NIP validator
 */
class NipValidatorService {

    const DEFAULT_LENGTH = 10;

    /**
     * returns true if NIP value is correct or throws exception with error
     *
     * @param $value
     * @return bool
     * @throws InvalidValueLengthException
     * @throws InvalidValueTypeException
     * @throws MissingValueException
     * @throws InvalidValueException
     */
    public function validate($value): bool
    {
        if (gettype($value) !== 'string') {
            throw new InvalidValueTypeException();
        }

        if (empty($value)) {
            throw new MissingValueException();
        }

        $value = $this->normalize($value);

        if (strlen($value) !== self::DEFAULT_LENGTH) {
            throw new InvalidValueLengthException();
        }

        $result = $this->checkValue($value);

        if (!$result) {
            throw new InvalidValueException();
        }

        return true;
    }

    /**
     * normalize value with trim and replace separators for clear value
     */
    private function normalize($value): string
    {
        $value = trim($value);

        return str_replace('-', '', $value);
    }

    /**
     * return true if NIP value is correct
     *
     * @param string $value
     * @return bool
     */
    private function checkValue(string $value): bool
    {
        $steps = [6, 5, 7, 2, 3, 4, 5, 6, 7];

        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += $steps[$i] * $value[$i];
        }

        $int = $sum % 11;

        return $int == $value[9];
    }
}