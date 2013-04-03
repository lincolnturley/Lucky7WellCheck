<?php
include_once("header.php");
/**
 * Description of Memo
 *
 * date          Date
 * note          string
 * messageRead   bool
 * messageType   string
 * 
 * @author Taylor
 */
class Memo {
    //Attributes
    private $date;
    private $note;
    private $messageRead;
    private $messageType;
    
     /**
     * Creates a new Memo Object
     * 
     * @param type $newMemo array containing indices date, note,
      * messageRead, messageType
     */
    public function __construct($newMemo)
    {
        $this->date = $newMemo["date"];
        $this->note = $newMemo["note"];
        $this->messageRead = $newMemo["messageRead"];
        $this->messageType = $newMemo["messageType"];
    }
    
    //#####################################################
    //GETTER FUNCTIONS
    //#####################################################
    public function getDate(){ return $this->date; }
    public function getNote(){ return $this->note; }
    public function getMessageRead(){ return $this->messageRead; }
    public function getMessageType(){ return $this->messageType; }
    
    
    //#####################################################
    //SETTER FUNCTIONS
    //#####################################################
    public function setDate($newDate){ $this->date = $newDate; }
    public function setNote($newNote) { $this->note = $newNote; }
    public function setMessageRead($newMessageRead) {$this->messageRead = $newMessageRead;}
    public function setMessageType($newMessageType) {$this->messageRead = $newMessageType;}
    
    public function toString()
    {
        return "date = ".$this->date->format("Y-m-d")."<br>
            note = $this->note<br>
            messageRead = $this->messageRead<br>
            messageType = $this->messageType<br>";
    }
}

?>
