<?php
    trait catch_err_trait {
        function try_catch($api_func) {
            try {
                $api_func();
            } catch (PDOException $e) {
                echo json_encode( array("message" => $e->getMessage(),
                                        "code" => (int)$e->getCode()) );
            }
        }
    }