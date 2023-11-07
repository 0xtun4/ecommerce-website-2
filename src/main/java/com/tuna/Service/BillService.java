package com.tuna.Service;

import com.tuna.Models.Bill;
import com.tuna.repositories.BillRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;
@RestController
@CrossOrigin
@Service
public class BillService {

    @Autowired
    private BillRepository billRepository;


    public List<Bill> getAllBillsByCustomerId(long customerId) {

        return billRepository.findAllByCustomerId(customerId);
    }
}