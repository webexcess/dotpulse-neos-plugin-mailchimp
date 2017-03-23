<?php
namespace Dotpulse\MailChimp\Validation\Validator;

/*
 * This file is part of the Dotpulse.MailChimp package.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Validation\Validator\EmailAddressValidator;
use TYPO3\Flow\I18n\Translator;
use Dotpulse\MailChimp\Domain\Service\MailChimpService;

/**
 * Validator for email addresses
 *
 * @api
 * @Flow\Scope("singleton")
 */
class UniqueSubscriptionValidator extends EmailAddressValidator {

    /**
     * @Flow\Inject
     * @var MailChimpService
     */
    protected $mailChimpService;

    /**
     * @Flow\Inject
     * @var Translator
     */
    protected $translator;

    /**
     * @var array
     */
    protected $supportedOptions = array(
        'listId' => array(NULL, 'MailChimp List ID', 'string', TRUE),
        'translation.id' => array('alreadyRegistered', 'Translation ID', 'string', FALSE),
        'translation.source' => array('ValidationErrors', 'Translation Source', 'string', FALSE),
        'translation.package' => array('Dotpulse.MailChimp', 'Translation Package', 'string', FALSE)
    );

    /**
     * Checks if the given value is a valid email address.
     *
     * @param mixed $value The value that should be validated
     * @return void
     * @api
     */
    protected function isValid($value) {
        $options = $this->getOptions();
        if ($this->validEmail($value) && $this->mailChimpService->isMember($options['listId'], $value)) {
            $this->addError($this->translator->translateById($options['translation.id'], array(), null, null, $options['translation.source'], $options['translation.package']), 1422317184);
        }
    }

}
