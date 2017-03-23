<?php
namespace Dotpulse\MailChimp\Service\DataSource;

/*
 * This file is part of the Dotpulse.MailChimp package.
 */

use TYPO3\Neos\Service\DataSource\AbstractDataSource;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;
use Dotpulse\MailChimp\Domain\Service\MailChimpService;

use TYPO3\Flow\Annotations as Flow;

class FolderDataSource extends AbstractDataSource {

    /**
     * @Flow\Inject
     * @var MailChimpService
     */
    protected $mailChimpService;

    /**
     * @var string
     */
    static protected $identifier = 'dotpulse-mailchimp-folders';

    /**
     * @param NodeInterface $node The node that is currently edited (optional)
     * @param array $arguments Additional arguments (key / value)
     * @return mixed JSON serializable data
     * @api
     */
    public function getData(NodeInterface $node = NULL, array $arguments) {
        $folders = $this->mailChimpService->getFolders();

        foreach ($folders as $folder) {
            $values[$folder['folder_id']] = array(
                'label' => (string)$folder['name']
            );
        }

        return $values;
    }

}
