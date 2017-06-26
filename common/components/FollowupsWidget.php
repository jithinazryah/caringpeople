<?php

namespace common\components;

use yii\base\Widget;
use yii\helpers\Html;


class FollowupsWidget extends Widget {

        public $model;
        public $type_id;
        public $type;
        public $form;
        

        public function init() {
                parent::init();
        }

        public function run() {
                return $this->render('_followup_form', ['type_id' => $this->type_id, 'type' => $this->type,'form'=>$his->form]);
        }

}

?>