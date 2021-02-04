<?php

namespace app\modules\api\controllers;

use app\modules\api\models\Categories;
use Yii;
use yii\web\Controller;

class CategoriesController extends Controller
{
	public $enableCsrfValidation = false;
	public $data;

	public function beforeAction($action)
	{
		$this->getData();
		return parent::beforeAction($action); // TODO: Change the autogenerated stub
	}

	public function actionIndex()
	{
		$categories = Categories::find()
			->orderBy('id DESC')
			->asArray()
			->all();
		return $this->buildTree($categories);
	}

	public function actionCreate()
	{
		$model = new Categories();
		$model->title = $this->data->title;
		$model->parent_id = $this->data->parent_id;
		if ($model->save()) {
			return [
				'result' => true,
				'id' => $model->id
			];
		} else {
			return [
				'result' => false
			];
		}
	}

	public function actionUpdate()
	{
		$model = Categories::findOne($this->data->id);
		$model->title = $this->data->title;
		$model->parent_id = $this->data->parent_id;
		if ($model->save()) {
			return [
				'result' => true,
				'id' => $model->id
			];
		} else {
			return [
				'result' => false
			];
		}
	}

	public function actionDelete()
	{
		$model = Categories::findOne($this->data->id);
		return $model->delete();
	}

	private function buildTree(array $elements, $parentId = null) : array
	{
		$branch = [];

		foreach ($elements as $element) {
			if ($element['parent_id'] == $parentId) {
				$children = $this->buildTree($elements, $element['id']);
				if ($children) {
					$element['children'] = $children;
				}
				$branch[] = $element;
			}
		}

		return $branch;
	}

	public function getData()
	{
		if (Yii::$app->request->isPost) {
			$this->data = json_decode(file_get_contents("php://input"));
		} else {
			exit();
		}
	}
}