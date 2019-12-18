<?php
/**
 * @author Ceymox
 * @copyright Copyright (c) 2019 Ceymox
 * @package Ceymox_Demo
 */

namespace Ceymox\Demo\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Controller\ResultFactory;

class Save extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Ceymox\Demo\Api\SignupRepositoryInterface
     */
    private $signupRepository;

    /**
     * @var \Ceymox\Demo\Api\Data\SignupInterfaceFactory
     */
    private $signupFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Ceymox\Demo\Api\Data\SignupInterfaceFactory $signupFactory,
        \Ceymox\Demo\Api\SignupRepositoryInterface $signupRepository
    ) {
        
        $this->signupRepository = $signupRepository;
        $this->signupFactory = $signupFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        if (!$post) {
            $this->_redirect('*/*/');
            return;
        }
        try {
            $signupFactory = $this->signupFactory->create();
            $signupFactory->setName($post['name']);
            $signupFactory->setEmail($post['email']);
            $signupFactory->setSignupDate($post['signup_date']);
            $this->signupRepository->save($signupFactory);
            $this->messageManager->addSuccess(__('Signup completed Successfully.'));
            $this->_redirect('');
        } catch (\Exception $e) {
//echo $e->getMessage();
            $this->messageManager->addError(__('We can’t process your request right now. 
                Sorry, that’s all we know.'));
                $this->_redirect('*/*/');
        }
    }
}
