<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Client; // Adicionando a importação da classe Client
use Cake\Utility\Xml;

/**
 * Requisicoes Controller
 *
 * @property \App\Model\Table\RequisicoesLogs $RequisicoesLogs
 */
class RequisicoesController extends AppController
{
    protected $RequisicoesLogs;

    public function initialize(): void
    {
        parent::initialize();
        $this->RequisicoesLogs = $this->fetchTable('RequisicoesLogs');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->set('title', 'Requisição');
        $this->set('subTitle', 'Logs');
        
        $query = $this->RequisicoesLogs->find();
        $requisicoesLogs = $this->paginate($query);

        $this->set(compact('requisicoesLogs'));
    }

    /**
     * View method
     *
     * @param string|null $id Requisico id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $requisico = $this->RequisicoesLogs->get($id, contain: []);
        $this->set(compact('requisico'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Requisico id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requisico = $this->RequisicoesLogs->get($id);
        if ($this->RequisicoesLogs->delete($requisico)) {
            $this->Flash->success(__('The requisico has been deleted.'));
        } else {
            $this->Flash->error(__('The requisico could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function diversos()
    {
        $this->set('title', 'Requisição');
        $this->set('subTitle', 'Diversos');

        $form = $this->RequisicoesLogs->newEmptyEntity();
        
        if ($this->request->is('post')) {

            // Gerar o XML com os dados recebidos no formulário
            $xmlData = $this->generateXml($this->request->getData());

            // Enviar o XML para o webhook
            $result = $this->sendXmlToWebhook( html_entity_decode($xmlData) );

            // Definir o valor do payload com o XML gerado
            $formData = ['payload' => html_entity_decode($xmlData), 'status' => ($result ? 'sucesso' : 'falha')]; // Defina o campo 'payload' com a string XML gerada
            
            $form = $this->RequisicoesLogs->patchEntity($form, $formData);
            
            if ($this->RequisicoesLogs->save($form)) {
                $this->Flash->success('Formulário salvo com sucesso.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                // Recupera os erros da entidade
                $errors = $form->getErrors();
                $errorMessage = '';

                // Itera sobre os erros para construir uma mensagem
                foreach ($errors as $field => $fieldErrors) {
                    $errorMessage .= $field . ': ' . implode(', ', $fieldErrors) . '<br>';
                }

                $this->Flash->error('Erro ao salvar o formulário: ' . $errorMessage);
            }
        }
        $this->set(compact('form'));
    }

    public function poda()
    {
        $this->set('title', 'Requisição');
        $this->set('subTitle', 'Poda');

        $form = $this->RequisicoesLogs->newEmptyEntity();
        
        if ($this->request->is('post')) {

            // Gerar o XML com os dados recebidos no formulário
            $xmlData = $this->generateXml($this->request->getData());

            // Enviar o XML para o webhook
            $result = $this->sendXmlToWebhook( html_entity_decode($xmlData) );

            // Definir o valor do payload com o XML gerado
            $formData = ['payload' => html_entity_decode($xmlData), 'status' => ($result ? 'sucesso' : 'falha')]; // Defina o campo 'payload' com a string XML gerada
            
            $form = $this->RequisicoesLogs->patchEntity($form, $formData);
            
            if ($this->RequisicoesLogs->save($form)) {
                $this->Flash->success('Formulário salvo com sucesso.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                // Recupera os erros da entidade
                $errors = $form->getErrors();
                $errorMessage = '';

                // Itera sobre os erros para construir uma mensagem
                foreach ($errors as $field => $fieldErrors) {
                    $errorMessage .= $field . ': ' . implode(', ', $fieldErrors) . '<br>';
                }

                $this->Flash->error('Erro ao salvar o formulário: ' . $errorMessage);
            }
        }
        $this->set(compact('form'));
    }

    public function recolha()
    {
        $this->set('title', 'Requisição');
        $this->set('subTitle', 'Recolha');

        $form = $this->RequisicoesLogs->newEmptyEntity();
        
        if ($this->request->is('post')) {

            // Gerar o XML com os dados recebidos no formulário
            $xmlData = $this->generateXml($this->request->getData());

            // Enviar o XML para o webhook
            $result = $this->sendXmlToWebhook( html_entity_decode($xmlData) );

            // Definir o valor do payload com o XML gerado
            $formData = ['payload' => html_entity_decode($xmlData), 'status' => ($result ? 'sucesso' : 'falha')]; // Defina o campo 'payload' com a string XML gerada
            
            $form = $this->RequisicoesLogs->patchEntity($form, $formData);
            
            if ($this->RequisicoesLogs->save($form)) {
                $this->Flash->success('Formulário salvo com sucesso.');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                // Recupera os erros da entidade
                $errors = $form->getErrors();
                $errorMessage = '';

                // Itera sobre os erros para construir uma mensagem
                foreach ($errors as $field => $fieldErrors) {
                    $errorMessage .= $field . ': ' . implode(', ', $fieldErrors) . '<br>';
                }

                $this->Flash->error('Erro ao salvar o formulário: ' . $errorMessage);
            }
        }
        $this->set(compact('form'));
    }

    private function generateXml($data)
    {
        // Começar com o nó XML raiz
        $xmlString = htmlspecialchars('<xml>');
        
        // Gerar o XML a partir dos dados do formulário
        $xmlString .= $this->arrayToXmlString($data, '    ');
        
        // Fechar o nó XML raiz
        $xmlString .= htmlspecialchars('</xml>');
        
        return $xmlString;
    }
    
    private function arrayToXmlString($data, $indent = '')
    {
        $xmlString = '';
    
        foreach ($data as $key => $value) {
            // Se o valor for um array, faz a chamada recursiva
            if (is_array($value)) {
                $xmlString .= $indent . '<' . $key . '>' . "\n";
                $xmlString .= $this->arrayToXmlString($value, $indent . '    '); // Recursão para arrays
                $xmlString .= $indent . '</' . $key . '>' . "\n";
            } else {
                // Se o valor não for um array, cria uma tag XML
                $xmlString .= $indent . htmlspecialchars("<$key>") . htmlspecialchars((string) $value) . htmlspecialchars("</$key>"). "\n";
            }
        }
    
        return $xmlString;
    }

    /**
     * Envia o XML para o webhook.
     */
    private function sendXmlToWebhook($xmlData)
    {
        $http = new Client();
        
        // URL do Webhook
        $url = 'https://hook.us1.make.com/t6fmi9gd6e8ajajs21s12vr5riiahhn4';

        // Enviar a requisição POST com o XML
        $response = $http->post(
            $url,
            array("data" => $xmlData),
            [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',  // Defina o tipo de conteúdo como XML
                ]
            ]
        );

        // Verificar a resposta do Webhook
        if ($response->isOk()) {
            // Se necessário, trate a resposta do webhook aqui
            $this->Flash->success('Dados enviados para o webhook com sucesso.');
            return true;
        } else {
            $this->Flash->error('Erro ao enviar dados para o webhook.');
            return false;
        }
    }
}
