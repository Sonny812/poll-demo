<?php declare(strict_types=1);
/**
 * @author    Nickolay Mikhaylov <sonny@milton.pro>
 * @copyright Copyright (c) 2020, Nikolay Mikhaylov
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Poll\Provider;

use App\Entity\Field as FieldEntity;
use App\Entity\Poll as PollEntity;
use App\Repository\PollRepository;
use Doctrine\ORM\EntityManagerInterface;
use Milton\PollBundle\Poll\Field;
use Milton\PollBundle\Poll\Poll;
use Milton\PollBundle\Poll\Provider\AbstractProvider;

/**
 * Entity poll provider
 */
class EntityPollProvider extends AbstractProvider
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $em;

    /**
     * EntityPollProvider constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @inheritDoc
     */
    public function getAllPolls(): iterable
    {
        $repository = $this->getPollRepository();

        foreach ($repository->findAll() as $pollEntity) {
            $fields = [];

            foreach ($pollEntity->getFields() as $fieldEntity) {
                $fields[$fieldEntity->getName()] = [
                    'type'    => $fieldEntity->getType(),
                    'options' => $fieldEntity->getOptions(),
                ];
            }

            yield new Poll($pollEntity->getName(), $pollEntity->isEnabled(), $fields);
        }
    }

    /**
     * @return \App\Repository\PollRepository
     */
    private function getPollRepository(): PollRepository
    {
        return $this->em->getRepository(PollEntity::class);
    }
}
