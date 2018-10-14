<?php

class Loger{
    
    private $timeStart = 0;
    private $timeEnd = 0;
    private $timeResult = 0.0;

    public function resetLog(){
        $this->timeStart = 0;
        $this->timeEnd = 0;
        $this->timeResult = 0.0;
    }
    
    public function startLog(){
        $this->resetLog();
        
        $this->timeStart = microtime(true);
    }
    
    public function stopLog(){
        $this->timeEnd = microtime(true);
        
        $this->timeResult = $this->timeEnd - $this->timeStart;
    }
    
    public function getResultTime(){
        return $this->timeResult;
    }
}



// Начальные данные
$maxElemet = 510000;
$arrFor = [];
$arrIter = [];
$logerFor = new Loger;
$logerIter = new Loger;

$testFor = 1;
$testIter = 1;

for($i = 1; $i <= $maxElemet; $i += 1000){
    
    // Тест итератора
    $arrIter = array_fill(0, $i, 1);
    
    $obj = new ArrayObject($arrIter);
    $iter = $obj->getIterator();
    $logerIter->startLog(); 
    while($iter->valid()){
        $testIter = $iter->current();
        $iter->next();
    }
    $logerIter->stopLog();
    unset($arrIter);
    
    // Тест ForEach
    $arrFor = array_fill(0, $i, 1);
    
    $logerFor->startLog();
    foreach ($arrFor as $key => $value) {
        $testFor = $value;
    }
    $logerFor->stopLog();
    unset($arrFor);
    
    
    
    
    $faster = $logerFor->getResultTime() < $logerIter->getResultTime() ? "FOREACH" : "ITERATOR ---------------------------!!!";
    
    echo "<p>OPERATIONS = {$i} | FOREACH time {$logerFor->getResultTime()} | ITERATOR time {$logerIter->getResultTime()} | FASTER: {$faster} </p>";
}


