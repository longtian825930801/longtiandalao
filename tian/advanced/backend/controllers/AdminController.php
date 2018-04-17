<?php
namespace backend\controllers;
header('content-type:text/html;charset=utf-8');
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use app\models\Country;
use app\models\admin;
use app\models\log;
/**
 * Site controller
 */
class AdminController extends Controller
{
    /**
     * @inheritdoc
     */
    /**
        * 管理员展示
        */
   
	   public function actionAdmin_list()
	   {
          $session = Yii::$app->session;
          $name = $session->get('admin_name');
          $model = new admin();
          $reach = $model::find();
        //判断搜索语句
        if($keywords = Yii::$app->request->get('admin_name')){
             
            $reach->where(['like','admin_name',$keywords]);
        }
        $pagination = new Pagination([
        'defaultPageSize' => 3,//每页显示多少
        'totalCount' => $reach->count(),//总数据数
        ]);


        $list = $reach
                    ->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->asArray()
                    ->all();
                    // echo $list->createCommand()->getRawSql();die;
        // var_dump($list);die;
        if ($list) {
            $model = new log;
            $d = time();
            $da = $name; 
            $dat = $_SERVER['REMOTE_ADDR'];
            $j = "查看管理员管理";
            // $sql = $model->save();
            $a = YII::$app->db->createCommand("insert into log (add_time,name,ip,conment) values ('$d','$da','$dat','$j')")->execute();
            // var_dump($data);die;
            // var_dump($sql);die;
            if ($a) {
                return $this->render('admin_list',['arr'=>$list,
                                        'pagination'=>$pagination,
                                    ]);
            }else{
                echo "管理员管理查看失败";
            }
        }else{
                echo "查看失败";
        }
       
	   	 	   }
       //添加管理员
       public function actionAdd_admin()
       {

          return $this->render('add_admin');
       }
         public function actionAdd_admin_do()
       {
            
            $post=Yii::$app->request->post();
             // var_dump($post);die;
            $res = \Yii::$app->db->createCommand()->insert('admin',$post)->execute();
            if($res){
                echo "<script>alert('添加成功');location.href='?r=admin/admin_list'</script>";
            }else{
                echo "<script>alert('添加失败');location.replace(document.referrer);</script>";
            }    
       }
         //删除管理员
     public function actionAdmin_del()
       {
        $admin_id=Yii::$app->request->get('admin_id');
        $res = \Yii::$app->db->createCommand()->delete('admin', "admin_id=".$admin_id)->execute();
        if($res){
            echo "<script>alert('删除成功');location.replace(document.referrer);</script>";
        }else{
            echo "<script>alert('删除失败');location.replace(document.referrer)</script>";
        } 
         
       }
        //退出
         public function actionFromout(){
        //   echo 1;die;
        $session = Yii::$app->session;
        if($session->remove('admin_name')){
            echo "<script>alert('退出成功');location.href='?r=login/login'</script>";
        }else{
            echo "<script>alert('退出失败');location.href='?r=default/tong'</script>";
        }
    }
  
}
