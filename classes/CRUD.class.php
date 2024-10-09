<?php

abstract class CRUD{
    protected $table;
    abstract function add();
    abstract function update($field, $id);
}