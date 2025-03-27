<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RolesMenusTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RolesMenusTable Test Case
 */
class RolesMenusTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RolesMenusTable
     */
    protected $RolesMenus;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.RolesMenus',
        'app.Roles',
        'app.Menus',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RolesMenus') ? [] : ['className' => RolesMenusTable::class];
        $this->RolesMenus = $this->getTableLocator()->get('RolesMenus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->RolesMenus);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RolesMenusTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\RolesMenusTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
