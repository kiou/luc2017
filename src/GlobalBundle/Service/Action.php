<?php

	namespace GlobalBundle\Service;

	class Action{

        /**
         * Verifier si le contenu existe
         * @param $contenu int identifiant du contenu
         * @return mixed
         */
        public function ifIsset($contenu){

            if(is_null($contenu)){
                header('HTTP/1.0 404 Not Found');
                die();
            }

        }

	}

?>