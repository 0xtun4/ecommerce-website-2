package com.tuna.Controller;

import com.tuna.Model.Product;
import com.tuna.repositories.ProductRepository;
import com.tuna.repositories.response.ResponseObject;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/api/Product")
public class ProductController {
    @Autowired
    private ProductRepository productRepository;

    @GetMapping("/getAllProducts")
    List<Product> getAllProducts() {
        return productRepository.findAll(
        );
    }

    @GetMapping("/{id}")
    ResponseEntity<ResponseObject> getProductById(@PathVariable String id) {
        Optional<Product> foundProduct = productRepository.findById(id);
        return  foundProduct.map(product -> new ResponseEntity<>(
                        new ResponseObject("Success", "Product found", product), HttpStatus.OK))
                .orElseGet(() -> new ResponseEntity<>(
                        new ResponseObject("Error", "Product not found", ""), HttpStatus.NOT_FOUND));
    }
}
