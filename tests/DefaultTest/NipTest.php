<?php

declare(strict_types=1);

namespace App\Tests\DefaultTest;

use App\Exception\InvalidValueException;
use App\Exception\InvalidValueLengthException;
use App\Exception\InvalidValueTypeException;
use App\Exception\MissingValueException;
use App\Service\NipValidatorService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class NipTest extends KernelTestCase {

    private NipValidatorService $validator;

    protected function setUp(): void
    {
        $this->validator = new NipValidatorService();
    }


    /**
     * @dataProvider lengthWithoutDashes
     */
    public function testLengthWithoutDashes($value): void
    {
        $this->expectException(InvalidValueLengthException::class);
        $this->validator->validate($value);
    }

    public function lengthWithoutDashes(): array
    {
        return [
            ['116262925800'],
            ['116262'],
        ];
    }

    /**
     * @dataProvider lengthWithDashes
     */
    public function testLengthWithDashes($value): void
    {
        $this->expectException(InvalidValueLengthException::class);
        $this->validator->validate($value);
    }

    public function lengthWithDashes(): array
    {
        return [
            ['116-26-29-258-00'],
            ['116-262'],
        ];
    }

    public function testNoValue(): void
    {
        $this->expectException(MissingValueException::class);

        $value = '';
        $this->validator->validate($value);
    }

    public function testNullValue(): void
    {
        $this->expectException(InvalidValueTypeException::class);

        $value = null;
        $this->validator->validate($value);
    }

    /**
     * @dataProvider invalidValueType
     */
    public function testInvalidValueType($value): void
    {
        $this->expectException(InvalidValueTypeException::class);
        $this->validator->validate($value);
    }

    public function invalidValueType(): array
    {
        return [
            [[]],
            [true],
            [11.11],
        ];
    }

    /**
     * @dataProvider withoutDashesValidChecksumsToTrim
     */
    public function testTrimWithValidChecksums($value): void
    {
        $this->assertTrue($this->validator->validate($value));
    }

    public function withoutDashesValidChecksumsToTrim(): array
    {
        return [
            ['3927892728             '],
            ['        9719921170'],
            [  '6262925802   '],
        ];
    }

    /**
     * @dataProvider withDashesInvalidChecksumsToTrim
     */
    public function testTrimWithInvalidChecksums($value): void
    {
        $this->expectException(InvalidValueException::class);
        $this->validator->validate($value);
    }

    public function withDashesInvalidChecksumsToTrim(): array
    {
        return [
            ['3927892721             '],
            ['        9719921171'],
            [  '6262925801   '],
        ];
    }

    /**
     * @dataProvider withoutDashesValidChecksums
     */
    public function testWithoutDashesValidChecksums($value)
    {
        $this->assertTrue($this->validator->validate($value));
    }

    public function withoutDashesValidChecksums(): array
    {
        return [
            ['3927892728'],
            ['9719921170'],
            ['6262925802'],
            ['1135996055'],
            ['8262583366'],
        ];
    }

    /**
     * @dataProvider withDashesValidChecksums
     */
    public function testWithDashesValidChecksums($value)
    {
        $this->assertTrue($this->validator->validate($value));
    }

    public function withDashesValidChecksums(): array
    {
        return [
            ['392-789-27-28'],
            ['971-992-11-70'],
            ['626-292-58-02'],
            ['11-359-960-55'],
            ['82-625-833-66'],
        ];
    }

    /**
     * @dataProvider withoutDashesInvalidChecksums
     */
    public function testWithoutDashesInvalidChecksums($value)
    {
        $this->expectException(InvalidValueException::class);

        $this->validator->validate($value);
    }

    public function withoutDashesInvalidChecksums()
    {
        return [
            ['3927892721'],
            ['9719921171'],
            ['6262925801'],
            ['1135996051'],
            ['8262583361'],
        ];
    }

    /**
     * @dataProvider withDashesInvalidChecksums
     */
    public function testWithDashesInvalidChecksums($value)
    {
        $this->expectException(InvalidValueException::class);

        $this->validator->validate($value);
    }

    public function withDashesInvalidChecksums()
    {
        return [
            ['392-789-27-21'],
            ['971-992-11-71'],
            ['626-292-58-01'],
            ['11-359-960-51'],
            ['82-625-833-61'],
        ];
    }
}