<?php


namespace Softec\CustomForm\Controller\Email;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Class Senddenuncia
 *
 * @package Softec\CustomForm\Controller\Email
 */
class Senddenuncia extends \Magento\Framework\App\Action\Action
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


        $uploadDir = str_replace('/app/code/Softec/CustomForm/Controller/Email/Senddenuncia.php', '', __FILE__).'/pub_forms/';


        $post = $this->getRequest()->getPost();

        // print_r($post);

        // echo $file_denuncia = $post['file'];

        // print_r($_FILES);

        // Upload file 

        $response = array();
        $uploadedFile = ''; 
        if(!empty($_FILES["file"]["name"])){ 
     
            // File path config 
            $fileName = basename($_FILES["file"]["name"]); 
       

            $targetFilePath = $uploadDir . $fileName; 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 

            $fileName = sha1(md5($fileName)). '.' . $fileType; 
            $targetFilePath = $uploadDir . $fileName; 
             
            // Allow certain file formats 
            $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'ppt', 'fig'); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to the server 
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
         
                    $uploadedFile = $fileName; 
                }else{ 
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, there was an error uploading your file.'; 
                } 
            }else{ 
                $uploadStatus = 0; 
                $response['message'] = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
            } 
        } 

        // print_r($response);
 
        $post['file'] = 'http://'.$_SERVER['HTTP_HOST'].'/pub_forms/'.$uploadedFile;

        // print_r($post);

        return $this->helperEmail->sendEmailDenuncia($post);


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

