<?php declare(strict_types=1);
/**
 * @author    Nickolay Mikhaylov <sonny@milton.pro>
 * @copyright Copyright (c) 2020, Nikolay Mikhaylov
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Poll
 *
 * @ORM\Entity(repositoryClass="App\Repository\PollRepository")
 */
class Poll
{
    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @var \Doctrine\Common\Collections\Collection|\App\Entity\Field[]
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Field")
     */
    private $fields;

    /**
     * Poll constructor.
     */
    public function __construct()
    {
        $this->enabled = true;
        $this->fields  = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Poll
     */
    public function setName(string $name): Poll
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     *
     * @return Poll
     */
    public function setEnabled(bool $enabled): Poll
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return \App\Entity\Field[]|\Doctrine\Common\Collections\Collection
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param \App\Entity\Field $field
     */
    public function addField(Field $field)
    {
        if (!$this->fields->contains($field)) {
            $this->fields->add($field);
        }
    }

    /**
     * @param \App\Entity\Field $field
     */
    public function removeField(Field $field)
    {
        if ($this->fields->contains($field)) {
            $this->fields->removeElement($field);
        }
    }
}
