<?php

class CulturalObjectService {

    private $tableName = 'CulturalObject';
    private $primaryKey = 'Coid';

    function get($id) {
        $entity = CulturalobjectsQuery::create()->findPk($id);

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
            $entity = new Culturalobjects();
            $entity->setAccessionnumber($object->{'Accessionnumber'});
            $entity->setObjecttype($object->{'Objecttype'});
            $entity->setObject($object->{'Object'});
            $entity->setDescription($object->{'Description'});
            $entity->setMaterials($object->{'Materials'});
            $entity->setCulturalgroup($object->{'Culturalgroup'});
            $entity->setDimensions($object->{'Dimensions'});
            $entity->setProductiondate($object->{'Productiondate'});
            $entity->setAssociatedplaces($object->{'Associatedplaces'});
            $entity->setAssociatedpeople($object->{'Associatedpeople'});
            $entity->setFkIid($object->{'FkIid'});
            $entity->setFkExid($object->{'FkExid'});
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

        $entity = CulturalobjectsQuery::create()->findOneByCoid($object->{$this->primaryKey});

        if($entity == null) {
            $data = helper::getError(404, 'The '.$this->primaryKey.' of the '.$this->tableName.' was not found');
        } else {
            $entity->setAccessionnumber($object->{'Accessionnumber'});
            $entity->setObjecttype($object->{'Objecttype'});
            $entity->setObject($object->{'Object'});
            $entity->setDescription($object->{'Description'});
            $entity->setMaterials($object->{'Materials'});
            $entity->setCulturalgroup($object->{'Culturalgroup'});
            $entity->setDimensions($object->{'Dimensions'});
            $entity->setProductiondate($object->{'Productiondate'});
            $entity->setAssociatedplaces($object->{'Associatedplaces'});
            $entity->setAssociatedpeople($object->{'Associatedpeople'});
            $entity->setFkIid($object->{'FkIid'});
            $entity->setFkExid($object->{'FkExid'});
            $entity->save();
            $data['data'] = $entity->toArray();
        }

        return $data;
    }

    function remove($id) {
        $entity = CulturalobjectsQuery::create()->findOneByCoid($id);

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