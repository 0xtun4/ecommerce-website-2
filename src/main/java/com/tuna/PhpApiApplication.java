package com.tuna;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;

//@SpringBootApplication(exclude= {SecurityAutoConfiguration.class})
//@ComponentScan(basePackageClasses = MemberController.class)

@SpringBootApplication
public class PhpApiApplication {
    public static void main(String[] args) {
        SpringApplication.run(PhpApiApplication.class, args);
    }
}

