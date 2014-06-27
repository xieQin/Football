<?php

function EQ($name, $value) {

    return new QueryEntity($name . "=?", array($value));
}

function NE($name, $value) {
    return new QueryEntity($name . "!=?", array($value));
}

function LT($name, $value) {
    return new QueryEntity($name . "<?", array($value));
}

function LTE($name, $value) {
    return new QueryEntity($name . "=<?", array($value));
}

function GT($name, $value) {
    return new QueryEntity($name . ">?", array($value));
}

function GTE($name, $value) {
    return new QueryEntity($name . ">=?", array($value));
}

function AndQuery() {
    $paramCount = func_num_args();
    if ($paramCount < 2) {
        throw new Exception("params count less 2!");
    }


    $paramsArray = func_get_args();
    if (!$paramsArray[0] instanceof QueryEntity) {
        throw new Exception("params is not QueryEntity");
    }
    $query = $paramsArray[0]->condition;
    $arr = $paramsArray[0]->params;

    for ($index = 1; $index < count($paramsArray); $index++) {
        $query = $query . " And " . $paramsArray[$index]->condition;
        $arr = array_merge($arr, $paramsArray[$index]->params);
    }


    return new QueryEntity(" (" . $query . ") ", $arr);
}

function OrQuery() {
    $paramCount = func_num_args();
    if ($paramCount < 2) {
        throw new Exception("params count less 2!");
    }
    $paramsArray = func_get_args();
    if (!$paramsArray[0] instanceof QueryEntity) {
        throw new Exception("params is not QueryEntity");
    }

    $query = $paramsArray[0]->condition;
    $arr = $paramsArray[0]->params;
    for ($index = 1; $index < count($paramsArray); $index++) {
        $query = $query . " Or " . $paramsArray[$index]->condition;
        $arr = array_merge($arr, $paramsArray[$index]->params);
    }


    return new QueryEntity(" (" . $query . ") ", $arr);
}


