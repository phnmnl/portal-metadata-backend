<?php

class MediaObjectService {

    private $tableName = 'MediaObject';
    private $primaryKey = 'Moid';

    function get($id) {
        $entity = MediaobjectsQuery::create()->findPk($id);

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
            $entity = new Mediaobjects();
            $entity->setMediafilename($object->{'Mediafilename'});
            $entity->setMediatitle($object->{'Mediatitle'});
            $entity->setMediadescription($object->{'Mediadescription'});
            $entity->setMediatype($object->{'Mediatype'});
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

        $entity = MediaobjectsQuery::create()->findOneByMoid($object->{$this->primaryKey});

        if($entity == null) {
            $data = helper::getError(404, 'The '.$this->primaryKey.' of the '.$this->tableName.' was not found');
        } else {
            $entity->setMediafilename($object->{'Mediafilename'});
            $entity->setMediatitle($object->{'Mediatitle'});
            $entity->setMediadescription($object->{'Mediadescription'});
            $entity->setMediatype($object->{'Mediatype'});
            $entity->setFkCoid($object->{'FkCoid'});
            $entity->save();
            $data['data'] = $entity->toArray();
        }

        return $data;
    }

    function remove($id) {
        $entity = MediaobjectsQuery::create()->findOneByMoid($id);

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