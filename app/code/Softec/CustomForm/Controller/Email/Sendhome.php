<?php


namespace Softec\CustomForm\Controller\Email;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Class Sendhome
 *
 * @package Softec\CustomForm\Controller\Email
 */
class Sendhome extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;
    protected $jsonHelper;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Psr\Log\LoggerInterface $logger,
        \Softec\CustomForm\Helper\Email $helperEmail
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->jsonHelper = $jsonHelper;
        $this->logger = $logger;
        $this->helperEmail = $helperEmail;
        parent::__construct($context);

    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {   


        $post = $this->getRequest()->getPost();

        return $this->helperEmail->sendEmailHome($post);


        // try {
        //     return $this->jsonResponse('your response');
        // } catch (\Magento\Framework\Exception\LocalizedException $e) {
        //     return $this->jsonResponse($e->getMessage());
        // } catch (\Exception $e) {
        //     $this->logger->critical($e);
        //     return $this->jsonResponse($e->getMessage());
        // }

        
    }

    /**
     * Create json response
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function jsonResponse($response = '')
    {
        return $this->getResponse()->representJson(
            $this->jsonHelper->jsonEncode($response)
        );
    }
}

