<?php

class AssociatedMediaObjectService {

    private $tableName = 'AssociatedMediaObject';
    private $primaryKey = 'Amoid';

    function get($id) {
        $entity = AssociatedmediaobjectsQuery::create()->findPk($id);

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
            $entity = new Associatedmediaobjects();
            $entity->setAssociatedmediafilename($object->{'Associatedmediafilename'});
            $entity->setAssociatedmediatitle($object->{'Associatedmediatitle'});
            $entity->setAssociatedmediadescription($object->{'Associatedmediadescription'});
            $entity->setAssociatedmediatype($object->{'Associatedmediatype'});
            $entity->setFkCoid($object->{'FkCoid'});
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

        $entity = AssociatedmediaobjectsQuery::create()->findOneByAmoid($object->{$this->primaryKey});

        if($entity == null) {
            $data = helper::getError(404, 'The '.$this->primaryKey.' of the '.$this->tableName.' was not found');
        } else {
            $entity->setAssociatedmediafilename($object->{'Associatedmediafilename'});
            $entity->setAssociatedmediatitle($object->{'Associatedmediatitle'});
            $entity->setAssociatedmediadescription($object->{'Associatedmediadescription'});
            $entity->setAssociatedmediatype($object->{'Associatedmediatype'});
            $entity->setFkCoid($object->{'FkCoid'});
            $entity->save();
            $data['data'] = $entity->toArray();
        }

        return $data;
    }

    function remove($id) {
        $entity = AssociatedmediaobjectsQuery::create()->findOneByAmoid($id);

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