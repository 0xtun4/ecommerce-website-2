FROM openjdk:latest
COPY src ./src
CMD ["./mvnw", "spring-boot:run"]