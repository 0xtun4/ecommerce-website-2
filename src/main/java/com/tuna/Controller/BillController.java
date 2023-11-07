package com.tuna.Controller;

import com.tuna.Models.Bill;
import com.tuna.Service.BillService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;

@RestController
@RequestMapping("/api/bills")
public class BillController {

    @Autowired
    private BillService billService;

    @GetMapping("/customer/{customerId}")
    public ResponseEntity<Object> getAllBillsByCustomerId(@PathVariable int customerId) {
        List<Bill> bills = billService.getAllBillsByCustomerId(customerId);
        return ResponseEntity.ok(bills);
    }
}

