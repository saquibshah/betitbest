<?php

class Home_model extends CI_Model {
    public function getStatus() {
        $status = array();

        $status['system'] = $this->_get_system_status();
        //$status['crawler'] = $this->_get_crawler_status();
        //$status['youtube_importer'] = $this->_get_youtube_importer_status();

        return (object)$status;
    }

    protected function _get_system_status() {
        //Server-Load
        //Anfragen per minute?
        //Traffic?
        //

        $numErr = $this->db->select('severity')
            ->from('log')
            ->where('severity', 'error')
            ->where('is_read', false)
            ->get()
            ->num_rows();

        $numWarn = $this->db->select('severity')
            ->from('log')
            ->where('severity', 'warning')
            ->where('is_read', false)
            ->get()
            ->num_rows();

        return (object)array('load_1' => rand(0, 100), 'load_5' => rand(0, 100), 'load_15' => rand(0, 100),
            'numErrors' => $numErr, 'numWarnings' => $numWarn);
    }

    protected function _get_crawler_status() {
        $lastRun = 'Noch kein Durchlauf';
        $lastRunResult = $this->db->select('detail, UNIX_TIMESTAMP(created_on) AS created_on')
            ->from('log')
            ->where('severity', 'info')
            ->where('source', 'crawler')
            ->order_by('created_on', 'desc')
            ->get()
            ->result();

        foreach ($lastRunResult as $result) {
            $detail = json_decode($result->detail);
            if ($detail->code == 1) {
                $lastRun = date('Y-m-d H:i:s', $result->created_on);
                break;
            }
        }

        $numFeeds = $this->db->from('feed')
            ->where('enabled', true)
            ->where('deleted', false)
            ->get()
            ->num_rows();

        $numDisabledFeeds = $this->db->from('feed')
            ->where('enabled', false)
            ->where('deleted', false)
            ->get()
            ->num_rows();

        $numErr = 0;
        $numWarn = 0;
        $numErrFeeds = 0;
        $numWarnFeeds = 0;

        $logs = $this->db->select('severity,item_type,item_id,detail')
            ->from('log')
            ->where('source', 'crawler')
            ->where('is_read', false)
            ->get()
            ->result();

        $tree = new stdClass();
        foreach ($logs as $log) {
            if (!empty($log->item_type) && !empty($log->item_id)) {
                if (!isset($tree->{$log->item_id})) {
                    $tree->{$log->item_id} = new stdClass();
                    $tree->{$log->item_id}->numErr = 0;
                    $tree->{$log->item_id}->numWarn = 0;
                }

                if ($log->severity == 'error') {
                    $tree->{$log->item_id}->numErr++;
                } else if ($log->severity == 'warning') {
                    $tree->{$log->item_id}->numWarn++;
                }
            } else {
                if ($log->severity == 'error') {
                    $numErr++;
                } else if ($log->severity == 'warning') {
                    $numWarn++;
                }
            }
        }

        foreach ($tree as $node) {
            if ($node->numErr > 0) {
                $numErrFeeds += $node->numErr;
            } else {
                $numWarnFeeds += $node->numWarn;
            }
        }

        $data = array('lastRun' => $lastRun, 'numFeeds' => $numFeeds, 'numDisabledFeeds' => $numDisabledFeeds,
            'numErrors' => $numErr, 'numWarnings' => $numWarn, 'numErrorFeeds' => $numErrFeeds, 'numWarningFeeds' =>
                $numWarnFeeds);

        return (object)$data;
    }

    protected function _get_youtube_importer_status() {
        $lastRun = 'Noch kein Durchlauf';
        $lastRunResult = $this->db->select('detail, UNIX_TIMESTAMP(created_on) AS created_on')
            ->from('log')
            ->where('severity', 'info')
            ->where('source', 'youtube-importer')
            ->order_by('created_on', 'desc')
            ->get()
            ->result();

        foreach ($lastRunResult as $result) {
            $detail = json_decode($result->detail);
            if ($detail->code == 1) {
                $lastRun = date('Y-m-d H:i:s', $result->created_on);
                break;
            }
        }

        $numChannels = $this->db->from('videochannel')
            ->where('disabled', false)
            ->get()
            ->num_rows();

        $numDisabledChannels = $this->db->from('videochannel')
            ->where('disabled', true)
            ->get()
            ->num_rows();

        $numVideoItems = $this->db->from('videoitems')
            ->where('blocked', false)
            ->get()
            ->num_rows();

        $numErr = 0;
        $numWarn = 0;
        $numErrChan = 0;
        $numWarnChan = 0;

        $logs = $this->db->select('severity,item_type,item_id,detail')
            ->from('log')
            ->where('source', 'youtube-importer')
            ->where('is_read', false)
            ->get()
            ->result();

        $tree = new stdClass();
        foreach ($logs as $log) {
            if (!empty($log->item_type) && !empty($log->item_id)) {
                if (!isset($tree->{$log->item_id})) {
                    $tree->{$log->item_id} = new stdClass();
                    $tree->{$log->item_id}->numErr = 0;
                    $tree->{$log->item_id}->numWarn = 0;
                }

                if ($log->severity == 'error') {
                    $tree->{$log->item_id}->numErr++;
                } else if ($log->severity == 'warning') {
                    $tree->{$log->item_id}->numWarn++;
                }
            } else {
                if ($log->severity == 'error') {
                    $numErr++;
                } else if ($log->severity == 'warning') {
                    $numWarn++;
                }
            }
        }

        foreach ($tree as $node) {
            if ($node->numErr > 0) {
                $numErrChan += $node->numErr;
            } else {
                $numWarnChan += $node->numWarn;
            }
        }

        $data =
            array('lastRun' => $lastRun, 'numChannels' => $numChannels, 'numDisabledChannels' => $numDisabledChannels,
                'numVideoItems' => $numVideoItems, 'numErrors' => $numErr, 'numWarnings' => $numWarn,
                'numErrorFeeds' => $numErrChan, 'numWarningFeeds' => $numWarnChan);

        return (object)$data;
    }
}
