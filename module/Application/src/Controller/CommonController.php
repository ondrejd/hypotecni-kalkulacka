<?php
/**
 * @author  Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link    https://github.com/ondrejd/hypotecni-kaklulacka for the canonical source repository
 * @package Application
 */

namespace Application\Controller;

use Application\ConfigAwareInterface;
use Application\Model\Contact;
use Application\Model\ContactTable;
use Application\Model\Destination;
use Application\Model\DestinationTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Model\ViewModel;

/**
 * Description of CommonController
 *
 * @author ondrejd
 */
class CommonController extends AbstractActionController implements ConfigAwareInterface
{
    /**
     * @var ServiceManager $serviceManager
     */
    protected $serviceManager;

    /**
     * Constructor
     * @param ServiceManager $serviceManager
     */
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * @return ContactTable
     */
    public function getContactTable()
    {
        return $this->serviceManager->get(ContactTable::class);
    }

    /**
     * @return DestinationTable
     */
    public function getDestinationTable()
    {
        return $this->serviceManager->get(DestinationTable::class);
    }

    //ConfigAwareInterface
    protected $config;
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @link https://akrabat.com/sending-an-html-with-text-alternative-email-with-zendmail/
     * @param string $htmlBody
     * @param string $textBody
     * @param string $subject
     * @param string $from
     * @param string $to
     */
    public function sendMail($htmlBody, $textBody, $subject, $from, $to)
    {
        $htmlPart = new MimePart($htmlBody);
        $htmlPart->type = "text/html";

        $textPart = new MimePart($textBody);
        $textPart->type = "text/plain";

        $body = new MimeMessage();
        $body->setParts(array($textPart, $htmlPart));

        $message = new MailMessage();
        $message->setFrom($from);
        $message->addTo($to);
        $message->setSubject($subject);

        $message->setEncoding("UTF-8");
        $message->setBody($body);
        $message->getHeaders()->get('content-type')->setType('multipart/alternative');

        $transport = new Mail\Transport\Sendmail();
        $transport->send($message);
    }
}
