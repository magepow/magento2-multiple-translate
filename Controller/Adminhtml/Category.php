<?php
/**
 * Magepow 
 * @category 	Magepow 
 * @copyright 	Copyright (c) 2014 Magepow (http://www.magepow.com/) 
 * @license 	http://www.magepow.com/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2016-01-05 10:40:51
 * @@Modify Date: 2018-03-26 11:07:36
 * @@Function:
 */

namespace Magepow\MultiTranslate\Controller\Adminhtml;

abstract class Category extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Backend\Helper\Js
     */
    protected $_jsHelper;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $_resultForwardFactory;
	
    /**
     * @var \Magento\Backend\Model\View\Result\RedirectFactory
     */
    protected $_resultRedirectFactory;

    /**
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    protected $_resultLayoutFactory;

    /**
     * A factory that knows how to create a "page" result
     * Requires an instance of controller action in order to impose page type,
     * which is by convention is determined from the controller action class.
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;


    protected $_categoryFactory;

    protected $_categoryCollectionFactory;
    /**
     * Registry object.
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * File Factory.
     *
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $_fileFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Backend\Helper\Js $jsHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->_coreRegistry    = $coreRegistry;
        $this->_fileFactory     = $fileFactory;
        $this->_jsHelper        = $jsHelper;
        $this->_storeManager    = $storeManager;

        $this->_resultPageFactory       = $resultPageFactory;
        $this->_resultLayoutFactory     = $resultLayoutFactory;
        $this->_resultForwardFactory    = $resultForwardFactory;
        $this->_resultRedirectFactory   = $context->getResultRedirectFactory();
		
        $this->_categoryFactory             = $categoryFactory;
        $this->_categoryCollectionFactory   = $categoryCollectionFactory;
    }

    protected function _isAllowed()
    {
        $namespace = (new \ReflectionObject($this))->getNamespaceName();
        $string = strtolower(str_replace(__NAMESPACE__ . '\\','', $namespace));
        $action =  explode('\\', $string);
        $action =  array_shift($action);
        return $this->_authorization->isAllowed("Magepow_MultiTranslate::multitranslate_$action");
    }
}
