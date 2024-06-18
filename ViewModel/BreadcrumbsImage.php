<?php

namespace Codecryption\BreadcrumbsImage\ViewModel;

class BreadcrumbsImage implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var \Magento\Catalog\Model\Category
     */
    protected $categoryRepository;
    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;
    /**
     * @param \Magento\Catalog\Model\Category $categoryRepository
     */
    public function __construct(
        \Magento\Catalog\Model\Category $categoryRepository,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Registry $registry
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->_storeManager = $storeManager;
        $this->_registry = $registry;
    }

    public function getCategoryImage($categoryId)
    {
        try {
            $url = '';
            $category = $this->categoryRepository->load($categoryId);
            if($category->getBreadcrumbsImage()){
                $url = $this->getBaseUrl().$category->getBreadcrumbsImage();
            }
            return $url;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    public function getCurrentProduct()
    {        
        return $this->_registry->registry('current_product');
    }

    public function loadCategory($categoryId)
    {
        $category = $this->categoryRepository->load($categoryId);
        return $category;
    }
}
