<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RelatoriosRolesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RelatoriosRolesTable Test Case
 */
class RelatoriosRolesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RelatoriosRolesTable
     */
    protected $RelatoriosRoles;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.RelatoriosRoles',
        'app.Relatorios',
        'app.Roles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RelatoriosRoles') ? [] : ['className' => RelatoriosRolesTable::class];
        $this->RelatoriosRoles = $this->getTableLocator()->get('RelatoriosRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->RelatoriosRoles);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RelatoriosRolesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\RelatoriosRolesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
