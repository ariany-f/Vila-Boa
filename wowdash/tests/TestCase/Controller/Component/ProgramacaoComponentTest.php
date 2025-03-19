<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ProgramacaoComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ProgramacaoComponent Test Case
 */
class ProgramacaoComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\ProgramacaoComponent
     */
    protected $Programacao;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Programacao = new ProgramacaoComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Programacao);

        parent::tearDown();
    }
}
