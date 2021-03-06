<?php

namespace app\modules\api\controllers;

use app\modules\api\models\ArticleMapping;
use app\modules\api\models\Articles;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class ArticlesController extends Controller
{
	public $enableCsrfValidation = false;
	public $data;

	public function beforeAction($action)
	{
		$this->getData();
		return parent::beforeAction($action); // TODO: Change the autogenerated stub
	}

	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex()
	{
		return Articles::getArticles();
	}

	/*
	 * returns articles by category
	 */

	public function actionCategory()
	{
		return Articles::getArticlesByCategory($this->data->id);
	}

	public function getData()
	{
		$this->data = json_decode(file_get_contents("php://input"));
	}

	public function actionCreate()
	{
		$transaction = Articles::getDb()->beginTransaction();
		try {
			$model = new Articles();
			$model->title = $this->data->title;
			$model->body = $this->data->body;
			if($model->save()) {
				$categoryMap = new ArticleMapping();
				$categories = explode(",", $this->data->category);
				foreach ($categories as $category) {
					$categoryMap->isNewRecord = true;
					$categoryMap->id = null;
					$categoryMap->article_id = $model->id;
					$categoryMap->category_id = $category;
					if (!$categoryMap->save()) {
						return ["result" => false];
					}
				}
				$transaction->commit();
				return ["result" => true];
			}
		} catch(\Exception $e) {
			$transaction->rollBack();
			throw $e;
		} catch(\Throwable $e) {
			$transaction->rollBack();
			throw $e;
		}
		return ["result" => false];
	}

	public function actionUpdate()
	{
		$transaction = Articles::getDb()->beginTransaction();
		try {
			$categoryMap = new ArticleMapping();
			$model = Articles::findOne($this->data->id);
			$model->title = $this->data->title;
			$model->body = $this->data->body;
			$categoryList = $model->getArticleMappings()->asArray()->all();
			$newCategoryList = explode(",", $this->data->category);
			foreach ($categoryList as $item) {
				if (!in_array($item['category_id'], $newCategoryList)) {
					ArticleMapping::findOne($item['id'])->delete();
				}
			}
			foreach ($newCategoryList as $item) {
				foreach ($categoryList as $currentCategory) {
					if ($currentCategory['category_id'] == $item) {
						unset($newCategoryList[array_search($item, $newCategoryList)]);
					}
				}
			}
			foreach ($newCategoryList as $newCategory) {
				$categoryMap->isNewRecord = true;
				$categoryMap->id = null;
				$categoryMap->article_id = $model->id;
				$categoryMap->category_id = $newCategory;
				$categoryMap->save();
			}
			if($model->save()) {
				$transaction->commit();
				return ["result" => true];
			}
		} catch(\Exception $e) {
			$transaction->rollBack();
			return [
				'result' => false,
				'message' => 'Article not found'
			];
		} catch(\Throwable $e) {
			$transaction->rollBack();
			throw $e;
		}
		return ["result" => false];
	}

	public function actionDelete()
	{
		$article = Articles::findOne($this->data->id);
		if ($article) {
			$article->delete();
			return ['result' => true];
		}
		return [
			'result' => false,
			'message' => 'Article not found'
		];
	}
}
