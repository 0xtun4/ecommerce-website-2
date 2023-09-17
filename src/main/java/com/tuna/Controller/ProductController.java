package com.tuna.Controller;

import com.tuna.Model.Product;
import com.tuna.repositories.ProductRepository;
import com.tuna.repositories.response.ResponseObject;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/api/Product")
public class ProductController {
    @Autowired
    private ProductRepository productRepository;

    @GetMapping("/getAllProducts")
    List<Product> getAllProductsSortedByName(@RequestParam(name = "ascending", defaultValue = "true") boolean ascending) {
        List<Product> products;
        if (ascending) {
            products = productRepository.findAllByOrderByProductNameAsc();
        } else {
            products = productRepository.findAllByOrderByProductNameDesc();
        }
        return products;
    }

    @GetMapping("/{id}")
    ResponseEntity<ResponseObject> getProductById(@PathVariable String id) {
        Optional<Product> foundProduct = productRepository.findById(id);
        return foundProduct.map(product -> new ResponseEntity<>(
                        new ResponseObject("Success", "Product found", product), HttpStatus.OK))
                .orElseGet(() -> new ResponseEntity<>(
                        new ResponseObject("Error", "Product not found", ""), HttpStatus.NOT_FOUND));
    }

    @GetMapping("/searchProducts")
    List<Product> searchProducts(@RequestParam(name = "keyword") String keyword) {
        List<Product> products = productRepository.findByProductNameContainingIgnoreCase(keyword);
        return products;
    }
}
