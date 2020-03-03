<?php

declare(strict_types=1);

namespace Tests\_support\Page;

use AcceptanceTester;

class PageObjectExample
{
    /** @var string URL страницы */
    public const PAGE_URL = '/';

    /** @var string Первая ссылка на странице */
    public const FIRST_LINK = '//div[@class="content"]//a[1]';

    /** @var AcceptanceTester */
    protected $tester;

    /**
     * PageObjectExample constructor.
     * @param AcceptanceTester $tester
     */
    public function __construct(AcceptanceTester $tester)
    {
        $this->tester = $tester;
    }

    /** Кликает на первую ссылку */
    public function exampleAction(): void
    {
        $this->tester->click(self::FIRST_LINK);
        $this->tester->moveBack();
    }

}
