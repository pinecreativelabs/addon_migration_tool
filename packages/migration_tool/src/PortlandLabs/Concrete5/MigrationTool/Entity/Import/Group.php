<?php
namespace PortlandLabs\Concrete5\MigrationTool\Entity\Import;

use PortlandLabs\Concrete5\MigrationTool\Publisher\PublishableInterface;
use PortlandLabs\Concrete5\MigrationTool\Publisher\Validator\GroupValidator;

/**
 * @Entity
 * @Table(name="MigrationImportGroups")
 */
class Group implements PublishableInterface
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="\PortlandLabs\Concrete5\MigrationTool\Entity\Import\GroupObjectCollection")
     **/
    protected $collection;

    /**
     * @Column(type="string")
     */
    protected $name;

    /**
     * @Column(type="string")
     */
    protected $description;

    /**
     * @Column(type="string")
     */
    protected $path;

    /**
     * @Column(type="string", nullable=true)
     */
    protected $package = null;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param mixed $collection
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
    }
    /**
     * @return mixed
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * @param mixed $package
     */
    public function setPackage($package)
    {
        $this->package = $package;
    }

    public function getPublisherValidator()
    {
        return new GroupValidator($this);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }
}
