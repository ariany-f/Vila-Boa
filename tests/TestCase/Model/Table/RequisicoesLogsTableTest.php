<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequisicoesLogsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequisicoesLogsTable Test Case
 */
class RequisicoesLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RequisicoesLogsTable
     */
    protected $RequisicoesLogs;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.RequisicoesLogs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RequisicoesLogs') ? [] : ['className' => RequisicoesLogsTable::class];
        $this->RequisicoesLogs = $this->getTableLocator()->get('RequisicoesLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->RequisicoesLogs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RequisicoesLogsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
