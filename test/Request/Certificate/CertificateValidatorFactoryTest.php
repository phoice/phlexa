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

namespace PhlexaTest\Request\Certificate;

// @codingStandardsIgnoreStart
use PHPUnit\Framework\TestCase;
use Phlexa\Request\AlexaRequest;
use Phlexa\Request\Certificate\CertificateLoader;
use Phlexa\Request\Certificate\CertificateValidator;
use Phlexa\Request\Certificate\CertificateValidatorFactory;
use Phlexa\Request\Context\AudioPlayer;
use Phlexa\Request\Context\Context;
use Phlexa\Request\RequestType\LaunchRequestType;
use Phlexa\Request\Session\Application;
use Phlexa\Request\Session\Session;
use Phlexa\Request\Session\User;

// @codingStandardsIgnoreEnd

/**
 * Class CertificateValidatorFactoryTest
 *
 * @package PhlexaTest\Request\Certificate
 */
class CertificateValidatorFactoryTest extends TestCase
{
    /**
     * @var string
     */
    private $certificateUrl = 'https://s3.amazonaws.com/echo.api/echo-api-cert-5.pem';

    /**
     * @var string
     */
    private $signature
        = 'B/bxAdkIabkzsScfUsSfkz7pJrNLc1eoOOLk8qwG1ZudQRv7KcvyNa/91g74Z'
        . 'g3cRpifXEco4669MaZb4Cqs+vZ9TaTfftAMzy/Pc79AMuf1dU6GfUU7tp6cuav'
        . 'fqTD8cWlYN5TjEMCJbS1Y+VU929mX0edOZcZin7db6bOoZHu5gU8OSQ2r+6UMk8'
        . '8z5uuSjPyt9Du9vaC3Ics/Br30fEIplIgCt4y/UGRK76Rqo4L/DuNjty3o2m'
        . 'cU8bICK5xfZwCeH7b5UFwdjngtp8VfhKPtosZmCuWvMn+y9HoS06ll9cdI1FPLN'
        . '9w7KwMZFY8UzTc+0GfAwntxzlowAwkPhQ==';

    public function testFactory()
    {
        $timestamp = date('Y-m-d\TH:i:s\Z', time());

        $alexaRequest = $this->createAlexaRequest($timestamp);

        $factory = new CertificateValidatorFactory(        );

        $validator = $factory->create(
            $this->certificateUrl,
            $this->signature,
            $alexaRequest,
            new CertificateLoader(),
            true
        );

        $this->assertTrue($validator instanceof CertificateValidator);
    }

    /**
     * @param string $timestamp
     *
     * @return AlexaRequest
     */
    private function createAlexaRequest(string $timestamp)
    {
        $application = new Application(
            'amzn1.ask.skill.2e078f15-c276-41c4-a382-a4fba4323ca4'
        );

        // @codingStandardsIgnoreStart
        $user = new User(
            'amzn1.ask.account.AF6S5KHAPVECZ2WW7GEUMM3LHNPSC6XWQKUM3YB4KNAXKARTXHOQGNM5ZU3L7LPCBWAFUFSFJHFUMGQHQHIQJB6SFIE73X22QF7WOAUGXLVHB3OVEJ5E4B76PQHJJUTHU54KM2SUWG7JG5YEXNQJ5XKG2XKGQW7OZ25G2V6TQTQKR2I2GNLN6UYVZKLDC4AF5WYCYGFQOZTMMHI'
        );
        // @codingStandardsIgnoreEnd

        $session = new Session(
            true,
            'amzn1.echo-api.session.a1be50b2-2e94-4dc1-913b-9901cbf76de7',
            $application,
            [],
            $user
        );

        $launchRequest = new LaunchRequestType(
            'amzn1.echo-api.request.f1ec5455-1c8f-4707-916c-5e96d23b0049',
            $timestamp,
            'de-DE'
        );

        $context = new Context(
            new AudioPlayer('IDLE')
        );

        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'amzn1.echo-api.session.a1be50b2-2e94-4dc1-913b-9901cbf76de7',
                'application' => [
                    'applicationId' => 'amzn1.ask.skill.2e078f15-c276-41c4-a382-a4fba4323ca4',
                ],
                'attributes'  => [],
                'user'        => [
                    // @codingStandardsIgnoreStart
                    'userId' => 'amzn1.ask.account.AF6S5KHAPVECZ2WW7GEUMM3LHNPSC6XWQKUM3YB4KNAXKARTXHOQGNM5ZU3L7LPCBWAFUFSFJHFUMGQHQHIQJB6SFIE73X22QF7WOAUGXLVHB3OVEJ5E4B76PQHJJUTHU54KM2SUWG7JG5YEXNQJ5XKG2XKGQW7OZ25G2V6TQTQKR2I2GNLN6UYVZKLDC4AF5WYCYGFQOZTMMHI',
                    // @codingStandardsIgnoreEnd
                ],
            ],
            'request' => [
                'type'      => 'LaunchRequest',
                'requestId' => 'amzn1.echo-api.request.f1ec5455-1c8f-4707-916c-5e96d23b0049',
                'timestamp' => $timestamp,
                'locale'    => 'de-DE',
            ],
        ];

        return new AlexaRequest(
            'version',
            $launchRequest,
            $session,
            $context,
            json_encode($data)
        );
    }
}
