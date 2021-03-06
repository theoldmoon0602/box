<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * PendingQuestions Controller
 *
 * @property \App\Model\Table\PendingQuestionsTable $PendingQuestions
 *
 * @method \App\Model\Entity\PendingQuestion[] paginate($object = null, array $settings = [])
 */
class PendingQuestionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		if (! $this->Auth->user('is_admin')) {
			return $this->redirect(['action'=>'add']);
		}
        $this->paginate = [
            'contain' => ['Users']
        ];
        $pendingQuestions = $this->paginate($this->PendingQuestions);

        $this->set(compact('pendingQuestions'));
        $this->set('_serialize', ['pendingQuestions']);
    }

    /**
     * View method
     *
     * @param string|null $id Pending Question id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		if (is_null($id)) {
			return $this->redirect(['action'=>'add']);
		}
        $pendingQuestion = $this->PendingQuestions->get($id, [
            'contain' => ['Users']
        ]);
		if (! $this->Auth->user('is_admin') && $pendingQuestion->user_id !== $this->Auth->user('id')) {
			return $this->redirect(['action'=>'add']);
		}

        $this->set('pendingQuestion', $pendingQuestion);
        $this->set('_serialize', ['pendingQuestion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pendingQuestion = $this->PendingQuestions->newEntity();
        if ($this->request->is('post')) {
            $pendingQuestion = $this->PendingQuestions->patchEntity($pendingQuestion, $this->request->getData());
			$pendingQuestion->user_id = $this->Auth->user('id');
            if ($this->PendingQuestions->save($pendingQuestion)) {
				$this->loadModel('Users');
				$email = new Email();
				$email->setTransport('gmail');
				$admin = $this->Users->find()->where(['is_admin' => 1])->first();
				$email
					->from('theoldmoon0602@theoldmoon0602.tk', 'theoldmoon0602')
					->to($admin->email)
					->subject('質問がきてますで')
					->send('みてくれ→ ' . Router::url([
						'controller' => 'PendingQuestions',
						'action' => 'answer',
						$pendingQuestion->id
					], true));
                $this->Flash->success(__('質問を受け付けましたっ'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('ぶっぶー、だめでーす'));
        }
        $users = $this->PendingQuestions->Users->find('list', ['limit' => 200]);
        $this->set(compact('pendingQuestion', 'users'));
        $this->set('_serialize', ['pendingQuestion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Pending Question id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		if (! $this->Auth->user('is_admin')) {
			return $this->redirect(['action'=>'add']);
		}
        $pendingQuestion = $this->PendingQuestions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pendingQuestion = $this->PendingQuestions->patchEntity($pendingQuestion, $this->request->getData());
            if ($this->PendingQuestions->save($pendingQuestion)) {
                $this->Flash->success(__('The pending question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pending question could not be saved. Please, try again.'));
        }
        $users = $this->PendingQuestions->Users->find('list', ['limit' => 200]);
        $this->set(compact('pendingQuestion', 'users'));
        $this->set('_serialize', ['pendingQuestion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Pending Question id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		if (! $this->Auth->user('is_admin')) {
			return $this->redirect(['action'=>'add']);
		}
        $this->request->allowMethod(['post', 'delete']);
        $pendingQuestion = $this->PendingQuestions->get($id);
        if ($this->PendingQuestions->delete($pendingQuestion)) {
            $this->Flash->success(__('The pending question has been deleted.'));
        } else {
            $this->Flash->error(__('The pending question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

	public function answer($id = null)
	{
		if (! $this->Auth->user('is_admin')) {
			return $this->redirect(['action'=>'add']);
		}

		$pendingQuestion = $this->PendingQuestions->get($id, ['contain' => 'Users']);
		if ($this->request->is('put')) {
			$quesionsTable = TableRegistry::get('Questions');
			$question = $quesionsTable->newEntity();
			$question->user_id = $pendingQuestion->user_id;
			$question->text = $pendingQuestion->text;
			$question->answer = $this->request->getData('answer');

			$this->loadModel('Questions');
            if ($this->Questions->save($question)) {
				$this->PendingQuestions->delete($pendingQuestion);
				$email = new Email();
				$email->setTransport('gmail');
				$email
					->from('theoldmoon0602@theoldmoon0602.tk', 'theoldmoon0602')
					->to($pendingQuestion->user->email)
					->subject('あなたの質問にふるつきがおこたえしましたので')
					->send('みてくれ→ ' . Router::url([
						'controller' => 'Questions',
						'action' => 'view',
						$question->id
					], true));

                $this->Flash->success(__('おっけー解答おわり'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('んーとなんか失敗しました'));
		}
		$this->set(compact("pendingQuestion"));
	}


	// うまくいかなかったなぜ
	// public function isAuthorized($user)
	// {
	// 	if ($this->request->getParam('action') === 'add') {
	// 		return parent::isAuthorized($user);
	// 	}
	// 	return $user['is_admin'] && parent::isAuthorized($user);
	// }
}
