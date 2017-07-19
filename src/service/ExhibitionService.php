<?php

class ExhibitionService {

    private $tableName = 'Exhibition';
    private $primaryKey = 'Exid';

    function get($id) {
        $entity = ExhibitionQuery::create()->findPk($id);

        $data = array();

        if($entity == null){
            $data = helper::getError(404, 'The '.$this->primaryKey.' of the '.$this->tableName.' was not found');
        } else {
            $data['data'] = $entity->toArray();
        }

        return $data;
    }

    function create($array) {
        $object = json_decode($array[$this->tableName]);

        $data = array();

        try {
            $entity = new Exhibition();
            $entity->setExid($object->{$this->primaryKey});
            $entity->setExhibitionname($object->{'Exhibitionname'});
            $entity->setObjecttitle($object->{'Objecttitle'});
            $entity->setCulturalgroup($object->{'Culturalgroup'});
            $entity->save();
            $data['data'] = $entity->toArray();
        } catch (Exception $e) {
            $data = helper::getError(409, $e->getMessage());
        } finally {
            return $data;
        }
    }

    function update($array) {
        $object = json_decode($array[$this->tableName]);

        $data = array();

        $entity = ExhibitionQuery::create()->findOneByExid($object->{$this->primaryKey});

        if($entity == null) {
            $data = helper::getError(404, 'The '.$this->primaryKey.' of the '.$this->tableName.' was not found');
        } else {
            $entity->setExhibitionname($object->{'Exhibitionname'});
            $entity->setObjecttitle($object->{'Objecttitle'});
            $entity->setCulturalgroup($object->{'Culturalgroup'});
            $entity->save();
            $data['data'] = $entity->toArray();
        }

        return $data;
    }

    function remove($id) {
        $entity = ExhibitionQuery::create()->findOneByExid($id);

        $data = array();

        if($entity == null){
            $data = helper::getError(404, 'The '.$this->primaryKey.' of the '.$this->tableName.' was not found');
        } else {
            $entity->delete();
            $data['data'] = $entity->toArray();
        }

        return $data;
    }
}