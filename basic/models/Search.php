<?php
namespace app\models;
 
use app\models\Elastic;
 
use yii\base\Model;
 
use yii\elasticsearch\ActiveDataProvider;
 
use yii\elasticsearch\Query;
 
use yii\elasticsearch\QueryBuilder;
 
/**
 
* ArticlesSearch represents the model behind the search form about `app\models\Articles`.
 
*/
 
class Search extends Elastic
 
{
 
   public function Searches($value)
 
   {
 
       $searchs      = $value['search'];
 
       $query        = new Query();
 
       $db           = Elastic::getDb();
 
       $queryBuilder = new QueryBuilder($db);
 
       $match   = ['match' => ['_all' =>$searchs]];
 
       $query->query = $match;
 
       $build        = $queryBuilder->build($query);
 
       $re           = $query->search($db, $build);
 
       $dataProvider = new ActiveDataProvider([
 
           'query'      => $query,
 
           'pagination' => ['pageSize' => 2],
 
       ]);
 
       return $dataProvider;
 
   }
 
}