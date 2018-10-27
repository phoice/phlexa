<?php
/**
 * Build voice applications for Amazon Alexa with phlexa and PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/phoice/phlexa
 * @link       https://www.phoice.tech/
 * @link       https://www.travello.audio/
 */

declare(strict_types=1);

namespace Phlexa\Response\Card;

/**
 * Class AskForPermissionsConsent
 *
 * @package Phlexa\Response\Card
 */
class AskForPermissionsConsent implements CardInterface
{
    public const ALEXA_ALERTS_REMINDERS_SKILL_READWRITE = 'alexa::alerts:reminders:skill:readwrite';
    public const WRITE_ALEXA_HOUSEHOLD_LIST             = 'write::alexa:household:list';
    public const READ_ALEXA_HOUSEHOLD_LIST              = 'read::alexa:household:list';
    public const READ_ALEXA_DEVICE_ALL_ADDRESS          = 'read::alexa:device:all:address';
    public const READ_ALEXA_DEVICE_ALL_ADDRESS_COUNTRY  = 'read::alexa:device:all:address:country_and_postal_code';
    public const ALEXA_PROFILE_NAME_READ                = 'alexa::profile:name:read';
    public const ALEXA_PROFILE_GIVEN_NAME_READ          = 'alexa::profile:given_name:read';
    public const ALEXA_PROFILE_EMAIL_READ               = 'alexa::profile:email:read';
    public const ALEXA_PROFILE_MOBILE_NUMBER_READ       = 'alexa::profile:mobile_number:read';

    /** @var array */
    private $permissions = [];

    /**
     * AskForPermissionsConsent constructor.
     *
     * @param array $permissions
     */
    public function __construct(array $permissions)
    {
        $this->setPermissions($permissions);
    }


    /**
     * Render the card object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type'        => 'AskForPermissionsConsent',
            'permissions' => $this->permissions,
        ];
    }

    /**
     * @param array $permissions
     */
    private function setPermissions(array $permissions): void
    {
        $this->permissions = $permissions;
    }
}
