package com.tuna.Repositories;

import com.tuna.Models.Bill;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface BillRepository extends JpaRepository<Bill, Integer> {
    List<Bill> findAllByCustomerId(long customerId);
}

