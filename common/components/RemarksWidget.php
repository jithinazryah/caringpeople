<?php

namespace common\components;

use yii\base\Widget;
use yii\helpers\Html;
use common\models\Remarks;

class RemarksWidget extends Widget {

        public $model;
        public $type_id;
        public $type;
        public $form;

        public function init() {
                parent::init();
        }

        public function run() {

                return $this->render('_remarks_form', ['type_id' => $this->type_id, 'type' => $this->type, 'model' => $this->model, 'form' => $this->form]);
        }

}

?>