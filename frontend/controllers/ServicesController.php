<?php

namespace frontend\controllers;

class ServicesController extends \yii\web\Controller {

        public function actionIndex() {
                return $this->render('index');
        }

        /**
         * Displays services-doctor-visit page.
         *
         * @return mixed
         */
        public function actionDoctorVisit() {
                return $this->render('doctor-visit');
        }

        /**
         * Displays services-nursing-care page.
         *
         * @return mixed
         */
        public function actionNursingCare() {
                return $this->render('nursing-care');
        }

        /**
         * Displays services-caregiver-service page.
         *
         * @return mixed
         */
        public function actionCaregiver() {
                return $this->render('caregiver-service');
        }

        /**
         * Displays services-laboratory page.
         *
         * @return mixed
         */
        public function actionLaboratory() {
                return $this->render('laboratory');
        }

        /**
         * Displays services-pharmacy page.
         *
         * @return mixed
         */
        public function actionPharmacy() {
                return $this->render('pharmacy');
        }

        /**
         * Displays services-equipment-hire page.
         *
         * @return mixed
         */
        public function actionEquipmentHire() {
                return $this->render('equipment-hire');
        }

        /**
         * Displays services-health-check-up page.
         *
         * @return mixed
         */
        public function actionHealthCheckUp() {
                return $this->render('health-check-up');
        }

}
