<?php

namespace UnitTestRow;

use PHPUnit\Framework\TestCase;
use App\Helper\Password;

class PasswordTest extends TestCase
{
    private Password $row;

    public function setUp(): void
    {
        $this->row = new Password("");
    }

    public function testgetCountNum(): void
    {
        $this->assertTrue(
            $this
                ->row
                ->setPass("iwanttoprogramming")
                ->checkMinSize()
        );

        $this->assertTrue($this
            ->row
            ->setPass("123graFming")
            ->checkMinSize()
        );
    }

    public function testgetCountNumeric(): void
    {
        $this
            ->assertTrue($this
                ->row
                ->setPass("Дорогиедрузобеспечиваетактуальностьдальнейшихнаправлениразвитаясистемымассовсныйэкспериментпроверкиключевыомпонентов")
                ->checkMaxSize()
            );
    }

    public function testgetArabNum(): void
    {
        $this->assertTrue(
            $this
                ->row
                ->setPass("123")
                ->containsNumbers()
        );

        $this->assertFalse(
            $this
                ->row
                ->setPass("jhfjgkt")
                ->containsNumbers()
        );
    }

    public function testgetKir(): void
    {
        $this->assertTrue($this
            ->row
            ->setPass("Дорогиедрузоб")
            ->checkCyrillic()
        );
        $this->assertFalse($this
            ->row
            ->setPass("djhfgiuriugy")
            ->checkCyrillic()
        );

    }

    public function testgetLat(): void
    {
        $this->assertTrue($this
            ->row
            ->setPass("i11wanttoprogramming")
            ->checkLatin()
        );
        $this->assertFalse($this
            ->row
            ->setPass("воплолорл")
            ->checkLatin()
        );

    }

    public function testgetSymbol(): void
    {
        $this->assertTrue($this
            ->row
            ->setPass("i11 want5 to programming24")
            ->checkForbiddenSymbols()
        );

        $this->assertFalse($this
            ->row
            ->setPass("~!?@#$%^&*_\-+()\[\]{}><\/\|\"\\\'\\\.,:;i11 want5 to programming24")
            ->checkForbiddenSymbols()
        );

        $this->assertTrue($this
            ->row
            ->setPass("ant5 to programming24")
            ->checkForbiddenSymbols()
        );
    }

    public function testgetTopBot(): void
    {
        $this->assertTrue($this
            ->row
            ->setPass("iwDntto4programming24")
            ->checkUpperLowerSymbols()
        );
    }

    public function testgetWhitespace(): void
    {
        $this->assertFalse($this
            ->row
            ->setPass("i11want5toprogramming24")
            ->checkSpaceSymbol()
        );
    }
}
