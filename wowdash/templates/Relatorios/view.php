<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Relatorio $relatorio
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Relatorio'), ['action' => 'edit', $relatorio->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Relatorio'), ['action' => 'delete', $relatorio->id], ['confirm' => __('Are you sure you want to delete # {0}?', $relatorio->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Relatorios'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Relatorio'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="relatorios view content">
            <h3><?= h($relatorio->titulo) ?></h3>
            <table>
                <tr>
                    <th><?= __('Titulo') ?></th>
                    <td><?= h($relatorio->titulo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($relatorio->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Data Criacao') ?></th>
                    <td><?= h($relatorio->data_criacao) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($relatorio->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated') ?></th>
                    <td><?= h($relatorio->updated) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Descricao') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($relatorio->descricao)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Link Iframe') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($relatorio->link_iframe)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>