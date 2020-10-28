<?php declare(strict_types=1);
/**
 * @author    Nickolay Mikhaylov <sonny@milton.pro>
 * @copyright Copyright (c) 2020, Nikolay Mikhaylov
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Poll result
 *
 * @ORM\Entity()
 */
class PollResult
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
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $data;

    /**
     * @var string|null
     *
     * @ORM\Column()
     */
    private $pollName;

    /**
     * PollResult constructor.
     */
    public function __construct()
    {
        $this->data = [];
    }

    /**
     * @param array  $data
     * @param string $pollName
     *
     * @return static
     */
    public static function create(array $data, string $pollName): self
    {
        $pollResult = new self();

        $pollResult
            ->setData($data)
            ->setPollName($pollName);

        return $pollResult;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return PollResult
     */
    public function setId(int $id): PollResult
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return PollResult
     */
    public function setData(array $data): PollResult
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPollName(): ?string
    {
        return $this->pollName;
    }

    /**
     * @param string|null $pollName
     *
     * @return PollResult
     */
    public function setPollName(string $pollName): PollResult
    {
        $this->pollName = $pollName;

        return $this;
    }
}
