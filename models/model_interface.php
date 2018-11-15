<?php
    interface model_interface {
        public function create();
        // public function read();
        // public function update();
        // public function delete();
        // function runPrepStmtChkErr(&$stmt);
        public function fillAttributes($attr_arr);
        public function getAttr($name);
        public function setAttr($name, $val);
        public function getTableName();
    }