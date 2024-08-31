package com.tuna.Repositories;

import com.tuna.Models.Product;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.jpa.repository.config.EnableJpaRepositories;
import org.springframework.stereotype.Repository;

import java.util.List;
@EnableJpaRepositories
@Repository
public interface ProductRepository extends JpaRepository<Product, String> {
    List<Product> findAllByOrderByProductNameAsc();
    List<Product> findAllByOrderByProductNameDesc();
    @Query("SELECT p FROM Product p WHERE p.productName LIKE %?1%")
    List<Product> search(String keyword);
}