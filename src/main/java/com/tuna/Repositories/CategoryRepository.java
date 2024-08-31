package com.tuna.Repositories;

import com.tuna.Models.Category;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.config.EnableJpaRepositories;
import org.springframework.stereotype.Repository;

import java.util.List;

@EnableJpaRepositories
@Repository
public interface CategoryRepository extends JpaRepository<Category, String> {
    List<Category> findAll();
}
