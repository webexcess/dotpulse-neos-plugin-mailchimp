<?php
namespace Dotpulse\MailChimp\Controller;

/*
 * This file is part of the Dotpulse.MailChimp package.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Error\Message;
use TYPO3\Neos\Controller\Module\AbstractModuleController;
use Dotpulse\MailChimp\Domain\Service\MailChimpService;

/**
 * @Flow\Scope("singleton")
 */
class MailChimpController extends AbstractModuleController {

    /**
     * @Flow\Inject
     * @var MailChimpService
     */
    protected $mailChimpService;

    /**
     * @return void
     */
    public function archiveAction() {
        $listId = $this->request->getInternalArgument('__listId');
        $folderId = $this->request->getInternalArgument('__folderId');

        $this->view->assignMultiple(array(
            'lists' => $this->mailChimpService->getArchiveByListById($listId, $folderId),
            'node' => $this->request->getInternalArgument('__documentNode')
        ));
    }

}
