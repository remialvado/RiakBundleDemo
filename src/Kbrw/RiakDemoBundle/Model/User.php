<?php
namespace Kbrw\RiakDemoBundle\Model;

use JMS\Serializer\Annotation as Ser;

/**
 * @Ser\AccessType("public_method") 
 * @Ser\XmlRoot("user")
 */
class User
{
    /**
     * @Ser\Type("string")
     */
    protected $id;
    
    /**
     * @Ser\Type("string")
     */
    protected $email;
    
    /**
     * @Ser\Type("string")
     * @Ser\SerializedName("fakeFullTextSearch")
     */
    protected $fakeFullTextSearch;
    
    function __construct($id = null, $email = null)
    {
        $this->setId($id);
        $this->setEmail($email);
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        $this->fakeFullTextSearch = "all $id";
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    public function getFakeFullTextSearch()
    {
        return $this->fakeFullTextSearch;
    }

    public function setFakeFullTextSearch($fakeFullTextSearch)
    {
        $this->fakeFullTextSearch = $fakeFullTextSearch;
    }
}