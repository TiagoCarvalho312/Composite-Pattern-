<?php 

final class TSQLUptade extends TSqlInstruction{

  private $columnValues;


  public function setRowData($column,$value) {
    //verifica se um dado e escalar
    
    if(is_scalar($value)) {

        if(is_string($value) and (!empty($value))) {
            
            $value = addslashes($value);

            $this->columnValues[$column] = "'$value'";

        }
        else if(is_bool($value)) {
            $this->columnValues[$column] = $value ?'TRUE':'FALSE';
        }
        else if($value!==''){
           $this->columnValues[$column] = $value;
        }
        else{
            $this->columnValues[$column] = "NULL";
        }
    }
  }
  /*metodo getInstruction
  retorna a instrução UPTADE em forma de string
  */

  public function getInstruction() {
    //monta a string UPTADE

    $this->sql = "UPTADE {$this->entity}";

    //monta os pares: coluna=valor

    if($this->columnValues){
        foreach($this->columnValues as $column=>$value){

            $set[] = "{$column} = {$value}";
        }
    }
    $this->sql .= 'SET' . implode (',', $set);

    if($this->criteria){
        $this->sql .= 'WHERE' . $this->criteria->dump();
    }
    return $this->sql;
  }
}
?>