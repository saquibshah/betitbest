<?php

/**
 * Class Search_model
 * @property team_model $Team
 * @property tournament_model $Tournament
 * @property category_model $Category
 * @property sport_model $Sport
 * @property MY_Lang $lang
 */
class Search_model extends CI_Model {
    const MIN_WORD_LENGTH = 4;

    public function find($searchterm) {
        $this->load->model('team_model', 'Team', true);
        $this->load->model('tournament_model', 'Tournament', true);
        $this->load->model('category_model', 'Category', true);
        $this->load->model('sport_model', 'Sport', true);

        $out = new stdClass();
        $out->team = new stdClass();
        $out->unique = new stdClass();
        $out->tournament = new stdClass();
        $out->category = new stdClass();
        $out->sport = new stdClass();

        $result = new stdClass();
        $result->localization = $this->findLocalization($searchterm);
        $result->team = $this->findTeam($searchterm);
        $result->uniqueTournament = $this->findUniqueTournament($searchterm);
        $result->tournament = $this->findTournament($searchterm);
        $result->category = $this->findCategory($searchterm);
        $result->sport = $this->findSport($searchterm);

        foreach ($result->localization as $entry) {
            $identifier = $this->processLocalizationIdentifier($entry->identifier);

            $this->processResults($identifier->type, $identifier->uid, $out);
        }

        foreach ($result->team as $team) {
            $this->processResults('team', $team->uid, $out);
        }

        foreach ($result->uniqueTournament as $tournament) {
            $this->processResults('unique', $tournament->uid, $out);
        }

        foreach ($result->tournament as $tournament) {
            $this->processResults('tournament', $tournament->uid, $out);
        }

        foreach ($result->category as $category) {
            $this->processResults('category', $category->uid, $out);
        }

        foreach ($result->sport as $sport) {
            $this->processResults('sport', $sport->uid, $out);
        }

        return $out;
    }

    public function findLocalization($searchterm) {
        return $this->db->select('identifier, value')->from('localization')
            ->where("`identifier` REGEXP '^(team_|unique_tournament_|tournament_|category_|sport_)'", null, false)
            ->where($this->getCondition('value', $searchterm))
            ->group_by('identifier')->order_by('identifier', 'desc')->get()->result();
    }

    protected function getCondition($column, $searchterm) {
        $searchterm = explode(' ', $searchterm);
        $out = array();
        foreach ($searchterm as $term) {
            $out[] = "`{$column}` LIKE '%{$term}%'";
        }

        return implode(' AND ', $out);
    }

    public function findTeam($searchterm) {
        return $result = $this->db->select('team.uid, team.name, team.seourl')->from('team')
            ->where($this->getCondition('betradar_name', $searchterm))
            ->where('team.deleted', 0)
            ->limit(10)->get()->result();
    }

    public function findUniqueTournament($searchterm) {
        return $this->db->select('uid, name, seourl')->from('unique_tournament')
            ->where($this->getCondition('name', $searchterm))
            ->where('hidden', 0)
            ->limit(10)->get()->result();
    }

    public function findTournament($searchterm) {
        return $this->db->select('uid, unique_uid, name, seourl')->from('tournament')
            ->where($this->getCondition('betradar_name', $searchterm))
            ->where('hidden', 0)
            ->limit(10)->get()->result();
    }

    public function findCategory($searchterm) {
        return $this->db->select('uid, name, seourl')->from('category')
            ->where($this->getCondition('betradar_name', $searchterm))
            ->where('hidden', 0)
            ->limit(10)->get()->result();
    }

    public function findSport($searchterm) {
        return $this->db->select('uid, name, seourl')->from('sport')
            ->where($this->getCondition('betradar_name', $searchterm))
            ->where('hidden', 0)
            ->limit(10)->get()->result();
    }

    protected function processLocalizationIdentifier($identifier) {
        $identifier = explode('_', $identifier);

        $out = new stdClass();
        $out->type = $identifier[0];

        if ($identifier[0] == 'unique') {
            $out->uid = $identifier[2];
        } else {
            $out->uid = $identifier[1];
        }

        return $out;
    }

    protected function processResults($type, $uid, &$result) {
        $this->load->model('team_model', 'Team', true);
        $this->load->model('tournament_model', 'Tournament', true);
        $this->load->model('category_model', 'Category', true);
        $this->load->model('sport_model', 'Sport', true);

        $out = new stdClass();
        $pathElements = array();

        switch ($type) {
            case 'team':
                $object = $this->Team->get_processed($uid);
                break;

            case 'unique':
                $object = (object)$this->Tournament->get_single($uid, true, true);
                break;

            case 'tournament':
                $object = (object)$this->Tournament->get_single($uid, false, true);

                if (count((array)$object) == 0
                    || (isset($result->unique)
                        && isset($result->unique->{$object->unique_uid}))
                ) {
                    return;
                }

                break;

            case 'category':
                $object = (object)$this->Category->get_single($uid, 0, false);
                break;

            case 'sport':
                $object = (object)$this->Sport->get_single($uid, false);
                break;

            default:
                $object = false;
        }

        if ($object == false || count((array)$object) == 0 || isset($result->{$type}->{$uid})) {
            return;
        }

        switch ($type) {
            case 'team':
                if ($object->has_unique_tournament) {
                    $pathElements['tournament'] = $object->unique_tournament;
                    $pathElements['category'] = $object->unique_tournament->category;
                    $pathElements['sport'] = $object->unique_tournament->category->sport;
                } else {
                    $pathElements['tournament'] = $object->tournament;
                    $pathElements['category'] = $object->tournament->category;
                    $pathElements['sport'] = $object->tournament->category->sport;
                }
                break;

            case 'unique':
            case 'tournament':
                $category = (object)$this->Category->get_single($object->category_uid, 0, false);
                if (count((array)$category) == 0) {
                    return;
                }

                $pathElements['category'] = $category;
                $pathElements['sport'] = (object)$this->Sport->get_single($category->sport_uid, false);

            if ($type == 'unique') {
                $out->name = $this->lang->getLocalized("unique_tournament_{$object->uid}_name", $object->name);
            } else {
                $out->name = $this->lang->getLocalized("tournament_{$object->uid}_name", $object->name);
            }
            break;

            case 'category':
                $pathElements['sport'] = (object)$this->Sport->get_single($object->sport_uid, false);
                $out->name = $this->lang->getLocalized("category_{$object->uid}_name", $object->name);
                break;

            case 'sport':
                $out->name = $this->lang->getLocalized("sport_{$object->uid}_name", $object->name);
                break;
        }

        $url = array();
        $path = array();
        foreach ($pathElements as $key => $element) {
            if (count((array)$element) == 0) {
                return;
            }

            $name = $element->name;

            switch ($key) {
                case 'sport':
                    if ($type != 'team') {
                        $name = $this->lang->getLocalized("sport_{$element->uid}_name", $element->name);
                    }

                    $path[0] = $name;
                    $url[0] = $element->seourl;
                    break;

                case 'category':
                    if ($type != 'team') {
                        $name = $this->lang->getLocalized("category_{$element->uid}_name", $element->name);
                    }

                    $path[1] = $name;
                    $url[1] = $element->seourl;
                    break;

                case 'tournament':
                    if ($type != 'team') {
                        if ($element->tntype == 'unique') {
                            $name = $this->lang->getLocalized("unique_tournament_{$element->uid}_name", $element->name);
                        } else {
                            $name = $this->lang->getLocalized("tournament_{$element->uid}_name", $element->name);
                        }
                    }

                    $path[2] = $name;
                    $url[2] = $element->seourl;
            }
        }

        if ($type == 'team') {
            $url = array('teams');
            $out->name = $object->name . ' [' . $object->gender . ']';
        }
        $url[] = $object->seourl;

        ksort($url);
        ksort($path);


        $out->url = implode('/', $url);
        $out->path = $path;

        $result->{$type}->{$uid} = $out;
    }
}