<?php declare(strict_types=1);
/**
 * @author    Nickolay Mikhaylov <sonny@milton.pro>
 * @copyright Copyright (c) 2020, Nikolay Mikhaylov
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\EventListener;

use App\Entity\PollResult;
use Doctrine\ORM\EntityManagerInterface;
use Milton\PollBundle\Event\PollEvents;
use Milton\PollBundle\Event\SubmitEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Save poll result listener
 */
class SavePollResultListener implements EventSubscriberInterface
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $em;

    /**
     * SavePollResultListener constructor.
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
    public static function getSubscribedEvents(): array
    {
        return [
            PollEvents::SUBMITTED => 'onSubmit',
        ];
    }

    /**
     * @param \Milton\PollBundle\Event\SubmitEvent $event
     */
    public function onSubmit(SubmitEvent $event): void
    {
        $poll       = $event->getPoll();
        $pollResult = PollResult::create($event->getPollData(), $poll->getName());

        $this->em->persist($pollResult);
        $this->em->flush();
    }
}
