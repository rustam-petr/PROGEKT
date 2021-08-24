<?php


namespace App\Helper;


class Password
{
    protected string $pass;

    public function __construct(string $pass)
    {
        $this->setPass($pass);
    }

    /** проверяем на минимальное число символов 8
     * @param string $pass
     * @return $this
     */
    public function setPass(string $pass): static
    {
        $this->pass = $pass;
        return $this;
    }

    public function checkMinSize(): bool
    {
        return mb_strlen($this->pass) >= 8;
    }

    /** проверяем на максимальное число символов 128
     * @return bool
     */
    public function checkMaxSize(): bool
    {
        return mb_strlen($this->pass) <= 128;

    }

    /** проверка на наличие арбских цифр
     * @return bool
     */
    public function containsNumbers(): bool
    {
        return (bool) preg_match_all("/[0-9]/", $this->pass);
    }

    /** проверка на наличие кириллических букв
     * @return bool
     */
    public function checkCyrillic(): bool
    {
        return (bool) preg_match_all("/[а-я]/iu", $this->pass);
    }

    /** проверка на наличие латинских букв
     * @return bool
     */
    public function checkLatin(): bool
    {
        return (bool) preg_match_all("/[a-z]/iu", $this->pass);
    }

    /** проверка на наличие данных символов из шаблона
     * @return bool
     */
    public function checkForbiddenSymbols(): bool
    {
        return !preg_match_all("/[~!?@#$%^&*_\-+()\[\]{}><\/\\\|\"\\\'\\\.,:;]/u", $this->pass);
    }

    /** проверка на наличие хоты бы одной строчной и одной заглавной буквы
     * @return bool
     */
    public function checkUpperLowerSymbols(): bool
    {
        return preg_match_all("/[a-zа-я]/u", $this->pass) && preg_match_all("/[A-ZА-Я]/u", $this->pass);

    }

    /** проверка на наличие пробелов
     * @return bool
     */
    public function checkSpaceSymbol(): bool
    {
        return (bool) preg_match_all("/\s/iu", $this->pass);
    }


}