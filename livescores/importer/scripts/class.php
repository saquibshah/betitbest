<?php

//function to filter node elements specifically
class DOMElementFilter extends FilterIterator
{
    private $tagName;
    public function __construct(DOMNodeList $nodeList, $tagName = NULL)
    {
        $this->tagName = $tagName;
        parent::__construct(new IteratorIterator($nodeList));
    }
    /**
     * @return bool true if the current element is acceptable, otherwise false.
     */
    public function accept()
    {
        $current = $this->getInnerIterator()->current();
        if (!$current instanceof DOMElement) {
            return FALSE;
        }
        return $this->tagName === NULL || $current->tagName === $this->tagName;
    }
}

//to determine and fix Live Coverage Abandoned  matches
class LCA {

    private $table = '';
    private $liveStatus = array();
    private $listLCAs = array();

    public function setTable($tableName) {
        $this->table = $tableName;
    }

    public function setLiveStatus($arrStatus) {
        $this->liveStatus = $arrStatus;
    }

    public function getLiveMatches() {
        $live_match_query = mysql_query("SELECT * FROM `{$this->table}` where `matchstatus` IN ('" . implode("','", $this->liveStatus) . "')");
        while ($row = mysql_fetch_array($live_match_query)) {
            $this->listLCAs[$row['matchid']] = $row['matchid'];
        }
    }

    public function removeFromLCA($match_id) {
        if (isset($this->listLCAs[$match_id])) {
            unset($this->listLCAs[$match_id]);
        }
    }

    public function markAsLCAs() {
        if (count($this->listLCAs) > 0) {
            mysql_query("UPDATE {$this->table} SET matchstatus='LCA' WHERE matchid IN ('" . implode("','", $this->listLCAs) . "')");
        }
    }

}
