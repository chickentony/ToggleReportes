<?php

declare(strict_types=1);

namespace Tests\acceptance;

use AcceptanceTester;
use Tests\_support\Page\PageObjectExample;

class ExampleCest
{
    /**
     * @param AcceptanceTester $I
     * @param PageObjectExample $example
     * Пример теста, если начальная страница была изменена, тест не будет работать.
     */
    public function testSomething(AcceptanceTester $I, PageObjectExample $example): void
    {
        $I->amOnPage($example::PAGE_URL);
        $I->see('Laravel');
        $example->exampleAction();
        $I->see('Laravel');
    }

}
