<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use app\models\Supplier;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Suppliers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Supplier', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php $gridColumns = [
        [
            'name' => 'id',
            'class' => 'kartik\grid\CheckboxColumn',
        ],
        'id',
        'name',
        'code',
        [
            'attribute' => 't_status',
            'filter' => $searchModel->getTStatusList(),
        ],
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, Supplier $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
             }
        ],
    ];?>
    
    <?= ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'encoding' => 'gb2312',
        'dropdownOptions' => [
            'label' => '导出',
            'class' => 'btn btn-default',
            'export' => true,
            'toolbar'=>[
                '{export}',
                '{toggleData}'
            ],
        ],
        'exportConfig' => [
            ExportMenu::FORMAT_TEXT => false,
            ExportMenu::FORMAT_PDF => false,
            ExportMenu::FORMAT_EXCEL_X => false,
            ExportMenu::FORMAT_HTML => false,
            ExportMenu::FORMAT_EXCEL => false,
        ],
        'columnSelectorOptions'=>[
            'label' => '选择字段',
        ],
        'filename' => '导出_'.date('Y-m-d'),
//         'selectedColumns'=> [1, 2], // 导出不选中#和操作栏
        'hiddenColumns'=>[0], // 隐藏#和操作栏
    ]);?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterSelector' => "input[name='".$dataProvider->getPagination()->pageParam."']",
        'columns' => $gridColumns,
        'export' => false,
    ]); ?>
    
</div>
