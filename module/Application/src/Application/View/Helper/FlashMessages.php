<?php
/**
 * Prakash Admane <prakash.adamane@grg.com>
 *
 */
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Mvc\Controller\Plugin\FlashMessenger as FlashMessenger;

/**
 * Class FlashMessages
 *
 * @package Application\View\Helper
 */
class FlashMessages extends AbstractHelper
{
    protected $flashMessenger;

    /**
     * @param FlashMessenger $flashMessenger
     */
    public function __construct(FlashMessenger $flashMessenger)
    {
        $this->flashMessenger = $flashMessenger;
    }

    /**
     * @param bool $includeCurrentMessages
     *
     * @return array
     */
    public function __invoke($includeCurrentMessages = false)
    {
        $messages = array(
            FlashMessenger::NAMESPACE_ERROR   => array(),
            FlashMessenger::NAMESPACE_SUCCESS => array(),
            FlashMessenger::NAMESPACE_INFO    => array(),
            FlashMessenger::NAMESPACE_DEFAULT => array()
        );

        foreach ($messages as $ns => &$m) {
            $m = $this->flashMessenger->getMessagesFromNamespace($ns);
            if ($includeCurrentMessages) {
                $m = array_merge($m,
                    $this->flashMessenger->getCurrentMessagesFromNamespace($ns));
                $this->flashMessenger->clearCurrentMessagesFromNamespace($ns);
            }
        }

        return $messages;
    }
}