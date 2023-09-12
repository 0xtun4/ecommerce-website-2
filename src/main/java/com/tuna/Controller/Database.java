//package Controller;
//
//import com.tuna.Model.Product;
//import com.tuna.repositories.ProductRepository;
//import org.slf4j.Logger;
//import org.slf4j.LoggerFactory;
//import org.springframework.boot.CommandLineRunner;
//import org.springframework.context.annotation.Bean;
//import org.springframework.context.annotation.Configuration;
//
//@Configuration // Add the @Configuration annotation
//public class Database {
//    private static final Logger logger = LoggerFactory.getLogger(Database.class);
//
//    @Bean
//    CommandLineRunner initDatabase(ProductRepository productRepository) {
//        return new CommandLineRunner() {
//            @Override
//            public void run(String... args) throws Exception {
////                Product product1 = new Product("a1,Product 1", "2020", 100.0, "https://www.google.com", "hi", 200);
////                Product product2 = new Product("a,Product 2", "2020", 200.0, "https://www.google.com", "ji", 22002);
//                // Uncomment the lines below to save the products to the repository
//                // logger.info("Insert data " + productRepository.save(product1));
//                // logger.info("Insert data " + productRepository.save(product2));
//            }
//        };
//    }
//}
