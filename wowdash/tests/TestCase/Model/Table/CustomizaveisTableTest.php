<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomizaveisTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomizaveisTable Test Case
 */
class CustomizaveisTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomizaveisTable
     */
    protected $Customizaveis;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Customizaveis',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Customizaveis') ? [] : ['className' => CustomizaveisTable::class];
        $this->Customizaveis = $this->getTableLocator()->get('Customizaveis', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Customizaveis);

        parent::tearDown();
    }
}
