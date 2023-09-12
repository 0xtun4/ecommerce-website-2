//package Controller;
//
//
//import com.tuna.Model.Product;
//import Model.ResponseObject;
//import com.tuna.repositories.ProductRepository;
//import org.springframework.beans.factory.annotation.Autowired;
//import org.springframework.http.HttpStatus;
//import org.springframework.http.ResponseEntity;
//import org.springframework.web.bind.annotation.GetMapping;
//import org.springframework.web.bind.annotation.PathVariable;
//import org.springframework.web.bind.annotation.*;
//import org.springframework.web.bind.annotation.RestController;
//
//import java.util.List;
//import java.util.Optional;
//import org.springframework.web.bind.annotation.PutMapping;
//
//@RestController
//@RequestMapping("/api/Product")
//public class ProductController {
//    @Autowired
//    private ProductRepository productRepository;
//
//    // ... Other methods ...
//
////    @PutMapping("/{id}")
////    public ResponseEntity<ResponseObject> updateProduct(@RequestBody Product newProduct, @PathVariable Long id) {
////        return productRepository.findById(id)
////                .map(product -> {
////                    product.setProductName(newProduct.getProductName());
////                    // Update other fields as needed
////                    product.setYear(newProduct.getYear());
////                    product.setPrice(newProduct.getPrice());
////                    product.setUrl(newProduct.getUrl());
////
////                    try {
////                        Product updatedProduct = productRepository.save(product);
////                        return ResponseEntity.status(HttpStatus.OK).body(
////                                new ResponseObject("Success", "Product updated", updatedProduct)
////                        );
////                    } catch (Exception e) {
////                        return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).body(
////                                new ResponseObject("Error", "Failed to update product", "")
////                        );
////                    }
////                })
////                .orElseGet(() -> {
////                    newProduct.setId(id);
////
////                    try {
////                        Product insertedProduct = productRepository.save(newProduct);
////                        return ResponseEntity.status(HttpStatus.OK).body(
////                                new ResponseObject("Success", "Product inserted", insertedProduct)
////                        );
////                    } catch (Exception e) {
////                        return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).body(
////                                new ResponseObject("Error", "Failed to insert product", "")
////                        );
////                    }
////                });
////    }
////
////    @DeleteMapping("/{id}")
////    public ResponseEntity<ResponseObject> deleteProduct(@PathVariable Long id) {
////        Optional<Product> foundProduct = productRepository.findById(id);
////        if (foundProduct.isPresent()) {
////            try {
////                productRepository.deleteById(id);
////                return ResponseEntity.status(HttpStatus.OK).body(
////                        new ResponseObject("Success", "Product deleted", "")
////                );
////            } catch (Exception e) {
////                return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).body(
////                        new ResponseObject("Error", "Failed to delete product", "")
////                );
////            }
////        }
////        return ResponseEntity.status(HttpStatus.NOT_FOUND).body(
////                new ResponseObject("Error", "Product not found", "")
////        );
////    }
//}
