<?php

namespace modules\feedback\controllers;

use core\Controller;
use core\Html;
use core\Parameters;
use core\Request;
use modules\feedback\models\FeedbackModel;
use modules\feedback\models\mFeedback;
use modules\feedback\models\mFeedbackFields;

class Admin extends Controller
{

	public $html;
	public $menu = 'topmenu.php';

	function __construct()
	{
		$this->html = Html::instance();
		parent::__construct();
	}

	function actionIndex()
	{
		$this->html->title   = 'Управление feedback';
        $this->html->content = $this->render(
            'index.php', [
                'topmenu'   => $this->render($this->menu),
                'feedbacks' => mFeedback::listFeedbacks()
            ]
        );
		$this->showTemplate();
	}

    function actionSaveallmail()
    {
        if(isset($_POST['allmail'])){
            Parameters::set($_POST, 'feedback_allmail');
        }
        header('Location: /feedback/admin/listforms');
        exit;
    }

	function actionReadFeedbacks($id)
	{
		$Feedbacks = mFeedback::getFeedbackArr($id);
		if (!$Feedbacks) {
			header('Location: /feedback/admin/');
			die();
		} else {
            $this->html->title   = $Feedbacks[0]->form_name.' - список обращений';
            $this->html->content = $this->render(
				'read.php', [
					'topmenu'   => $this->render($this->menu),
					'feedbacks' => $Feedbacks,
					'form_id'   => $id,
				]
			);
		}
		$this->showTemplate();
	}

	function actionAddForm($id = false)
	{

		if (!empty($_POST)) {
            $data = $_POST;

            $FeedbackFieldsData=$data ;
            $fields = [];
            foreach ($data['fields'] as $key => $value) {
                if(!empty($value['name'])){
                    $fields[$key] = $value;
                }
            }
            $FeedbackFieldsData['fields'] = json_encode($fields);

            if($idFeedbackFields = mFeedbackFields::instance()->saveFeedbackFields($FeedbackFieldsData)){
                header('Location: /feedback/admin/listforms');
                exit;
            }
		} else {
            if ($id == 0) {
                $id = false;
            }
            $data=[];
            $data['model'] = mFeedbackFields::instance()->factory($id);
            $data['topmenu'] = $this->render($this->menu);

			$this->html->title = 'Добавление новой формы на сайте';
			$this->html->setJs('/assets/modules/feedback/js/fields.js');
			$this->html->content = $this->render('add.php', $data);
		}
		$this->showTemplate();
	}

	function actionDelete($id)
	{
        mFeedbackFields::deleteFeedbackFields($id);
        header('Location: /feedback/admin/listforms');
        exit;
	}

	function actionDeleteFeedback($id)
	{
        $idFeedback = mFeedback::deleteFeedback($id);
        //$FeedbackOne = mFeedback::instance()->getOne($idFeedback);
        if (@$_SERVER['HTTP_REFERER'] != null) {
            header("Location: ".$_SERVER['HTTP_REFERER']);
        } else {
            header('Location: /feedback/admin');
        }
        exit;
	}

	function actionDeleteAll($id)
	{
		mFeedback::deleteAllFeedbacks($id);
        header('Location: /feedback/admin');
        exit;
	}

	function actionListForms()
	{
        if (Request::instance()->isAjax()){

            $form_id = Request::instance()->get('form_id');
            $form = mFeedbackFields::getForm($form_id);
            return $form;
        }

        $feedback_allmail = Parameters::get('feedback_allmail');
        $data['allmail']='';
        if(isset($feedback_allmail->allmail)){
            $data['allmail'] = $feedback_allmail->allmail;
        }

		$this->html->title   = 'Список форм на сайте';
        $this->html->setJs('/assets/modules/feedback/js/listforms.js');
		$this->html->content = $this->render(
			'listform.php', [
				'topmenu' => $this->render($this->menu),
				'forms'   => mFeedbackFields::getlistForms(),
                'allmail' => $data['allmail'],
			]
		);
		$this->showTemplate();
	}

	function showTemplate($layout = '@admin')
	{
		$this->html->setTemplate($layout);
		$this->html->renderTemplate()
				   ->show();
	}
}
