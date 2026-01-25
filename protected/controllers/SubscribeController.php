<?php

class SubscribeController extends Controller
{
    public $layout = false;

    public function actionIndex()
    {
        $model = new SubscribeForm();

        if (Yii::app()->request->isPostRequest) {
            $model->attributes = $_POST['SubscribeForm'];

            if ($model->subscribe()) {
                echo json_encode(['success' => true, 'message' => 'Подписка оформлена!']);
            } else {
                echo json_encode(['success' => false, 'errors' => $model->getErrors()]);
            }

            Yii::app()->end();
        }
    }
}
