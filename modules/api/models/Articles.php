<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $title
 * @property string|null $body
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property ArticleMapping[] $articleMappings
 */
class Articles extends \yii\db\ActiveRecord
{

	public $category_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['body'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

	public static function getArticles()
	{
		$sql = "SELECT
				`articles`.*,
				article_cats.* 
			FROM
				`articles`
				left join ( 
					SELECT article_mapping.article_id,
						group_concat( categories.title ) AS categories 
					FROM
						`article_mapping`
						LEFT JOIN `categories` ON article_mapping.category_id = categories.id 
				) as article_cats on article_cats.article_id = articles.id
			";
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand($sql);
		return $command->queryAll();
	}

	public static function getArticlesByCategory(int $category_id)
	{
		$sql = "SELECT `articles`.*, article_cats.* FROM articles
					LEFT JOIN ( SELECT article_mapping.article_id, group_concat( categories.title ) AS categories
					FROM `article_mapping` LEFT JOIN `categories` ON article_mapping.category_id = categories.id )
					    AS article_cats ON article_cats.article_id = articles.id 
					WHERE id IN ( SELECT article_id FROM article_mapping 
						WHERE category_id IN ( SELECT id FROM (
						    SELECT id, parent_id FROM categories ORDER BY parent_id, id ) categories_sorted,
								( SELECT @pv := $category_id ) initialisation 
							WHERE
								find_in_set( parent_id, @pv ) 
								AND length(
								@pv := concat( @pv, ',', id )) 
								OR id = $category_id 
						) 
					GROUP BY ( article_id ))";
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand($sql);
		return $command->queryAll();
	}

    /**
     * Gets query for [[ArticleMappings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticleMappings()
    {
        return $this->hasMany(ArticleMapping::className(), ['article_id' => 'id']);
    }
}
