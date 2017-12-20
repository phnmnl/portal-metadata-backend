<?php


class MetadataService
{

    private $tableName = 'Metadata';
    private $primaryKey = 'Idmetadata';
    private $logger;
    private $galaxy_url;
    private $galaxy_api_key;

    public function __construct(Monolog\Logger $logger, $galaxy_url, $galaxy_api_key)
    {
        $this->logger = $logger;
        $this->galaxy_url = $galaxy_url;
        $this->galaxy_api_key = $galaxy_api_key;
    }


    function getJenkinsReport()
    {

        return PhenomenalJenkinsReport::get_json_report();
    }

    function getGoogleKey()
    {

        $output = shell_exec('python service-account.py');
        $output = preg_replace("/\r\n|\r|\n/", '', $output);
        header('Content-type: application/json');
        $sub = array('key' => $output);
        $arr = array('result' => 1, 'data' => $sub);

        return $arr;
    }

    /**
     * @param $array
     * @return array|mixed
     * @throws MetadataServiceException
     */
    function createGalaxyUser($array)
    {
        $data = array();
        $entity = MetadataQuery::create()->findPk($array['token']);

        if ($entity == null) {
            $data[] = helper::getError(404, 'The ' . $this->primaryKey . ' of the ' . $this->tableName . ' was not found');
        } else {
            $url = $this->galaxy_url . '/api/users?key=' . $this->galaxy_api_key;
            $fields = array('email' => $array['email'], 'password' => $array['password'], 'username' => $array['username']);

            $fields_string = '';
            foreach ($fields as $key => $value) {
                $fields_string .= $key . '=' . $value . '&';
            }
            rtrim($fields_string, '&');

            $this->logger->debug("Processing request 'createGalaxyUser': URL=$url");

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

            $result = curl_exec($ch);

            curl_close($ch);

            $this->logger->debug("Raw response: " . $result);
            $data = json_decode($result, true);
            $this->logger->debug("Array correctly decoded!");

            if ($data && !isset($data["err_code"]) || $data['err_code']== '400008') {
                // update to true 'setIsregistergalaxy' when error_code=400008,
                // that implies an already registered user
                $entity->setIsaccepttermcondition(true);
                $entity->setIsregistergalaxy(true);
                $entity->save();
                $data['data'] = $entity->toArray();
            }

            if ($data && isset($data["err_code"])){
                $this->logger->debug("Setting error CODE");
                throw new MetadataServiceException(
                    $data[/** @lang text */
                    "err_msg"], $data['err_code'] == '400008' ? 409 : 500, $data);
            }
            $this->logger->debug("Return from createGalaxyUser method!!!");
        }

        $this->logger->debug("Type of the DATA object: " . gettype($data));
        return $data;
    }


    /**
     * @param $query
     * @return array
     */
    function find($query = null)
    {
        $this->logger->debug("Performing FIND using query: " . json_encode($query));
        $entity = MetadataQuery::create()->findByArray($query);
        $this->logger->debug("Find executed... RESULT=" . json_encode($query));

        return array("data" => $entity->toArray());
    }

    /**
     * @param $id
     * @return array
     */
    function findById($id = null)
    {
        $entity = MetadataQuery::create()->findPk($id);
        return array("data" => empty($entity) ? array() : $entity->toArray());
    }

    /**
     * @param $ids
     * @return array
     */
    function findByIds($ids = null)
    {
        $entity = MetadataQuery::create()->findPks($ids);
        return array("data" => empty($entity) ? array() : $entity->toArray());
    }


    /**
     * @param $id
     * @return array
     * @throws MetadataNotFoundException
     */
    function get($id)
    {
        $entity = MetadataQuery::create()->findPk($id);

        $data = array();

        if ($entity == null) {
            #$data = helper::getError(404, 'The ' . $this->primaryKey . ' of the ' . $this->tableName . ' was not found');
            throw new MetadataNotFoundException('The ' . $this->primaryKey . ' of the ' . $this->tableName . ' was not found');
        } else {
            $data['data'] = $entity->toArray();
        }

        return $data;
    }

    function create($array)
    {
        $object = json_decode($array[$this->tableName]);

        $data = array();

        try {
            $entity = new Metadata();
            $entity->setIdmetadata($object->{$this->primaryKey});
            $entity->setIsaccepttermcondition($object->{'Isaccepttermcondition'});
            $entity->setIsregistergalaxy($object->{'Isregistergalaxy'});
            $entity->save();
            $data['data'] = $entity->toArray();
        } catch (Exception $e) {
            $data = helper::getError(409, $e->getMessage());
        } finally {
            return $data;
        }
    }

    function update($array)
    {
        $object = json_decode($array[$this->tableName]);

        $data = array();

        $entity = MetadataQuery::create()->findOneByIdmetadata($object->{$this->primaryKey});

        if ($entity == null) {
            $data = helper::getError(404, 'The ' . $this->primaryKey . ' of the ' . $this->tableName . ' was not found');
        } else {
            $entity->setIsaccepttermcondition($object->{'Isaccepttermcondition'});
            $entity->setIsregistergalaxy($object->{'Isregistergalaxy'});
            $entity->save();
            $data['data'] = $entity->toArray();
        }

        return $data;
    }

    function remove($id)
    {
        $entity = MetadataQuery::create()->findOneByIdmetadata($id);

        $data = array();

        if ($entity == null) {
            $data = helper::getError(404, 'The ' . $this->primaryKey . ' of the ' . $this->tableName . ' was not found');
        } else {
            $entity->delete();
            $data['data'] = $entity->toArray();
        }

        return $data;
    }
}