<?php
// File: controller/ProductController.php

require_once '../models/Product.php';
require_once '../models/Category.php';

class ProductController
{
    private $productModel;
    private $categoryModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
    }

    public function index()
    {
        return $this->productModel->getProducts();
    }

    public function show($id)
    {
        return $this->productModel->getProductById($id);
    }

    public function create()
    {
        return $this->categoryModel->getCategories();
    }

    public function store($data)
    {
        return $this->productModel->addProduct($data['product_name'], $data['price'], $data['stock'], $data['category_id']);
    }

    public function edit($id)
    {
        return [
            'product' => $this->productModel->getProductById($id),
            'categories' => $this->categoryModel->getCategories()
        ];
    }

    public function update($id, $data)
    {
        return $this->productModel->updateProduct($id, $data['product_name'], $data['price'], $data['stock'], $data['category_id']);
    }

    public function delete($id)
    {
        return $this->productModel->deleteProduct($id);
    }
}
