<?php

namespace common\components;

use yii\base\Widget;
use yii\helpers\Html;

class ViewlinkssWidget extends Widget {

        public $type_id;
        public $type;

        public function init() {
                parent::init();
        }

        public function run() {

                return $this->render('_viewlinks', ['type_id' => $this->type_id, 'type' => $this->type]);
        }

}

?>