<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomizaveisRolesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomizaveisRolesTable Test Case
 */
class CustomizaveisRolesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomizaveisRolesTable
     */
    protected $CustomizaveisRoles;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.CustomizaveisRoles',
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
        $config = $this->getTableLocator()->exists('CustomizaveisRoles') ? [] : ['className' => CustomizaveisRolesTable::class];
        $this->CustomizaveisRoles = $this->getTableLocator()->get('CustomizaveisRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CustomizaveisRoles);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CustomizaveisRolesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CustomizaveisRolesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
