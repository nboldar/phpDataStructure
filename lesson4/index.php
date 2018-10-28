<?php

/**
 * Created by PhpStorm.
 * User: nik
 * Date: 27.10.2018
 * Time: 16:57
 */
abstract class Term {

    public $name;
    public $childrenLeft;
    public $childrenRight;
    public $parent;
    public $lec;
    public $const;
    public $var;

    public function __construct($name) {
        $this->name = $name;
    }

    abstract function calc();
}

class Plus extends Term {
    public function calc() {
        return $this->childrenLeft->calc()+$this->childrenRight->calc();
    }
}

class Minus extends Term {
    public function calc() {
        return $this->childrenLeft->calc()-$this->childrenRight->calc();
    }
}

class Multiply extends Term {
    public function calc() {
        return $this->childrenLeft->calc()*$this->childrenRight->calc();
    }
}

class Fission extends Term {
    public function calc() {
        return $this->childrenLeft->calc()/$this->childrenRight->calc();
    }
}

class Exponent extends Term {
    public function calc() {
        return pow ($this->childrenLeft->calc(), $this->childrenRight->calc());
    }
}

class Constant extends Term {
    public function calc() {
        return $this->var;
    }
}

class Variable extends Term {
    public function calc() {
        return $this->var;
    }
}
class Formula
{
    public $formula;
    public $nodesArray;

    public function __construct($formula)
    {
        $this->formula = $formula;


    }

    public function formulaParse()
    {
        $formulaString = str_replace(" ", "", $this->formula);
        $formulaString = trim($formulaString);
        $simbolArr = str_split($formulaString);
        $simbolsNumber = mb_strlen($formulaString);
        $lecsemArray = [];
        $var = '';
        for ($i = 0; $i < $simbolsNumber; $i++) {
            if (is_numeric($simbolArr[$i])) {
                $var .= $simbolArr[$i];
            } else {
                if (!$var == '') {
                    array_push($lecsemArray, $var);
                    $var = '';
                }
                array_push($lecsemArray, $simbolArr[$i]);
            }
        }
        return $lecsemArray;

    }

    public function calculate($x, $y, $z)
    {

        foreach ($this->nodesArray as $obj) {
            if ($obj->const == "x") {
                $obj->var = $x;
            }
            if ($obj->const == "y") {
                $obj->var = $y;
            }
            if ($obj->const == "z") {
                $obj->var = $z;
            }
        }
        foreach ($this->nodesArray as $obj) {
            if (!$obj->parent) {
                return $obj->calc();
            }
        }
    }

    public function buildObj($simbol)
    {
        $arNumNode = [
            "addition" => 1,
            "subtraction" => 1,
            "exponentiation" => 1,
            "multiplication" => 1,
            "division" => 1,
            "number" => 1,
            "constant" => 1
        ];
        switch ($simbol) {

            case "+":
                $name = "Plus" . $arNumNode["addition"];
                $node = new Plus($name);
                ++$arNumNode["addition"];
                break;

            case "-":
                $name = "Minus" . $arNumNode["subtraction"];
                $node = new Minus($name);
                ++$arNumNode["subtraction"];
                break;

            case "*":
                $name = "Multiply" . $arNumNode["multiplication"];
                $node = new Multiply($name);
                ++$arNumNode["multiplication"];
                break;

            case "/":
                $name = "Fission" . $arNumNode["division"];
                $node = new Fission($name);
                ++$arNumNode["division"];
                break;

            case "^":
                $name = "Exponent" . $arNumNode["exponentiation"];
                $node = new Exponent($name);
                ++$arNumNode["exponentiation"];
                break;

            case "x":
                $name = "Constant" . $arNumNode["constant"];
                $node = new Constant($name);
                $node->const = "x";
                $node->var = 0;
                ++$arNumNode["constant"];
                break;

            case "y":
                $name = "Constant" . $arNumNode["constant"];
                $node = new Constant($name);
                $node->const = "y";
                $node->var = 0;
                ++$arNumNode["constant"];
                break;

            case "z":
                $name = "Constant" . $arNumNode["constant"];
                $node = new Constant($name);
                $node->const = "z";
                $node->var = 0;
                ++$arNumNode["constant"];
                break;

            default:
                $name = "Variable" . $arNumNode["number"];
                $node = new Variable($name);
                $node->var = $simbol;
                ++$arNumNode["number"];
        }
        return $node;
    }

    public function findKinkPoint($arrayLec)
    {
        $kinkPoint = null;
        $max = 0;
        $var = 0;
        $prioriry = [
            "+" => 3,
            "-" => 3,
            "*" => 2,
            "/" => 2,
            "^" => 1,
        ];
        foreach ($arrayLec as $key => $value) {
            if (is_numeric($value)) {
                continue;
            }
            if ($value == '(') {
                $var++;
                continue;
            }
            if ($value == ')') {
                $var--;
                continue;
            }
            if ($prioriry[$value] - (3 * $var) >= $max) {
                $max = $prioriry[$value];
                $kinkPoint = $key;
            }
        }
        return $kinkPoint;

    }

    public function buildBranch($topLec, $leftLec, $rightLec, $topP, $leftP, $rightP, $topObj)
    {
        // корень
        if (!$topObj) {
            $topTrio = $this->buildObj($topP);
            $topTrio->lec = $topLec;
        } else {
            $topTrio = $topObj;
        }

        // левая ветвь тройки
        $leftTrio = $this->buildObj($leftP);
        $leftTrio->lec = $leftLec;

        // правая ветвь тройки
        $rightTrio = $this->buildObj($rightP);
        $rightTrio->lec = $rightLec;

        // формирование тройки из объектов
        $topTrio->childrenLeft = $leftTrio;
        $topTrio->childrenRight = $rightTrio;
        $leftTrio->parent = $topTrio;
        $rightTrio->parent = $topTrio;
        if (!$topObj) {
            $trio = Array($topTrio, $leftTrio, $rightTrio);
            return $trio;
        } else {
            $duo = Array($leftTrio, $rightTrio);
            return $duo;
        }
    }

    public function stopBuild($arNode)
    {
        foreach ($arNode as $obj) {
            if ($obj->lec[1] && !$obj->childrenLeft && !$obj->childrenRight) {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function searchObj($arNode)
    {
        foreach ($arNode as $obj) {
            if ($obj->lec[1] && !$obj->childrenLeft && !$obj->childrenRight) {
                return $obj;
            }
        }
    }

    public function buildTree()
    {
        $lecsemArray = $this->formulaParse();

        $topN = $this->findKinkPoint($lecsemArray);
        $topP = $lecsemArray[$topN];
        $leftLec = array_slice($lecsemArray, 0, $topN);
        if ($leftLec[0] == "(" && $leftLec[count($leftLec) - 1] == ")") {
            array_shift($leftLec);
            array_pop($leftLec);
        }
        $rightLec = array_slice($lecsemArray, $topN + 1);
        if ($rightLec[0] == "(" && $rightLec[count($rightLec) - 1] == ")") {
            array_shift($rightLec);
            array_pop($rightLec);
        }
        $leftN = $this->findKinkPoint($leftLec);
        $leftP = $leftLec[$leftN];
        $rightN = $this->findKinkPoint($rightLec);
        $rightP = $rightLec[$rightN];

        $trio = $this->buildBranch($lecsemArray, $leftLec, $rightLec, $topP, $leftP, $rightP, NULL);

        $arNode = $trio;

        while (!$this->stopBuild($arNode)) {
            $topTrio = $this->searchObj($arNode);
            $arLec = $topTrio->lec;
            $topN = $this->findKinkPoint($arLec);
            $leftLec = array_slice($arLec, 0, $topN);
            if ($leftLec[0] == "(" && $leftLec[count($leftLec) - 1] == ")") {
                array_shift($leftLec);
                array_pop($leftLec);
            }
            $rightLec = array_slice($arLec, $topN + 1);
            if ($rightLec[0] == "(" && $rightLec[count($rightLec) - 1] == ")") {
                array_shift($rightLec);
                array_pop($rightLec);
            }
            $leftN = $this->findKinkPoint($leftLec);
            $leftP = $leftLec[$leftN];
            $rightN = $this->findKinkPoint($rightLec);
            $rightP = $rightLec[$rightN];
            $duo = $this->buildBranch(NULL, $leftLec, $rightLec, NULL, $leftP, $rightP, $topTrio);
            $arNode = array_merge($arNode, $duo);
            var_dump($arNode);exit;
        }

        $this->nodesArray = $arNode;
    }
}
$formula = new Formula('(x+42)^2+7*y-z');
$formula->buildTree();


echo " result: ".$formula->calculate(1, 2, 3);
//var_dump($formula->formulaParse());

