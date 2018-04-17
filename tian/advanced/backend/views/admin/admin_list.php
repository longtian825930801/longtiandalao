<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理员列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/adminStyle.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.js"></script>
<script src="js/public.js"></script>
</head>
<body>
 <div class="wrap">
  <div class="page-title">
    <span class="modular fl"><i class="user"></i><em>管理员列表</em></span><br>
    <?php $form = ActiveForm::begin(['method'=>'get','action'=>['admin/admin_list']]);?>
                                    <?php echo Html::input('text','admin_name',\Yii::$app->request->get('admin_name'),['placeholder'=>'输入要搜索的用户名'])?>
                                    <?php echo Html::submitButton('搜索',['class'=>'tdBtn']);?>
  <?php $form->end();?>
    <span class="modular fr"><a href="http://www.ht.com/index.php?r=admin/add_admin" class="pt-link-btn">+添加管理员</a></span>
  </div>
  <table class="list-style Interlaced">
   <tr>
    <th>管理员id</th>
    <th>管理员账号</th>
    <th>操作</th>
   </tr>
  <?php foreach($arr as $k=>$v){?>
   <tr>
    <td><?php echo $v['admin_id']?></td>
    <td><?php echo $v['admin_name']?></td>
    <td class="center">
    
    <!--  <a href="edit_product.html" title="编辑"><img src="images/icon_edit.gif"/></a> -->
      <a href="index.php?r=admin/admin_del&admin_id=<?php echo $v['admin_id']?>"  title="删除"><img src="images/icon_drop.gif"/></a>
    
    </td>
   </tr>
   <?php }?>

  </table>
  <div class="turnPage center fr">
      <?= LinkPager::widget([ 
    'pagination' => $pagination, 
    'nextPageLabel' => '下一页', 
    'prevPageLabel' => '上一页',
    'firstPageLabel' => '首页', 
    'lastPageLabel' => '尾页',  
]); ?>
  </div>
 </div>
</body>
</html>