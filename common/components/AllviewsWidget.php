<?php

namespace common\components;

use yii\base\Widget;
use yii\helpers\Html;

class AllviewsWidget extends Widget {

        public $model;
        public $type_id;
        public $type;
        public $update_followup;
        public $repeated;

        public function init() {
                parent::init();
        }

        public function run() {

                return $this->render('_followup_form', ['type_id' => $this->type_id, 'type' => $this->type, 'update_followup' => $this->update_followup, 'repeated' => $this->repeated]);
        }

}

?>